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

namespace SMF\Tasks;

use SMF\Actions\Notify;
use SMF\Alert;
use SMF\Config;
use SMF\Db\DatabaseApi as Db;
use SMF\ErrorHandler;
use SMF\Lang;
use SMF\Mail;
use SMF\Mentions;
use SMF\Parser;
use SMF\TaskRunner;
use SMF\Theme;
use SMF\User;
use SMF\Utils;

/**
 * This class contains code used to notify people when a new post is created that
 * is relevant to them in some way: new topics in boards they watch, replies to
 * topics they watch, posts that mention them, and/or posts that quote them.
 */
class CreatePost_Notify extends BackgroundTask
{
	/**
	 * Constants for reply types.
	 */
	public const NOTIFY_TYPE_REPLIES_AND_MODERATION = 1;
	public const NOTIFY_TYPE_REPLIES_AND_OWN_TOPIC_MODERATION = 2;
	public const NOTIFY_TYPE_ONLY_REPLIES = 3;
	public const NOTIFY_TYPE_NOTHING = 4;

	/**
	 * Constants for frequencies.
	 */
	public const FREQUENCY_NOTHING = 0;
	public const FREQUENCY_EVERYTHING = 1;
	public const FREQUENCY_FIRST_UNREAD_MSG = 2;
	public const FREQUENCY_DAILY_DIGEST = 3;
	public const FREQUENCY_WEEKLY_DIGEST = 4;

	/**
	 * Minutes to wait before sending notifications about mentions
	 * and quotes in unwatched and/or edited posts.
	 */
	public const MENTION_DELAY = 5;

	/**
	 * @var array Info about members to be notified.
	 */
	private $members = [
		// These three contain nested arrays of member info.
		'mentioned' => [],
		'quoted' => [],
		'watching' => [],

		// These ones just contain member IDs.
		'all' => [],
		'emailed' => [],
		'alerted' => [],
		'done' => [],
	];

	/**
	 * @var array Alerts to be inserted into the alerts table.
	 */
	private $alert_rows = [];

	/**
	 * @var array Members' notification and alert preferences.
	 */
	private $prefs = [];

	/**
	 * @var int Timestamp after which email notifications should be sent about
	 *			mentions and quotes in unwatched and/or edited posts.
	 */
	private $mention_mail_time = 0;

	/**
	 * This executes the task: loads up the info, puts the email in the queue
	 * and inserts any alerts as needed.
	 *
	 * @throws \Exception
	 * @return bool Always returns true.
	 * @todo PHP 8.2: This can be changed to return type: true.
	 */
	public function execute(): bool
	{
		Theme::loadEssential();

		$msgOptions = &$this->_details['msgOptions'];
		$topicOptions = &$this->_details['topicOptions'];
		$posterOptions = &$this->_details['posterOptions'];
		$type = &$this->_details['type'];

		// Board id is required; if missing, log an error and return
		if (!isset($topicOptions['board'])) {
			Lang::load('Errors');
			ErrorHandler::log(Lang::$txt['missing_board_id'], 'general', __FILE__, __LINE__);

			return true;
		}

		// poster_time not always supplied, but used throughout
		if (empty($msgOptions['poster_time'])) {
			$msgOptions['poster_time'] = 0;
		}

		$this->mention_mail_time = $msgOptions['poster_time'] + self::MENTION_DELAY * 60;

		// We need some more info about the quoted and mentioned members.
		if (!empty($msgOptions['quoted_members'])) {
			$this->members['quoted'] = Mentions::getMentionsByContent('quote', $msgOptions['id'], array_keys($msgOptions['quoted_members']));
		}

		if (!empty($msgOptions['mentioned_members'])) {
			$this->members['mentioned'] = Mentions::getMentionsByContent('msg', $msgOptions['id'], array_keys($msgOptions['mentioned_members']));
		}

		// Notifications shouldn't come through for denied boards.
		$group_permissions = [
			'allowed' => [],
			'denied' => [],
		];

		$request = Db::$db->query(
			'',
			'SELECT id_group, deny
			FROM {db_prefix}board_permissions_view
			WHERE id_board = {int:current_board}',
			[
				'current_board' => $topicOptions['board'],
			],
		);

		while (list($id_group, $deny) = Db::$db->fetch_row($request)) {
			$group_permissions[$deny === '0' ? 'allowed' : 'denied'][] = $id_group;
		}

		Db::$db->free_result($request);

		// Find the people interested in receiving notifications for this topic
		$request = Db::$db->query(
			'',
			'SELECT
				ln.id_member, ln.id_board, ln.id_topic, ln.sent,
				mem.email_address, mem.lngfile, mem.pm_ignore_list,
				mem.id_group, mem.id_post_group, mem.additional_groups,
				mem.time_format, mem.time_offset, mem.timezone,
				t.id_member_started, t.id_member_updated
			FROM {db_prefix}log_notify AS ln
				INNER JOIN {db_prefix}members AS mem ON (ln.id_member = mem.id_member)
				LEFT JOIN {db_prefix}topics AS t ON (t.id_topic = ln.id_topic)
			WHERE ' . ($type == 'topic' ? 'ln.id_board = {int:board}' : 'ln.id_topic = {int:topic}') . '
				AND ln.id_member != {int:member}',
			[
				'member' => $posterOptions['id'],
				'topic' => $topicOptions['id'],
				'board' => $topicOptions['board'],
			],
		);

		while ($row = Db::$db->fetch_assoc($request)) {
			// Skip members who aren't allowed to see this board
			$groups = array_merge([$row['id_group'], $row['id_post_group']], (empty($row['additional_groups']) ? [] : explode(',', $row['additional_groups'])));

			$is_denied = array_intersect($group_permissions['denied'], $groups) != [];

			if (!in_array(1, $groups) && ($is_denied || array_intersect($groups, $group_permissions['allowed']) == [])) {
				continue;
			}

			$row['groups'] = $groups;
			unset($row['id_group'], $row['id_post_group'], $row['additional_groups']);

			$this->members['watching'][$row['id_member']] = $row;
		}

		Db::$db->free_result($request);

		// Filter out mentioned and quoted members who can't see this board.
		if (!empty($this->members['mentioned']) || !empty($this->members['quoted'])) {
			foreach (['mentioned', 'quoted'] as $member_type) {
				foreach ($this->members[$member_type] as $member_id => $member_data) {
					$is_denied = array_intersect($group_permissions['denied'], $member_data['groups']) != [];

					if (!in_array(1, $member_data['groups']) && ($is_denied || array_intersect($member_data['groups'], $group_permissions['allowed']) == [])) {
						unset($this->members[$member_type][$member_id], $msgOptions[$member_type . '_members'][$member_id]);
					}
				}
			}
		}

		$unnotified = array_filter($this->members['watching'], function ($member) {
			return empty($member['sent']);
		});

		// Modified post, or dealing with delayed mention and quote notifications.
		if ($type == 'edit' || !empty($this->_details['respawns'])) {
			// Notifications about modified posts only go to members who were mentioned or quoted
			$this->members['watching'] = $type == 'edit' ? [] : $unnotified;

			// If this post has no quotes or mentions, just delete any obsolete alerts and bail out.
			if (empty($this->members['quoted']) && empty($this->members['mentioned'])) {
				$this->updateAlerts((int) $msgOptions['id']);

				return true;
			}

			// Never notify about edits to ancient posts.
			if (!empty(Config::$modSettings['oldTopicDays']) && time() > $msgOptions['poster_time'] + Config::$modSettings['oldTopicDays'] * 86400) {
				return true;
			}

			// If editing is only allowed for a brief time, send after editing becomes disabled.
			if (!empty(Config::$modSettings['edit_disable_time']) && Config::$modSettings['edit_disable_time'] <= self::MENTION_DELAY) {
				$this->mention_mail_time = $msgOptions['poster_time'] + Config::$modSettings['edit_disable_time'] * 60;
			}
			// Otherwise, impose a delay before sending notifications about edited posts.
			else {
				if (!empty($this->_details['respawns'])) {
					$request = Db::$db->query(
						'',
						'SELECT modified_time
						FROM {db_prefix}messages
						WHERE id_msg = {int:msg}
						LIMIT 1',
						[
							'msg' => $msgOptions['id'],
						],
					);
					list($real_modified_time) = Db::$db->fetch_row($request);
					Db::$db->free_result($request);

					// If it was modified again while we weren't looking, bail out.
					// A future instance of this task will take care of it instead.
					if ((!empty($msgOptions['modify_time']) ? $msgOptions['modify_time'] : $msgOptions['poster_time']) < $real_modified_time) {
						return true;
					}
				}

				$this->mention_mail_time = (!empty($msgOptions['modify_time']) ? $msgOptions['modify_time'] : $msgOptions['poster_time']) + self::MENTION_DELAY * 60;
			}
		}

		$this->members['all'] = array_unique(array_merge(array_keys($this->members['watching']), array_keys($this->members['quoted']), array_keys($this->members['mentioned'])));

		if (empty($this->members['all'])) {
			return true;
		}

		$this->prefs = Notify::getNotifyPrefs($this->members['all'], '', true);

		// May as well disable these, since they'll be stripped out anyway.
		$disable = ['attach', 'img', 'iurl', 'url', 'youtube'];

		if (!empty(Config::$modSettings['disabledBBC'])) {
			$disabledBBC = Config::$modSettings['disabledBBC'];
			$disable = array_unique(array_merge($disable, explode(',', Config::$modSettings['disabledBBC'])));
		}
		Config::$modSettings['disabledBBC'] = implode(',', $disable);

		// Notify any members who were mentioned.
		if (!empty($this->members['mentioned'])) {
			$this->handleMentionedNotifications();
		}

		// Notify any members who were quoted.
		if (!empty($this->members['quoted'])) {
			$this->handleQuoteNotifications();
		}

		// Handle rest of the notifications for watched topics and boards
		if (!empty($this->members['watching'])) {
			$this->handleWatchedNotifications();
		}

		// Put this back the way we found it.
		if (!empty($disabledBBC)) {
			Config::$modSettings['disabledBBC'] = $disabledBBC;
		}

		// Track what we sent.
		$members_to_log = array_intersect($this->members['emailed'], array_keys($this->members['watching']));

		if (!empty($members_to_log)) {
			Db::$db->query(
				'',
				'UPDATE {db_prefix}log_notify
				SET sent = {int:is_sent}
				WHERE ' . ($type == 'topic' ? 'id_board = {int:board}' : 'id_topic = {int:topic}') . '
					AND id_member IN ({array_int:members})',
				[
					'topic' => $topicOptions['id'],
					'board' => $topicOptions['board'],
					// 'members' => $this->members['emailed'],
					'members' => $members_to_log,
					'is_sent' => 1,
				],
			);
		}

		// Insert it into the digest for daily/weekly notifications
		if ($type != 'edit' && empty($this->_details['respawns'])) {
			Db::$db->insert(
				'',
				'{db_prefix}log_digest',
				[
					'id_topic' => 'int',
					'id_msg' => 'int',
					'note_type' => 'string',
					'exclude' => 'int',
				],
				[
					[
						$topicOptions['id'],
						$msgOptions['id'],
						$type,
						$posterOptions['id'],
					],
				],
				[],
			);
		}

		// Insert the alerts if any
		$this->updateAlerts((int) $msgOptions['id']);

		// If there is anyone still to notify via email, create a new task later.
		$unnotified = array_diff_key($unnotified, array_flip($this->members['emailed']));

		if (!empty($unnotified) || !empty($msgOptions['mentioned_members']) || !empty($msgOptions['quoted_members'])) {
			$new_details = $this->_details;

			if (empty($new_details['respawns'])) {
				$new_details['respawns'] = 0;
			}

			if ($new_details['respawns']++ < 10) {
				Db::$db->insert(
					'',
					'{db_prefix}background_tasks',
					[
						'task_class' => 'string',
						'task_data' => 'string',
						'claimed_time' => 'int',
					],
					[
						[
							'SMF\\Tasks\\CreatePost_Notify',
							Utils::jsonEncode($new_details),
							max(0, $this->mention_mail_time - TaskRunner::MAX_CLAIM_THRESHOLD),
						],
					],
					['id_task'],
				);
			}
		}

		return true;
	}

	/**
	 * Update an alert if a message was updated since the alert was created.
	 *
	 * @param int $msg_id Message ID to update
	 */
	private function updateAlerts(int $msg_id): void
	{
		// We send alerts only on the first iteration of this task.
		if (!empty($this->_details['respawns'])) {
			return;
		}

		// Delete alerts about any mentions and quotes that no longer exist.
		if ($this->_details['type'] == 'edit') {
			$old_alerts = [];

			$request = Db::$db->query(
				'',
				'SELECT content_action, id_member
				FROM {db_prefix}user_alerts
				WHERE content_id = {int:msg_id}
					AND content_type = {literal:msg}
					AND (content_action = {literal:quote} OR content_action = {literal:mention})',
				[
					'msg_id' => $msg_id,
				],
			);

			if (Db::$db->num_rows($request) != 0) {
				while ($row = Db::$db->fetch_assoc($request)) {
					$old_alerts[$row['content_action']][$row['id_member']] = $row['id_member'];
				}
			}
			Db::$db->free_result($request);

			if (!empty($old_alerts)) {
				$request = Db::$db->query(
					'',
					'SELECT content_type, id_mentioned
					FROM {db_prefix}mentions
					WHERE content_id = {int:msg_id}
						AND (content_type = {literal:quote} OR content_type = {literal:msg})',
					[
						'msg_id' => $msg_id,
					],
				);

				while ($row = Db::$db->fetch_assoc($request)) {
					$content_action = $row['content_type'] == 'quote' ? 'quote' : 'mention';
					unset($old_alerts[$content_action][$row['id_mentioned']]);
				}
				Db::$db->free_result($request);

				$conditions = [];

				if (!empty($old_alerts['quote'])) {
					$conditions[] = '(content_action = {literal:quote} AND id_member IN ({array_int:members_not_quoted}))';
				}

				if (!empty($old_alerts['mention'])) {
					$conditions[] = '(content_action = {literal:mention} AND id_member IN ({array_int:members_not_mentioned}))';
				}

				if (!empty($conditions)) {
					Alert::deleteWhere(
						[
							'content_id = {int:msg_id}',
							'content_type = {literal:msg}',
							implode(' OR ', $conditions),
						],
						[
							'msg_id' => $msg_id,
							'members_not_quoted' => empty($old_alerts['quote']) ? [0] : $old_alerts['quote'],
							'members_not_mentioned' => empty($old_alerts['mention']) ? [0] : $old_alerts['mention'],
						],
					);
				}
			}
		}

		// Insert the new alerts.
		if (!empty($this->alert_rows)) {
			Alert::createBatch($this->alert_rows);
		}
	}

	/**
	 * Notifies members about new posts in topics they are watching
	 * and new topics in boards they are watching.
	 */
	protected function handleWatchedNotifications(): void
	{
		$msgOptions = &$this->_details['msgOptions'];
		$topicOptions = &$this->_details['topicOptions'];
		$posterOptions = &$this->_details['posterOptions'];
		$type = &$this->_details['type'];

		$user_ids = array_keys($this->members['watching']);

		if (!in_array($posterOptions['id'], $user_ids)) {
			$user_ids[] = $posterOptions['id'];
		}
		User::load($user_ids, User::LOAD_BY_ID, 'minimal');

		$parsed_message = [];

		foreach ($this->members['watching'] as $member_id => $member_data) {
			if (in_array($member_id, $this->members['done'])) {
				continue;
			}

			$frequency = $this->prefs[$member_id]['msg_notify_pref'] ?? self::FREQUENCY_NOTHING;
			$notify_types = !empty($this->prefs[$member_id]['msg_notify_type']) ? $this->prefs[$member_id]['msg_notify_type'] : self::NOTIFY_TYPE_REPLIES_AND_MODERATION;

			// Don't send a notification if:
			// 1. The watching member ignored the member who did the action.
			if (!empty($member_data['pm_ignore_list']) && in_array($member_data['id_member_updated'], explode(',', $member_data['pm_ignore_list']))) {
				continue;
			}

			// 2. The watching member is not interested in moderation on this topic.
			if (!in_array($type, ['reply', 'topic']) && ($notify_types == self::NOTIFY_TYPE_ONLY_REPLIES || ($notify_types == self::NOTIFY_TYPE_REPLIES_AND_OWN_TOPIC_MODERATION && $member_id != $member_data['id_member_started']))) {
				continue;
			}

			// 3. This is the watching member's own post.
			if (in_array($type, ['reply', 'topic']) && $member_id == $posterOptions['id']) {
				continue;
			}

			// 4. The watching member doesn't want any notifications at all.
			if ($notify_types == self::NOTIFY_TYPE_NOTHING) {
				continue;
			}

			// 5. The watching member doesn't want notifications until later.
			if (in_array($frequency, [
				self::FREQUENCY_NOTHING,
				self::FREQUENCY_DAILY_DIGEST,
				self::FREQUENCY_WEEKLY_DIGEST])) {
				continue;
			}

			// 6. We already sent one and the watching member doesn't want more.
			if ($frequency == self::FREQUENCY_FIRST_UNREAD_MSG && $member_data['sent']) {
				continue;
			}

			// 7. The watching member isn't on club security's VIP list.
			if (!empty($this->_details['members_only']) && !in_array($member_id, $this->_details['members_only'])) {
				continue;
			}

			// Watched topic?
			if (!empty($member_data['id_topic']) && $type != 'topic' && !empty($this->prefs[$member_id])) {
				$pref = !empty($this->prefs[$member_id]['topic_notify_' . $topicOptions['id']]) ?
					$this->prefs[$member_id]['topic_notify_' . $topicOptions['id']] :
					(!empty($this->prefs[$member_id]['topic_notify']) ? $this->prefs[$member_id]['topic_notify'] : 0);

				$message_type = 'notification_' . $type;

				if ($type == 'reply') {
					if (empty(Config::$modSettings['disallow_sendBody']) && !empty($this->prefs[$member_id]['msg_receive_body'])) {
						$message_type .= '_body';
					}

					if (!empty($frequency)) {
						$message_type .= '_once';
					}
				}

				$content_type = 'topic';
			}
			// A new topic in a watched board then?
			elseif ($type == 'topic') {
				$pref = !empty($this->prefs[$member_id]['board_notify_' . $topicOptions['board']]) ?
					$this->prefs[$member_id]['board_notify_' . $topicOptions['board']] :
					(!empty($this->prefs[$member_id]['board_notify']) ? $this->prefs[$member_id]['board_notify'] : 0);

				$content_type = 'board';

				$message_type = !empty($frequency) && $frequency == 2 ? 'notify_boards_once' : 'notify_boards';

				if (empty(Config::$modSettings['disallow_sendBody']) && !empty($this->prefs[$member_id]['msg_receive_body'])) {
					$message_type .= '_body';
				}
			}

			// Censor and parse BBC in the receiver's localization. Don't repeat unnecessarily.
			Lang::load('General+Modifications+ThemeStrings', $member_data['lngfile'], false);

			$localization = implode('|', [$member_data['lngfile'], $member_data['time_offset'], $member_data['time_format']]);

			if (empty($parsed_message[$localization])) {
				// Use the target member's localization settings.
				Parser::$time_offset = $member_data['time_offset'];
				Parser::$time_format = $member_data['time_format'];
				Parser::$smiley_set = $member_data['smiley_set'];
				Parser::$locale = Lang::$txt['lang_locale'];

				$parsed_message[$localization]['subject'] = $msgOptions['subject'];
				$parsed_message[$localization]['body'] = $msgOptions['body'];

				Lang::censorText($parsed_message[$localization]['subject']);
				Lang::censorText($parsed_message[$localization]['body']);

				$parsed_message[$localization]['subject'] = Utils::htmlspecialcharsDecode($parsed_message[$localization]['subject']);

				$parsed_message[$localization]['body'] = strtr(
					Parser::transform(
						$parsed_message[$localization]['body'],
						Parser::INPUT_BBC | Parser::INPUT_MARKDOWN,
					),
					[
						'<br>' => "\n",
						'</div>' => "\n",
						'</li>' => "\n",
						'&#91;' => '[',
						'&#93;' => ']',
						'&#39;' => '\'',
						'</tr>' => "\n",
						'</td>' => "\t",
						'<hr>' => "\n" . str_repeat('-', 63) . "\n",
					],
				);

				$parsed_message[$localization]['body'] = trim(Utils::htmlspecialcharsDecode(strip_tags($parsed_message[$localization]['body'])));

				// Go back to the default localization settings.
				if (!isset(User::$me)) {
					User::setMe(0);
				}

				Parser::$time_offset = User::$me->time_offset;
				Parser::$time_format = User::$me->$time_format;
				Parser::$smiley_set = (!empty(User::$me->smiley_set) ? User::$me->smiley_set : (!empty(Config::$modSettings['smiley_sets_default']) ? Config::$modSettings['smiley_sets_default'] : 'none'));
				Parser::$locale = Lang::getLocaleFromLanguageName(User::$me->$language);
			}

			// Bitwise check: Receiving an alert?
			if ($pref & self::RECEIVE_NOTIFY_ALERT) {
				$this->alert_rows[] = [
					'alert_time' => time(),
					'id_member' => (int) $member_id,
					// Only tell sender's information for new topics and replies
					'id_member_started' => in_array($type, ['topic', 'reply']) ? (int) $posterOptions['id'] : 0,
					'member_name' => in_array($type, ['topic', 'reply']) ? $posterOptions['name'] : '',
					'content_type' => $content_type,
					'content_id' => (int) $topicOptions['id'],
					'content_action' => $type,
					'is_read' => 0,
					'extra' => Utils::jsonEncode([
						'topic' => (int) $topicOptions['id'],
						'board' => (int) $topicOptions['board'],
						'content_subject' => $parsed_message[$localization]['subject'],
						'content_link' => Config::$scripturl . '?topic=' . $topicOptions['id'] . (in_array($type, ['reply', 'topic']) ? '.new;topicseen#new' : '.0'),
					]),
				];
			}

			// Bitwise check: Receiving an email notification?
			if ($pref & self::RECEIVE_NOTIFY_EMAIL) {
				$itemID = $content_type == 'board' ? (int) $topicOptions['board'] : (int) $topicOptions['id'];

				$token = Notify::createUnsubscribeToken((int) $member_data['id_member'], $member_data['email_address'], $content_type, $itemID);

				$replacements = [
					'TOPICSUBJECT' => $parsed_message[$localization]['subject'],
					'POSTERNAME' => Utils::htmlspecialcharsDecode(User::$loaded[$posterOptions['id']]->name ?? $posterOptions['name']),
					'TOPICLINK' => Config::$scripturl . '?topic=' . $topicOptions['id'] . '.new#new',
					'MESSAGE' => $parsed_message[$localization]['body'],
					'UNSUBSCRIBELINK' => Config::$scripturl . '?action=notify' . $content_type . ';' . $content_type . '=' . $itemID . ';sa=off;u=' . $member_data['id_member'] . ';token=' . $token,
				];

				$emaildata = Mail::loadEmailTemplate($message_type, $replacements, $member_data['lngfile']);
				$mail_result = Mail::send($member_data['email_address'], $emaildata['subject'], $emaildata['body'], null, 'm' . $topicOptions['id'], $emaildata['is_html']);

				if ($mail_result !== false) {
					$this->members['emailed'][] = $member_id;
				}
			}

			$this->members['done'][] = $member_id;
		}
	}

	/**
	 * Notifies members when their posts are quoted in other posts.
	 */
	protected function handleQuoteNotifications(): void
	{
		$msgOptions = &$this->_details['msgOptions'];
		$posterOptions = &$this->_details['posterOptions'];

		User::load($posterOptions['id'], User::LOAD_BY_ID, 'minimal');

		foreach ($this->members['quoted'] as $member_id => $member_data) {
			if (in_array($member_id, $this->members['done'])) {
				continue;
			}

			if (!isset($this->prefs[$member_id]) || empty($this->prefs[$member_id]['msg_quote'])) {
				continue;
			}

			$pref = $this->prefs[$member_id]['msg_quote'];

			// You don't need to be notified about quoting yourself.
			if ($member_id == $posterOptions['id']) {
				continue;
			}

			// Bitwise check: Receiving an alert?
			if ($pref & self::RECEIVE_NOTIFY_ALERT) {
				$this->alert_rows[] = [
					'alert_time' => time(),
					'id_member' => $member_data['id'],
					'id_member_started' => $posterOptions['id'],
					'member_name' => $posterOptions['name'],
					'content_type' => 'msg',
					'content_id' => $msgOptions['id'],
					'content_action' => 'quote',
					'is_read' => 0,
					'extra' => Utils::jsonEncode([
						'content_subject' => $msgOptions['subject'],
						'content_link' => Config::$scripturl . '?msg=' . $msgOptions['id'],
					]),
				];
			}

			// Bitwise check: Receiving an email notification?
			if (!($pref & self::RECEIVE_NOTIFY_EMAIL)) {
				// Don't want an email, so forget this member in any respawned tasks.
				unset($msgOptions['quoted_members'][$member_id]);
			} elseif (TIME_START >= $this->mention_mail_time || in_array($member_id, $this->members['watching'])) {
				$replacements = [
					'CONTENTSUBJECT' => $msgOptions['subject'],
					'QUOTENAME' => Utils::htmlspecialcharsDecode(User::$loaded[$posterOptions['id']]->name ?? $posterOptions['name']),
					'MEMBERNAME' => $member_data['real_name'],
					'CONTENTLINK' => Config::$scripturl . '?msg=' . $msgOptions['id'],
				];

				$emaildata = Mail::loadEmailTemplate('msg_quote', $replacements, empty($member_data['lngfile']) || empty(Config::$modSettings['userLanguage']) ? Lang::$default : $member_data['lngfile']);
				$mail_result = Mail::send($member_data['email_address'], $emaildata['subject'], $emaildata['body'], null, 'msg_quote_' . $msgOptions['id'], $emaildata['is_html'], 2);

				if ($mail_result !== false) {
					// Don't send multiple notifications about the same post.
					$this->members['emailed'][] = $member_id;

					// Ensure respawned tasks don't send this again.
					unset($msgOptions['quoted_members'][$member_id]);
				}
			}

			$this->members['done'][] = $member_id;
		}
	}

	/**
	 * Notifies members when they are mentioned in other members' posts.
	 */
	protected function handleMentionedNotifications(): void
	{
		$msgOptions = &$this->_details['msgOptions'];

		foreach ($this->members['mentioned'] as $member_id => $member_data) {
			if (in_array($member_id, $this->members['done'])) {
				continue;
			}

			if (empty($this->prefs[$member_id]) || empty($this->prefs[$member_id]['msg_mention'])) {
				continue;
			}

			$pref = $this->prefs[$member_id]['msg_mention'];

			// Mentioning yourself is silly, and we aren't going to notify you about it.
			if ($member_id == $member_data['mentioned_by']['id']) {
				continue;
			}

			// Bitwise check: Receiving an alert?
			if ($pref & self::RECEIVE_NOTIFY_ALERT) {
				$this->alert_rows[] = [
					'alert_time' => time(),
					'id_member' => $member_data['id'],
					'id_member_started' => $member_data['mentioned_by']['id'],
					'member_name' => $member_data['mentioned_by']['name'],
					'content_type' => 'msg',
					'content_id' => $msgOptions['id'],
					'content_action' => 'mention',
					'is_read' => 0,
					'extra' => Utils::jsonEncode([
						'content_subject' => $msgOptions['subject'],
						'content_link' => Config::$scripturl . '?msg=' . $msgOptions['id'],
					]),
				];
			}

			// Bitwise check: Receiving an email notification?
			if (!($pref & self::RECEIVE_NOTIFY_EMAIL)) {
				// Don't want an email, so forget this member in any respawned tasks.
				unset($msgOptions['mentioned_members'][$member_id]);
			} elseif (TIME_START >= $this->mention_mail_time || in_array($member_id, $this->members['watching'])) {
				$replacements = [
					'CONTENTSUBJECT' => $msgOptions['subject'],
					'MENTIONNAME' => $member_data['mentioned_by']['name'],
					'MEMBERNAME' => $member_data['real_name'],
					'CONTENTLINK' => Config::$scripturl . '?msg=' . $msgOptions['id'],
				];

				$emaildata = Mail::loadEmailTemplate('msg_mention', $replacements, empty($member_data['lngfile']) || empty(Config::$modSettings['userLanguage']) ? Lang::$default : $member_data['lngfile']);
				$mail_result = Mail::send($member_data['email_address'], $emaildata['subject'], $emaildata['body'], null, 'msg_mention_' . $msgOptions['id'], $emaildata['is_html'], 2);

				if ($mail_result !== false) {
					// Don't send multiple notifications about the same post.
					$this->members['emailed'][] = $member_id;

					// Ensure respawned tasks don't send this again.
					unset($msgOptions['mentioned_members'][$member_id]);
				}
			}

			$this->members['done'][] = $member_id;
		}
	}
}

?>