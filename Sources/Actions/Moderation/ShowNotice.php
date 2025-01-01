<?php

/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines https://www.simplemachines.org
 * @copyright 2025 Simple Machines and individual contributors
 * @license https://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 3.0 Alpha 2
 */

declare(strict_types=1);

namespace SMF\Actions\Moderation;

use SMF\ActionInterface;
use SMF\ActionTrait;
use SMF\Db\DatabaseApi as Db;
use SMF\ErrorHandler;
use SMF\Lang;
use SMF\Parser;
use SMF\Theme;
use SMF\User;
use SMF\Utils;

/**
 * Shows a notice sent to a user.
 */
class ShowNotice implements ActionInterface
{
	use ActionTrait;

	/****************
	 * Public methods
	 ****************/

	/**
	 * Does the job.
	 */
	public function execute(): void
	{
		$id_notice = (int) $_GET['nid'];

		$request = Db::$db->query(
			'',
			'SELECT body, subject
			FROM {db_prefix}log_member_notices
			WHERE id_notice = {int:id_notice}',
			[
				'id_notice' => $id_notice,
			],
		);

		if (Db::$db->num_rows($request) == 0) {
			ErrorHandler::fatalLang('no_access', false);
		}
		list(Utils::$context['notice_body'], Utils::$context['notice_subject']) = Db::$db->fetch_row($request);
		Db::$db->free_result($request);

		Utils::$context['notice_body'] = Parser::transform(
			string: Utils::$context['notice_body'],
			input_types: Parser::INPUT_BBC | Parser::INPUT_MARKDOWN,
		);
	}

	/******************
	 * Internal methods
	 ******************/

	/**
	 * Constructor. Protected to force instantiation via self::load().
	 */
	protected function __construct()
	{
		// Before we get too excited, is the current user allowed to see this?
		User::$me->isAllowedTo(['issue_warning', 'view_warning_any']);

		Utils::$context['page_title'] = Lang::$txt['show_notice'];
		Utils::$context['sub_template'] = 'show_notice';
		Utils::$context['template_layers'] = [];

		Theme::loadTemplate('ModerationCenter');
	}
}

?>