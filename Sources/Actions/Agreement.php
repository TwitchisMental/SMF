<?php

/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines https://www.simplemachines.org
 * @copyright 2024 Simple Machines and individual contributors
 * @license https://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 3.0 Alpha 2
 */

declare(strict_types=1);

namespace SMF\Actions;

use SMF\ActionInterface;
use SMF\ActionTrait;
use SMF\BBCodeParser;
use SMF\Config;
use SMF\ErrorHandler;
use SMF\Lang;
use SMF\MarkdownParser;
use SMF\Theme;
use SMF\User;
use SMF\Utils;

/**
 * The purpose of this class is to show the user the registration agreement
 * and privacy policy, and to ask the user to accept them if they haven't
 * already done so.
 */
class Agreement implements ActionInterface
{
	use ActionTrait;

	/****************
	 * Public methods
	 ****************/

	/**
	 * Shows the registration agreement and privacy policy.
	 *
	 * If the user hasn't yet accepted one or both of them, also shows the
	 * button to do so.
	 */
	public function execute(): void
	{
		$this->prepareAgreementContext();

		Lang::load('Agreement');
		Theme::loadTemplate('Agreement');

		$page_title = '';

		if (!empty(Utils::$context['agreement']) && !empty(Utils::$context['privacy_policy'])) {
			$page_title = Lang::$txt['agreement_and_privacy_policy'];
		} elseif (!empty(Utils::$context['agreement'])) {
			$page_title = Lang::$txt['agreement'];
		} elseif (!empty(Utils::$context['privacy_policy'])) {
			$page_title = Lang::$txt['privacy_policy'];
		}

		Utils::$context['page_title'] = $page_title;
		Utils::$context['linktree'][] = [
			'url' => Config::$scripturl . '?action=agreement',
			'name' => Utils::$context['page_title'],
		];

		if (isset($_SESSION['old_url'])) {
			$_SESSION['redirect_url'] = $_SESSION['old_url'];
		}
	}

	/***********************
	 * Public static methods
	 ***********************/

	/**
	 * Checks whether this user needs to accept the registration agreement.
	 *
	 * @return bool Whether they need to accept the agreement.
	 */
	public static function canRequireAgreement(): bool
	{
		// Guests can't agree
		if (!empty(User::$me->is_guest) || empty(Config::$modSettings['requireAgreement'])) {
			return false;
		}

		$agreement_lang = file_exists(Config::$languagesdir . '/' . User::$me->language . '/agreement.txt') ? User::$me->language : 'default';

		if (empty(Config::$modSettings['agreement_updated_' . $agreement_lang])) {
			return false;
		}

		Utils::$context['agreement_accepted_date'] = empty(Theme::$current->options['agreement_accepted']) ? 0 : Theme::$current->options['agreement_accepted'];

		// A new timestamp means that there are new changes to the registration agreement and must therefore be shown.
		return empty(Theme::$current->options['agreement_accepted']) || Config::$modSettings['agreement_updated_' . $agreement_lang] > Theme::$current->options['agreement_accepted'];
	}

	/**
	 * Checks whether this user needs to accept the privacy policy.
	 *
	 * @return bool Whether they need to accept the policy.
	 */
	public static function canRequirePrivacyPolicy(): bool
	{
		if (!empty(User::$me->is_guest) || empty(Config::$modSettings['requirePolicyAgreement'])) {
			return false;
		}

		$policy_lang = !empty(Config::$modSettings['policy_' . User::$me->language]) ? User::$me->language : Lang::$default;

		if (empty(Config::$modSettings['policy_updated_' . $policy_lang])) {
			return false;
		}

		Utils::$context['privacy_policy_accepted_date'] = empty(Theme::$current->options['policy_accepted']) ? 0 : Theme::$current->options['policy_accepted'];

		return empty(Theme::$current->options['policy_accepted']) || Config::$modSettings['policy_updated_' . $policy_lang] > Theme::$current->options['policy_accepted'];
	}

	/******************
	 * Internal methods
	 ******************/

	/**
	 * Loads the registration agreement and privacy policy into Utils::$context
	 * for display.
	 */
	protected function prepareAgreementContext(): void
	{
		// What, if anything, do they need to accept?
		Utils::$context['can_accept_agreement'] = !empty(Config::$modSettings['requireAgreement']) && self::canRequireAgreement();
		Utils::$context['can_accept_privacy_policy'] = !empty(Config::$modSettings['requirePolicyAgreement']) && self::canRequirePrivacyPolicy();
		Utils::$context['accept_doc'] = Utils::$context['can_accept_agreement'] || Utils::$context['can_accept_privacy_policy'];

		if (!Utils::$context['accept_doc'] || Utils::$context['can_accept_agreement']) {
			// Grab the agreement.
			// Have we got a localized one?
			if (file_exists(Config::$languagesdir . '/' . User::$me->language . '/agreement.txt')) {
				Utils::$context['agreement_file'] = Config::$languagesdir . '/' . User::$me->language . '/agreement.txt';
			} elseif (file_exists(Config::$languagesdir . '/en_US/agreement.txt')) {
				Utils::$context['agreement_file'] = Config::$languagesdir . '/en_US/agreement.txt';
			}

			if (!empty(Utils::$context['agreement_file'])) {
				$cache_id = strtr(Utils::$context['agreement_file'], [Config::$languagesdir => '', '.txt' => '', '.' => '_']);
				Utils::$context['agreement'] = BBCodeParser::load()->parse(file_get_contents(Utils::$context['agreement_file']), true, $cache_id);
			} elseif (Utils::$context['can_accept_agreement']) {
				ErrorHandler::fatalLang('error_no_agreement', false);
			}

			if (!empty(Config::$modSettings['enableMarkdown'])) {
				Utils::$context['agreement'] = MarkdownParser::load(MarkdownParser::OUTPUT_HTML, 0)->parse(Utils::$context['agreement'], true);
			}
		}

		if (!Utils::$context['accept_doc'] || Utils::$context['can_accept_privacy_policy']) {
			// Have we got a localized policy?
			if (!empty(Config::$modSettings['policy_' . User::$me->language])) {
				Utils::$context['privacy_policy'] = BBCodeParser::load()->parse(Config::$modSettings['policy_' . User::$me->language]);
			} elseif (!empty(Config::$modSettings['policy_' . Lang::$default])) {
				Utils::$context['privacy_policy'] = BBCodeParser::load()->parse(Config::$modSettings['policy_' . Lang::$default]);
			}
			// Then I guess we've got nothing
			elseif (Utils::$context['can_accept_privacy_policy']) {
				ErrorHandler::fatalLang('error_no_privacy_policy', false);
			}

			if (!empty(Config::$modSettings['enableMarkdown'])) {
				Utils::$context['privacy_policy'] = MarkdownParser::load(MarkdownParser::OUTPUT_HTML, 0)->parse(Utils::$context['privacy_policy'], true);
			}
		}
	}
}

?>