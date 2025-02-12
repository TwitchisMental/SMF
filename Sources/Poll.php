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

namespace SMF;

use SMF\Db\DatabaseApi as Db;

/**
 * Represents a poll.
 *
 * Contains methods for doing just about everything regarding polls.
 */
class Poll implements \ArrayAccess
{
	use ArrayAccessHelper;

	/*****************
	 * Class constants
	 *****************/

	// The LOAD_* constants indicate how to find the poll we want.
	public const LOAD_BY_ID = 0;
	public const LOAD_BY_TOPIC = 1;
	public const LOAD_BY_RECENT = 2;
	public const LOAD_BY_VOTES = 4;

	// The CHECK_* constants are used to filter the results while loading.
	public const CHECK_ACCESS = 8;
	public const CHECK_IGNORE = 16;
	public const CHECK_LOCKED = 32;
	public const CHECK_EXPIRY = 64;

	/*******************
	 * Public properties
	 *******************/

	/**
	 * @var ?int
	 *
	 * This poll's ID number.
	 */
	public ?int $id;

	/**
	 * @var string
	 *
	 * The question for this poll.
	 */
	public string $question = '';

	/**
	 * @var int
	 *
	 * Whether voting is locked for this poll.
	 * 0 = not locked, 1 = locked by user, 2 = locked by moderator.
	 */
	public int $voting_locked = 0;

	/**
	 * @var int
	 *
	 * How many different choices the user can vote for.
	 * In other words, values greater than one mean multiple choice.
	 */
	public int $max_votes = 1;

	/**
	 * @var int
	 *
	 * Unix timestamp when the poll closes.
	 */
	public int $expire_time = 0;

	/**
	 * @var int
	 *
	 * The mode for hiding or showing results to the user.
	 */
	public int $hide_results = 0;

	/**
	 * @var bool
	 *
	 * Whether users can change their votes.
	 */
	public bool $change_vote = false;

	/**
	 * @var bool
	 *
	 * Whether guests can vote in this poll.
	 *
	 * Even if this is true, they can only vote if self::$guest_vote_enabled is
	 * also true.
	 */
	public bool $guest_vote = false;

	/**
	 * @var int
	 *
	 * How many guests have voted.
	 */
	public int $num_guest_voters = 0;

	/**
	 * @var int
	 *
	 * Unix timestamp when the poll's votes were reset.
	 *
	 * If zero, the poll has never been reset.
	 */
	public int $reset_poll = 0;

	/**
	 * @var int
	 *
	 * ID of the member who created the poll.
	 */
	public int $member = 0;

	/**
	 * @var string
	 *
	 * Name of the member who created the poll.
	 */
	public string $poster_name = '';

	/**
	 * @var array
	 *
	 * The available choices for this poll.
	 */
	public array $choices = [];

	/**
	 * @var int
	 *
	 * Total number of votes cast in this poll.
	 */
	public int $total = 0;

	/**
	 * @var int
	 *
	 * Total number of votes cast in this poll.
	 */
	public int $total_voters = 0;

	/**
	 * @var array
	 *
	 * IDs of members who have voted in this poll.
	 */
	public array $voters = [];

	/**
	 * @var bool
	 *
	 * Whether the current user has voted in this poll.
	 */
	public bool $has_voted = false;

	/**
	 * @var int
	 *
	 * ID of this poll's topic.
	 */
	public int $topic = 0;

	/**
	 * @var array
	 *
	 * Permissions that the current user has regarding this poll.
	 */
	public array $permissions = [
		'allow_lock_poll' => false,
		'allow_edit_poll' => false,
		'can_remove_poll' => false,
		'allow_vote' => false,
		'allow_results_view' => false,
		'allow_change_vote' => false,
		'allow_return_vote' => false,
	];

	/**
	 * @var array
	 *
	 * Formatted versions of this poll's properties, suitable for display.
	 */
	public array $formatted = [];

	/**************************
	 * Public static properties
	 **************************/

	/**
	 * @var array
	 *
	 * All loaded instances of this class.
	 */
	public static array $loaded = [];

	/*********************
	 * Internal properties
	 *********************/

	/**
	 * @var array
	 *
	 * SQL select statements to use when loading data.
	 */
	protected array $selects = [
		'pc.*',
		'p.*',
		'COALESCE(mem.real_name, p.poster_name) AS poster_name',
	];

	/**
	 * @var array
	 *
	 * SQL join statements to use when loading data.
	 */
	protected array $joins = [
		'pc' => 'LEFT JOIN {db_prefix}poll_choices AS pc ON (pc.id_poll = p.id_poll)',
		'mem' => 'LEFT JOIN {db_prefix}members AS mem ON (mem.id_member = p.id_member)',
	];

	/**
	 * @var array
	 *
	 * SQL where statements to use when loading data.
	 */
	protected array $where = ['1=1'];

	/**
	 * @var array
	 *
	 * SQL order by statements to use when loading data.
	 */
	protected array $order = ['p.id_poll DESC'];

	/**
	 * @var array
	 *
	 * Parameters for the SQL query when loading data.
	 */
	protected array $params = [];

	/**
	 * @var array
	 *
	 * Alternate names for some object properties.
	 */
	protected array $prop_aliases = [
		'id_poll' => 'id',
		'id_member' => 'member',
		'expire' => 'expire_time',
		'hide' => 'hide_results',
		'id_topic' => 'topic',
		'options' => 'choices',
	];

	/****************************
	 * Internal static properties
	 ****************************/

	/**
	 * @var bool
	 *
	 * Whether guests can vote in this board.
	 *
	 * Even if this is true, they can only vote in a particular poll if
	 * $this->guest_vote is also true.
	 */
	protected static bool $guest_vote_enabled;

	/****************
	 * Public methods
	 ****************/

	/**
	 * Sets the values of $this->permissions.
	 *
	 * Used when deciding what the current user can do with an existing poll.
	 */
	public function buildPermissions(): void
	{
		$is_expired = !empty($this->expire_time) && $this->expire_time < time();
		$board = $this->board ?? (Board::$info->id ?? null);

		$this->permissions['allow_lock_poll'] = User::$me->allowedTo('poll_lock_any', $board) || (User::$me->id == $this->member && User::$me->allowedTo('poll_lock_own', $board));

		$this->permissions['allow_edit_poll'] = User::$me->allowedTo('poll_edit_any', $board) || (User::$me->id == $this->member && User::$me->allowedTo('poll_edit_own', $board));

		$this->permissions['can_remove_poll'] = User::$me->allowedTo('poll_remove_any', $board) || (User::$me->id == $this->member && User::$me->allowedTo('poll_remove_own', $board));

		// You're allowed to vote if:
		// 1. the poll did not expire, and
		// 2. you're either not a guest OR guest voting is enabled... and
		// 3. you're not trying to view the results, and
		// 4. the poll is not locked, and
		// 5. you have the proper permissions, and
		// 6. you haven't already voted before.
		$this->permissions['allow_vote'] = !$is_expired && (!User::$me->is_guest || ($this->guest_vote && User::$me->allowedTo('poll_vote', $board))) && empty($this->voting_locked) && User::$me->allowedTo('poll_vote', $board) && !$this->has_voted;

		// You're allowed to view the results if:
		// 1. you're just a super-nice-guy, or
		// 2. anyone can see them (hide_results == 0), or
		// 3. you can see them after you voted (hide_results == 1), or
		// 4. you've waited long enough for the poll to expire. (whether hide_results is 1 or 2.)
		$this->permissions['allow_results_view'] = User::$me->allowedTo('moderate_board', $board) || $this->hide_results == 0 || ($this->hide_results == 1 && $this->has_voted) || $is_expired;

		// Aliases for the sake of backward compatibility.
		$this->permissions['allow_poll_view'] = &$this->permissions['allow_results_view'];
		$this->permissions['allow_view_results'] = &$this->permissions['allow_results_view'];

		// You're allowed to change your vote if:
		// 1. the poll did not expire, and
		// 2. you're not a guest... and
		// 3. the poll is not locked, and
		// 4. you have the proper permissions, and
		// 5. you have already voted, and
		// 6. the poll creator has said you can!
		$this->permissions['allow_change_vote'] = !$is_expired && !User::$me->is_guest && !$this->voting_locked && User::$me->allowedTo('poll_vote', $board) && $this->has_voted && $this->change_vote;

		// You're allowed to return to voting options if:
		// 1. you are (still) allowed to vote.
		// 2. you are currently seeing the results.
		$this->permissions['allow_return_vote'] = $this->permissions['allow_vote'] && $this->permissions['allow_results_view'] && !empty($this->viewresults);

		// Make these permissions available in Utils::$context.
		foreach ($this->permissions as $key => $value) {
			Utils::$context[$key] = &$this->permissions[$key];
		}
	}

	/**
	 * Formats the poll data for use in templates.
	 *
	 * Result will include everything necessary to vote, view, or edit.
	 *
	 * @param array $format_options Options to control output.
	 * @return array A copy of $this->formatted.
	 */
	public function format(array $format_options = []): array
	{
		$this->viewresults = isset($_REQUEST['viewresults']) || isset($_REQUEST['viewResults']);

		$this->buildPermissions();

		Lang::censorText($this->question);

		$this->formatted = [
			'id' => $this->id ?? 0,
			'image' => 'normal_' . (empty($this->voting_locked) ? 'poll' : 'locked_poll'),
			'question' => Parser::transform($this->question),
			'max_votes' => $this->max_votes,
			'total_votes' => $this->total_voters,
			'guest_vote' => $this->guest_vote,
			'guest_vote_enabled' => self::canGuestsVote(),
			'change_vote' => !empty($this->change_vote),
			'hide_results' => $this->hide_results,
			'is_locked' => !empty($this->voting_locked),
			'choices' => [],
			'allow_vote' => $this->permissions['allow_vote'] && !$this->has_voted,
			'allow_view_results' => $this->permissions['allow_results_view'],
			'lock' => $this->permissions['allow_lock_poll'],
			'edit' => $this->permissions['allow_edit_poll'],
			'remove' => $this->permissions['can_remove_poll'],
			'allowed_warning' => $this->max_votes > 1 ? Lang::getTxt('poll_options_limit', [min(count($this->choices), $this->max_votes)]) : '',
			'is_expired' => !empty($this->expire_time) && $this->expire_time < time(),
			'expire_time' => !empty($this->expire_time) ? Time::create('@' . $this->expire_time)->format() : 0,
			'expiration' => empty($this->expire_time) ? '' : ceil($this->expire_time <= time() ? -1 : ($this->expire_time - time()) / (3600 * 24)),
			'has_voted' => !empty($this->has_voted),
			'starter' => [
				'id' => $this->id_member,
				'name' => $this->poster_name,
				'href' => $this->id_member == 0 ? '' : Config::$scripturl . '?action=profile;u=' . $this->id_member,
				'link' => $this->id_member == 0 ? $this->poster_name : '<a href="' . Config::$scripturl . '?action=profile;u=' . $this->id_member . '">' . $this->poster_name . '</a>',
			],
			'buttons' => [],
		];

		if (isset($this->topic)) {
			$this->formatted['topic'] = $this->topic;
		}

		// Backward compatibility.
		$this->formatted['options'] = &$this->formatted['choices'];
		$this->formatted['hide'] = &$this->formatted['hide_results'];
		$this->formatted['expire'] = &$this->formatted['expire_time'];
		$this->formatted['guest_vote_allowed'] = &$this->formatted['guest_vote_enabled'];

		// Next up: format the choices.
		$bar_calc_total = $this->max_votes > 1 ? $this->total_voters : $this->total;

		// Calculate the percentages and bar lengths...
		$divisor = $bar_calc_total == 0 ? 1 : $bar_calc_total;

		// Determine if a decimal point is needed in order for the options to add to 100%.
		$precision = $bar_calc_total == 100 ? 0 : 1;

		// Now look through each option, and...
		$choice_number = 0;

		foreach ($this->choices as $i => $option) {
			Lang::censorText($option->label);

			// First calculate the percentage, and then the width of the bar...
			$bar = round(($option->votes * 100) / $divisor, $precision);
			$barWide = $bar == 0 ? 1 : floor(($bar * 8) / 3);

			$label = Parser::transform($option->label);

			// Now add it to the poll's contextual theme data.
			$this->formatted['choices'][$i] = [
				'id' => 'options-' . $i,
				'number' => ++$choice_number,
				'percent' => $bar,
				'votes' => $option->votes,
				'voted_this' => $option->voted_this != -1,
				'bar_ndt' => $bar > 0 ? '<div class="bar" style="width: ' . $bar . '%;"></div>' : '',
				'bar_width' => $barWide,
				'label' => $label,
				'vote_button' => '<input type="' . ($this->max_votes > 1 ? 'checkbox' : 'radio') . '" name="options[]" id="options-' . $i . '" value="' . $i . '">',
			];

			$this->formatted['choices'][$i]['option'] = &$this->formatted['choices'][$i]['label'];
		}

		// Show the results if:
		// 1. You're allowed to see them (see above), and
		// 2. $_REQUEST['viewresults'] or $_REQUEST['viewResults'] is set
		$this->formatted['show_results'] = $this->permissions['allow_results_view'] && $this->viewresults;

		Utils::$context['poll_buttons'] = &$this->formatted['buttons'];

		if (!empty($format_options['no_buttons']) || empty($this->topic) || !isset(Utils::$context['start'])) {
			return $this->formatted;
		}

		// Show the view results button if:
		// 1. You can vote in the poll (see above), and
		// 2. Results are visible to everyone (hidden = 0), and
		// 3. You aren't already viewing the results
		$show_view_results_button = $this->permissions['allow_vote'] && $this->permissions['allow_results_view'] && !$this->formatted['show_results'];

		// Build the poll moderation button array.
		if ($this->permissions['allow_return_vote']) {
			$this->formatted['buttons']['vote'] = [
				'text' => 'poll_return_vote',
				'image' => 'poll_options.png',
				'url' => Config::$scripturl . '?topic=' . $this->topic . '.' . Utils::$context['start'],
			];
		}

		if ($show_view_results_button) {
			$this->formatted['buttons']['results'] = [
				'text' => 'poll_results',
				'image' => 'poll_results.png',
				'url' => Config::$scripturl . '?topic=' . $this->topic . '.' . Utils::$context['start'] . ';viewresults',
			];
		}

		if ($this->permissions['allow_change_vote'] && isset(Utils::$context['session_var'])) {
			$this->formatted['buttons']['change_vote'] = [
				'text' => 'poll_change_vote',
				'image' => 'poll_change_vote.png',
				'url' => Config::$scripturl . '?action=vote;topic=' . $this->topic . '.' . Utils::$context['start'] . ';' . Utils::$context['session_var'] . '=' . Utils::$context['session_id'],
			];
		}

		if ($this->permissions['allow_lock_poll'] && isset(Utils::$context['session_var'])) {
			$this->formatted['buttons']['lock'] = [
				'text' => (!$this->voting_locked ? 'poll_lock' : 'poll_unlock'),
				'image' => 'poll_lock.png',
				'url' => Config::$scripturl . '?action=lockvoting;topic=' . $this->topic . '.' . Utils::$context['start'] . ';' . Utils::$context['session_var'] . '=' . Utils::$context['session_id'],
			];
		}

		if ($this->permissions['allow_edit_poll']) {
			$this->formatted['buttons']['edit'] = [
				'text' => 'poll_edit',
				'image' => 'poll_edit.png',
				'url' => Config::$scripturl . '?action=editpoll;topic=' . $this->topic . '.' . Utils::$context['start'],
			];
		}

		if ($this->permissions['can_remove_poll'] && isset(Utils::$context['session_var'])) {
			$this->formatted['buttons']['remove_poll'] = [
				'text' => 'poll_remove',
				'image' => 'admin_remove_poll.png',
				'custom' => 'data-confirm="' . Lang::$txt['poll_remove_warn'] . '"',
				'class' => 'you_sure',
				'url' => Config::$scripturl . '?action=removepoll;topic=' . $this->topic . '.' . Utils::$context['start'] . ';' . Utils::$context['session_var'] . '=' . Utils::$context['session_id'],
			];
		}

		// Allow mods to add additional buttons here
		IntegrationHook::call('integrate_poll_buttons');

		return $this->formatted;
	}

	/**
	 * Adds a new PollChoice object to $this->choices.
	 */
	public function addChoice(array $choice_props, bool $allow_empty = false): void
	{
		// Clean up the label.
		$choice_props['label'] = isset($choice_props['label']) ? Utils::htmlTrim(Utils::normalizeSpaces((string) $choice_props['label'])) : '';

		if (!$allow_empty && $choice_props['label'] === '') {
			return;
		}

		// Standardize id_choice to id.
		if (isset($choice_props['id_choice'])) {
			$choice_props['id'] = $choice_props['id_choice'];
			unset($choice_props['id_choice']);
		}

		// Standardize id_poll to poll.
		if (isset($choice_props['id_poll'])) {
			$choice_props['poll'] = $choice_props['id_poll'];
			unset($choice_props['id_poll']);
		}

		$choice_props['id'] = (int) ($choice_props['id'] ?? count($this->choices));
		$choice_props['poll'] = (int) ($choice_props['poll'] ?? ($this->id ?? 0));
		$choice_props['votes'] = (int) ($choice_props['votes'] ?? 0);
		$choice_props['new'] = !empty($choice_props['new']);
		$choice_props['voted_this'] = !empty($choice_props['voted_this']);

		$this->choices[$choice_props['id']] = new PollChoice($choice_props);
	}

	/**
	 * Saves this poll to the database.
	 */
	public function save(): void
	{
		$is_edit = !empty($this->id);

		// Saving a new poll.
		if (empty($this->id)) {
			if (!self::checkCreatePermission()) {
				return;
			}

			$this->id = Db::$db->insert(
				'',
				'{db_prefix}polls',
				[
					'question' => 'string-255',
					'max_votes' => 'int',
					'expire_time' => 'int',
					'hide_results' => 'int',
					'change_vote' => 'int',
					'guest_vote' => 'int',
					'id_member' => 'int',
					'poster_name' => 'string-255',
				],
				[
					[
						$this->question,
						(int) $this->max_votes,
						(int) $this->expire_time,
						(int) $this->hide_results,
						(int) $this->change_vote,
						(int) $this->guest_vote,
						(int) $this->id_member,
						$this->poster_name,
					],
				],
				['id_poll'],
				1,
			);

			// Create each answer choice.
			foreach ($this->choices as $choice) {
				$choice->poll = $this->id;
				$choice->save();
			}

			if (!empty($this->topic)) {
				Db::$db->query(
					'',
					'UPDATE {db_prefix}topics
					SET id_poll = {int:id_poll}
					WHERE id_topic = {int:id_topic}',
					[
						'id_poll' => $this->id,
						'id_topic' => $this->topic,
					],
				);
			}

			self::$loaded[$this->id] = $this;
		}
		// Updating an existing poll.
		else {
			if (!self::checkEditPermission($this)) {
				return;
			}

			$set = [
				'question = {string:question}',
				'change_vote = {int:change_vote}',
				'hide_results = {int:hide_results}',
				'voting_locked = {int:voting_locked}',
				'expire_time = {int:expire_time}',
				'max_votes = {int:max_votes}',
				'guest_vote = {int:guest_vote}',
				'reset_poll = {int:reset_poll}',
			];

			$params = [
				'id_poll' => $this->id,
				'question' => $this->question,
				'change_vote' => (int) $this->change_vote,
				'hide_results' => (int) $this->hide_results,
				'voting_locked' => (int) $this->voting_locked,
				'expire_time' => (int) $this->expire_time,
				'max_votes' => (int) $this->max_votes,
				'guest_vote' => (int) $this->guest_vote,
				'reset_poll' => (int) $this->reset_poll,
			];

			if (empty($this->expire_time) && $params['hide_results'] == 2) {
				$params['hide_results'] = 1;
			}

			Db::$db->query(
				'',
				'UPDATE {db_prefix}polls
				SET ' . (implode(', ', $set)) . '
				WHERE id_poll = {int:id_poll}',
				$params,
			);

			foreach ($this->choices as $choice) {
				$choice->save();
			}
		}

		// Let mods know that this poll has been added or edited.
		IntegrationHook::call('integrate_poll_add_edit', [$this->id, $is_edit]);
	}

	/**
	 * Resets the votes on this poll.
	 */
	public function resetVotes(): void
	{
		if (!isset($this->id)) {
			return;
		}

		$this->num_guest_voters = 0;
		$this->reset_poll = time();
		$this->total = 0;
		$this->total_voters = 0;
		$this->voters = [];
		$this->has_voted = false;

		foreach ($this->choices as &$choice) {
			$choice['votes'] = 0;
			$choice['voted_this'] = false;
		}

		Db::$db->query(
			'',
			'UPDATE {db_prefix}polls
			SET num_guest_voters = {int:no_votes}, reset_poll = {int:time}
			WHERE id_poll = {int:id_poll}',
			[
				'no_votes' => 0,
				'id_poll' => $this->id,
				'time' => time(),
			],
		);

		Db::$db->query(
			'',
			'UPDATE {db_prefix}poll_choices
			SET votes = {int:no_votes}
			WHERE id_poll = {int:id_poll}',
			[
				'no_votes' => 0,
				'id_poll' => $this->id,
			],
		);

		Db::$db->query(
			'',
			'DELETE FROM {db_prefix}log_polls
			WHERE id_poll = {int:id_poll}',
			[
				'id_poll' => $this->id,
			],
		);
	}

	/**
	 * Sets custom properties.
	 *
	 * @param string $prop The property name.
	 * @param mixed $value The value to set.
	 */
	public function __set(string $prop, $value): void
	{
		if ($prop === 'choices' || $prop === 'options') {
			foreach ($value as $id_choice => $choice_props) {
				$this->choices[$id_choice] = new PollChoice((array) $choice_props);
			}
		} elseif (property_exists($this, $prop)) {
			if (!isset($this->id) && $prop === 'id') {
				$this->id = (int) $value;
				self::$loaded[$this->id] = $this;

				return;
			}

			settype($value, gettype($this->{$prop}));
			$this->{$prop} = $value;
		} elseif (array_key_exists($prop, $this->prop_aliases)) {
			// Can't unset a virtual property.
			if (is_null($value)) {
				return;
			}

			$real_prop = $this->prop_aliases[$prop];

			if (empty($this->id) && $real_prop === 'id') {
				self::$loaded[$value] = $this;

				if (isset($this->id)) {
					unset(self::$loaded[$this->id]);
				}
			}

			if (str_starts_with($real_prop, '!')) {
				$real_prop = ltrim($real_prop, '!');
				$value = !$value;
			}

			if (str_contains($real_prop, '[')) {
				$real_prop = explode('[', rtrim($real_prop, ']'));

				$this->{$real_prop[0]}[$real_prop[1]] = $value;
			} else {
				if ($real_prop == 'id') {
					$this->{$real_prop} = (int) $value;
				} else {
					settype($value, gettype($this->{$real_prop}));
					$this->{$real_prop} = $value;
				}
			}
		} else {
			$this->custom[$prop] = $value;
		}
	}

	/***********************
	 * Public static methods
	 ***********************/

	/**
	 * Static wrapper for constructor.
	 *
	 * @param int $id The ID number of a poll or topic. Use 0 if unknown.
	 * @param int $options Bitmask of this class's LOAD_* and CHECK_* constants.
	 * @return self An instance of this class.
	 */
	public static function load(int $id, int $options = 0): self
	{
		return new self($id, $options);
	}

	/**
	 * Creates a new instance of this class based on input from $_POST.
	 *
	 * Checks permissions and sanitizes input before doing anything.
	 *
	 * @param array &$errors Will hold errors encountered while creating the poll.
	 * @return self An instance of this class, or null on failure.
	 */
	public static function create(array &$errors = []): ?self
	{
		if (!self::checkCreatePermission()) {
			return null;
		}

		self::sanitizeInput($errors);

		$poll = new self();

		// Set the properties.
		$props = [];

		if (isset($_POST['question'])) {
			$props['question'] = $_POST['question'];
		}

		if (isset($_POST['max_votes'])) {
			$props['max_votes'] = $_POST['max_votes'];
		}

		if (isset($_POST['expire_time'])) {
			$props['expire_time'] = empty($_POST['poll_expire']) ? 0 : time() + $_POST['poll_expire'] * 86400;
		}

		if (isset($_POST['hide_results'])) {
			$props['hide_results'] = $_POST['poll_hide'];
		}

		if (isset($_POST['change_vote'])) {
			$props['change_vote'] = $_POST['poll_change_vote'];
		}

		if (isset($_POST['guest_vote'])) {
			$props['guest_vote'] = $_POST['poll_guest_vote'];
		}

		$props['member'] = User::$me->id;
		$props['poster_name'] = User::$me->name;
		$props['topic'] = Topic::$topic_id;

		$poll->set($props);

		foreach (array_values($_POST['options']) as $id => $label) {
			$poll->addChoice([
				'id' => $id,
				'label' => $label,
				'votes' => 0,
				'new' => true,
			]);
		}

		return $poll;
	}

	/**
	 * Figures out whether guests are allowed to vote in this board.
	 *
	 * @return bool Whether guests can vote.
	 */
	public static function canGuestsVote(): bool
	{
		if (isset(self::$guest_vote_enabled)) {
			return self::$guest_vote_enabled;
		}

		self::$guest_vote_enabled = false;

		if (isset(Board::$info->id)) {
			$groupsAllowedVote = User::groupsAllowedTo('poll_vote', Board::$info->id);
			self::$guest_vote_enabled = in_array(-1, $groupsAllowedVote['allowed']);
		}

		return self::$guest_vote_enabled;
	}

	/**
	 * Verifies that the current user is allowed to create polls in this board.
	 *
	 * If polls are disabled, simply returns false. Otherwise, will die with a
	 * fatal error if the user can't make the poll, or return true if they can.
	 *
	 * @return bool Whether the current user can create a poll.
	 */
	public static function checkCreatePermission(): bool
	{
		if (Config::$modSettings['pollMode'] != 1) {
			return false;
		}

		// New topic, new poll.
		if (empty(Topic::$topic_id)) {
			User::$me->isAllowedTo('poll_post');
		}
		// This is an old topic, but it is theirs!  Can they add to it?
		elseif (User::$me->id == Topic::load()->id_member_started && !User::$me->allowedTo('poll_add_any')) {
			User::$me->isAllowedTo('poll_add_own');
		}
		// If they're not the owner, can they add a poll to any topic?
		else {
			User::$me->isAllowedTo('poll_add_any');
		}

		// At this point, they can create a new poll.
		return true;
	}

	/**
	 * Verifies that the current user is allowed to edit the given poll.
	 *
	 * If polls are disabled or the poll doesn't have an ID number, simply
	 * returns false. Otherwise, will die with a fatal error if the user can't
	 * edit the poll, or return true if they can.
	 *
	 * @param self $poll An instance of this class.
	 * @return bool Whether the current user can edit this poll.
	 */
	public static function checkEditPermission(self $poll): bool
	{
		if (Config::$modSettings['pollMode'] != 1 || empty($poll->id)) {
			return false;
		}

		// If they can edit any poll, they're good to go.
		if (User::$me->allowedTo('poll_edit_any')) {
			return true;
		}

		// Does this poll belong to current user?
		$is_own_topic = User::$me->id == Topic::load($poll->topic ?? null)->id_member_started;
		$is_own_poll = $is_own_topic || (!empty($poll->member) && User::$me->id == $poll->member);

		// Stop dead if they can't edit this poll.
		User::$me->isAllowedTo('poll_edit_' . ($is_own_poll ? 'own' : 'any'));

		// At this point, they can edit the poll.
		return true;
	}

	/**
	 * Verifies that the current user is allowed to remove the given poll.
	 *
	 * @param self $poll An instance of this class.
	 * @return bool Whether the current user can remove this poll.
	 */
	public static function checkRemovePermission(self $poll): bool
	{
		// If they can remove any poll, they're good to go.
		if (User::$me->allowedTo('poll_remove_any')) {
			return true;
		}

		// Does this poll belong to current user?
		$is_own_topic = User::$me->id == Topic::load($poll->topic ?? null)->id_member_started;
		$is_own_poll = $is_own_topic || (!empty($poll->member) && User::$me->id == $poll->member);

		// Stop dead if they can't remove this poll.
		User::$me->isAllowedTo('poll_remove_' . ($is_own_poll ? 'own' : 'any'));

		// At this point, they can remove the poll.
		return true;
	}

	/******************
	 * Internal methods
	 ******************/

	/**
	 * Constructor. Protected to force instantiation via self::load() or self::create().
	 *
	 * @param int $id The ID number of a poll or topic. Use 0 if unknown.
	 * @param int $options Bitmask of this class's LOAD_* and CHECK_* constants.
	 */
	protected function __construct(int $id = 0, int $options = 0)
	{
		// Figure out how we are loading the poll data.
		$load_by = self::LOAD_BY_ID;

		// The LOAD_BY_* constants are mutually exclusive.
		foreach ([self::LOAD_BY_TOPIC, self::LOAD_BY_RECENT, self::LOAD_BY_VOTES] as $const) {
			$load_by = $options & $const ? $const : $load_by;
		}

		// ID will be empty if loading by recent or by votes.
		if (!empty($id) || $load_by == self::LOAD_BY_RECENT || $load_by == self::LOAD_BY_VOTES) {
			$this->loadPollData($id, $load_by, $options);
		}

		// No poll found, so initialize a new one.
		if (empty($this->id)) {
			$this->initNewPoll();
		}

		self::$loaded[$this->id] = $this;
	}

	/**
	 * Sets object properties based on retrieved database rows.
	 *
	 * @param array $row A row from the database.
	 */
	protected function initNewPoll(): void
	{
		$this->set([
			'id' => 0,
			'max_votes' => max(1, (int) ($_POST['poll_max_votes'] ?? 0)),
			'hide_results' => min(max((int) ($_POST['poll_hide'] ?? 0), 0), 2),
			'expire_time' => (int) ($_POST['poll_expire'] ?? 0),
			'change_vote' => !empty($_POST['poll_change_vote']),
			'guest_vote' => !empty($_POST['poll_guest_vote']),
		]);

		// Make all five poll choices empty.
		Utils::$context['last_choice_id'] = 4;

		for ($i = 0; $i <= Utils::$context['last_choice_id']; $i++) {
			$this->addChoice([
				'id' => $i,
				'number' => $i + 1,
				'label' => '',
				'is_last' => $i === Utils::$context['last_choice_id'],
			], true);
		}
	}

	/**
	 * Loads data about a poll.
	 *
	 * @param int $id The ID number of a poll or topic.
	 * @param int $load_by One of the LOAD_* constants.
	 * @param int $options The query options passed to the constructor.
	 */
	protected function loadPollData(int $id, int $load_by, int &$options): void
	{
		switch ($load_by) {
			case self::LOAD_BY_VOTES:
				$most_active = $this->getMostActive($options);

				$this->selects[] = 't.id_topic';

				$this->joins = array_merge([
					't' => 'INNER JOIN {db_prefix}topics AS t ON (t.id_poll = p.id_poll)',
				], $this->joins);

				$this->where = ['p.id_poll = {int:id}'];
				$this->params['id'] = $most_active;

				break;

			case self::LOAD_BY_RECENT:
				$most_recent = $this->getMostRecent($options);

				$this->selects[] = 't.id_topic';

				$this->joins = array_merge([
					't' => 'INNER JOIN {db_prefix}topics AS t ON (t.id_poll = p.id_poll)',
				], $this->joins);

				$this->where = ['p.id_poll = {int:id}'];
				$this->params['id'] = $most_recent;

				break;

			case self::LOAD_BY_TOPIC:
				$this->selects[] = 't.id_topic';

				$this->joins = array_merge([
					't' => 'INNER JOIN {db_prefix}topics AS t ON (t.id_poll = p.id_poll)',
				], $this->joins);

				$this->where = ['t.id_topic = {int:id}'];
				$this->params['id'] = $id;

				break;

			case self::LOAD_BY_ID:
				if (isset(Topic::$topic_id)) {
					$selects[] = '{int:topic} AS id_topic';
					$params['topic'] = Topic::$topic_id;
				}

				$this->where = ['p.id_poll = {int:id}'];
				$this->params['id'] = $id;

				break;
		}

		$this->checkAccess($options);
		$this->checkLocked($options);
		$this->checkExpiry($options);

		$request = Db::$db->query(
			'',
			'SELECT ' . (implode(', ', $this->selects)) . '
			FROM {db_prefix}polls AS p
				' . (implode("\n\t\t\t\t", $this->joins)) . '
			WHERE (' . (implode(")\n\t\t\t\tAND (", $this->where)) . ')
			ORDER BY ' . (implode(', ', $this->order)),
			$this->params,
		);

		if (Db::$db->num_rows($request) == 0) {
			return;
		}

		while ($row = Db::$db->fetch_assoc($request)) {
			$this->setProperties($row);
		}

		Db::$db->free_result($request);

		foreach ($this->choices as $choice) {
			$this->total += $choice->votes;
		}

		$this->getVoters();
	}

	/**
	 * Sets object properties based on retrieved database rows.
	 *
	 * @param array $row A row from the database.
	 */
	protected function setProperties(array $row): void
	{
		// This should never happen, but just in case...
		if (isset($this->id) && $this->id != $row['id_poll']) {
			return;
		}

		$this->addChoice($row);

		unset($row['id_choice'], $row['label'], $row['votes']);

		if (!isset($this->id)) {
			$this->set($row);
		}
	}

	/**
	 * Gets the IDs of members who have voted in this poll.
	 */
	protected function getVoters(): void
	{
		if (!isset($this->id)) {
			return;
		}

		$request = Db::$db->query(
			'',
			'SELECT id_member, id_choice
			FROM {db_prefix}log_polls
			WHERE id_poll = {int:id_poll}
				AND id_member != {int:guest}',
			[
				'id_poll' => $this->id,
				'guest' => 0,
			],
		);
		$votes = Db::$db->fetch_all($request);
		Db::$db->free_result($request);

		$this->voters = array_unique(array_column($votes, 'id_member'));
		$this->total_voters = count($this->voters) + $this->num_guest_voters;

		// Did you vote, and what did you vote for?
		if (!User::$me->is_guest) {
			$this->has_voted = in_array(User::$me->id, $this->voters);

			foreach ($votes as $vote) {
				if ($vote['id_member'] != User::$me->id) {
					continue;
				}

				$this->choices[$vote['id_choice']]['voted_this'] = true;
			}
		}
		// If this is a guest we need to do our best to work out if they have voted, and what they voted for.
		elseif ($this->guest_vote && User::$me->allowedTo('poll_vote')) {
			if (!empty($_COOKIE['guest_poll_vote']) && preg_match('~^[0-9,;]+$~', $_COOKIE['guest_poll_vote']) && str_contains($_COOKIE['guest_poll_vote'], ';' . Topic::$info->id_poll . ',')) {
				// ;id,timestamp,[vote,vote...]; etc
				$guestinfo = explode(';', $_COOKIE['guest_poll_vote']);

				// Find the poll we're after.
				foreach ($guestinfo as $i => $guestvoted) {
					$guestvoted = explode(',', $guestvoted);

					if ($guestvoted[0] == $this->id) {
						break;
					}
				}

				// Has the poll been reset since guest voted?
				if ($this->reset_poll > $guestvoted[1]) {
					// Remove the poll info from the cookie to allow guest to vote again
					unset($guestinfo[$i]);

					if (!empty($guestinfo)) {
						$_COOKIE['guest_poll_vote'] = ';' . implode(';', $guestinfo);
					} else {
						unset($_COOKIE['guest_poll_vote']);
					}
				} else {
					// What did they vote for?
					unset($guestvoted[0], $guestvoted[1]);

					foreach ($this->choices as $choice => $details) {
						$details->voted_this = in_array($choice, $guestvoted);
						$this->has_voted |= $details->voted_this;
					}
				}
				unset($guestinfo, $guestvoted, $i);
			}
		}
	}

	/**
	 * If requested by the query options, adds SQL statements to the query
	 * variables to ensure that results exclude polls the user can't see.
	 *
	 * @param int $options The query options passed to the constructor.
	 */
	protected function checkAccess(int $options): void
	{
		if ($options & self::CHECK_ACCESS || $options & self::CHECK_IGNORE) {
			$this->selects[] = 't.id_board';
			$this->where[] = $options & self::CHECK_IGNORE ? '{query_wanna_see_topic_board}' : '{query_see_topic_board}';

			if (!empty(Config::$modSettings['recycle_enable']) && !empty(Config::$modSettings['recycle_board'])) {
				$this->where[] = 't.id_board != {int:recycle_board}';
				$this->params['recycle_board'] = Config::$modSettings['recycle_board'];
			}

			if (Config::$modSettings['postmod_active']) {
				$this->where[] = 't.approved = {int:is_approved}';
				$this->params['is_approved'] = 1;
			}

			if ($options & self::CHECK_ACCESS && !in_array(0, ($boardsAllowed = User::$me->boardsAllowedTo('poll_view')))) {
				$this->where[] = 't.id_board IN ({array_int:boards_allowed_see})';
				$this->params['boards_allowed_see'] = $boardsAllowed;
			}
		}
	}

	/**
	 * If requested by the query options, adds SQL statements to the query
	 * variables to ensure that results exclude locked polls.
	 *
	 * @param int $options The query options passed to the constructor.
	 */
	protected function checkLocked(int $options): void
	{
		if ($options & self::CHECK_LOCKED) {
			$this->where[] = 'p.voting_locked = {int:voting_opened}';
			$this->params['voting_opened'] = 0;
		}
	}

	/**
	 * If requested by the query options, adds SQL statements to the query
	 * variables to ensure that results exclude expired polls.
	 *
	 * @param int $options The query options passed to the constructor.
	 */
	protected function checkExpiry(int $options): void
	{
		if ($options & self::CHECK_EXPIRY) {
			$this->where[] = 'p.expire_time = {int:no_expiration} OR {int:current_time} < p.expire_time';
			$this->params['no_expiration'] = 0;
			$this->params['current_time'] = time();
		}
	}

	/**
	 * Resets query options and query variables to the default values.
	 *
	 * @param int $options The query options passed to the constructor.
	 */
	protected function resetQueryOptions(int &$options): void
	{
		// Now that we've used them, unset these options.
		$options &= ~self::CHECK_ACCESS;
		$options &= ~self::CHECK_IGNORE;
		$options &= ~self::CHECK_LOCKED;
		$options &= ~self::CHECK_EXPIRY;

		// Reset the query to default.
		$class_vars = get_class_vars(__CLASS__);

		foreach (['selects', 'joins', 'where', 'order', 'params'] as $var) {
			$this->{$var} = $class_vars[$var];
		}
	}

	/**
	 * Gets the ID of the most recent poll.
	 *
	 * @param int &$options The query options passed to the constructor.
	 * @return int ID of the most recent poll.
	 */
	protected function getMostRecent(int &$options): int
	{
		$this->joins = array_merge([
			't' => 'INNER JOIN {db_prefix}topics AS t ON (t.id_poll = p.id_poll)',
		], $this->joins);

		$this->checkAccess($options);
		$this->checkLocked($options);
		$this->checkExpiry($options);

		$request = Db::$db->query(
			'',
			'SELECT MAX(p.id_poll)
			FROM {db_prefix}polls AS p
				' . (implode("\n\t\t\t\t", $this->joins)) . '
			WHERE (' . (implode(")\n\t\t\t\tAND (", $this->where)) . ')
			GROUP BY p.id_poll
			ORDER BY ' . (implode(', ', $this->order)),
			$this->params,
		);
		list($most_recent) = Db::$db->fetch_row($request);
		Db::$db->free_result($request);

		$this->resetQueryOptions($options);

		return (int) $most_recent;
	}

	/**
	 * Gets the ID of the poll with the most voting activity.
	 *
	 * @param int &$options The query options passed to the constructor.
	 * @return int ID of the most active poll.
	 */
	protected function getMostActive(int &$options): int
	{
		$this->joins = [
			'p' => 'INNER JOIN {db_prefix}polls AS p ON (lp.id_poll = p.id_poll)',
			't' => 'INNER JOIN {db_prefix}topics AS t ON (t.id_poll = p.id_poll)',
		];

		$this->checkAccess($options);
		$this->checkLocked($options);
		$this->checkExpiry($options);

		$request = Db::$db->query(
			'',
			'SELECT lp.id_poll, COUNT(*) AS num_votes
			FROM {db_prefix}log_polls AS lp
				' . (implode("\n\t\t\t\t", $this->joins)) . '
			WHERE (' . (implode(")\n\t\t\t\tAND (", $this->where)) . ')
			GROUP BY lp.id_poll
			ORDER BY num_votes DESC
			LIMIT 1',
			$this->params,
		);
		list($most_active, $num_votes) = Db::$db->fetch_row($request);
		Db::$db->free_result($request);

		$this->resetQueryOptions($options);

		return (int) $most_active;
	}

	/*************************
	 * Internal static methods
	 *************************/

	/**
	 * Validates and sanitizes $_POST input for creating or editing a poll.
	 */
	protected static function sanitizeInput(array &$errors): void
	{
		if (!isset($_POST['question']) || trim($_POST['question']) == '') {
			$errors[] = 'no_question';
		}

		$_POST['options'] = empty($_POST['options']) ? [] : Utils::htmlTrimRecursive($_POST['options']);

		// Get rid of empty ones.
		foreach ($_POST['options'] as $k => $option) {
			if ($option == '') {
				unset($_POST['options'][$k], $_POST['options'][$k]);
			}
		}

		// What are you going to vote between with one choice?!?
		if (count($_POST['options']) < 2) {
			$errors[] = 'poll_few';
		} elseif (count($_POST['options']) > 256) {
			$errors[] = 'poll_many';
		}

		if (!empty($errors)) {
			return;
		}

		// Make sure these things are all sane.
		$_POST['poll_max_votes'] = min(max((int) ($_POST['poll_max_votes'] ?? 1), 1), count($_POST['options'] ?? []));
		$_POST['poll_expire'] = min(max((int) ($_POST['poll_expire'] ?? 0), 0), 9999);
		$_POST['poll_hide'] = (int) ($_POST['poll_hide'] ?? 0);
		$_POST['poll_change_vote'] = (int) !empty($_POST['poll_change_vote']);
		$_POST['poll_guest_vote'] = (int) !empty($_POST['poll_guest_vote']);

		// Make sure guests are actually allowed to vote generally.
		if ($_POST['poll_guest_vote']) {
			$_POST['poll_guest_vote'] = self::canGuestsVote();
		}

		// If the user tries to set the poll too far in advance, don't let them.
		if (!empty($_POST['poll_expire']) && $_POST['poll_expire'] < 1) {
			ErrorHandler::fatalLang('poll_range_error', false);
		}
		// Don't allow them to select option 2 for hidden results if it's not time limited.
		elseif (empty($_POST['poll_expire']) && $_POST['poll_hide'] == 2) {
			$_POST['poll_hide'] = 1;
		}

		// Clean up the question and answers.
		$_POST['question'] = Utils::htmlspecialchars($_POST['question']);
		$_POST['question'] = Utils::truncate($_POST['question'], 255);
		$_POST['question'] = preg_replace('~&amp;#(\d{4,5}|[2-9]\d{2,4}|1[2-9]\d);~', '&#$1;', $_POST['question']);
		$_POST['options'] = Utils::htmlspecialcharsRecursive($_POST['options']);
	}
}

?>