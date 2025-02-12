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

namespace SMF\Calendar\VTimeZones\America;

/**
 * America/Regina
 */
class Regina extends \SMF\Calendar\VTimeZone
{
	/*******************
	 * Public properties
	 *******************/

	/**
	 * @var string
	 *
	 * Time zone identifier.
	 */
	public string $tzid = 'America/Regina';

	/**
	 * @var array
	 *
	 * Data for the VTIMEZONE components.
	 *
	 * Developers: Do not update the data in this array manually. Instead,
	 * run "php -f other/update_timezones.php" on the command line.
	 */
	public array $components = [
		0 => [
			'type' => 'STANDARD',
			'DTSTART' => '19050901T000000',
			'TZNAME' => 'MST',
			'TZOFFSETFROM' => '-065836',
			'TZOFFSETTO' => '-0700',
		],
		1 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19180414T020000',
			'TZNAME' => 'MDT',
			'TZOFFSETFROM' => '-0700',
			'TZOFFSETTO' => '-0600',
		],
		2 => [
			'type' => 'STANDARD',
			'DTSTART' => '19181027T020000',
			'TZNAME' => 'MST',
			'TZOFFSETFROM' => '-0600',
			'TZOFFSETTO' => '-0700',
		],
		3 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19300504T000000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=5;BYDAY=1SU;UNTIL=19340506T000000',
			'TZNAME' => 'MDT',
			'TZOFFSETFROM' => '-0700',
			'TZOFFSETTO' => '-0600',
		],
		4 => [
			'type' => 'STANDARD',
			'DTSTART' => '19301005T000000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=10;BYDAY=1SU;UNTIL=19341007T000000',
			'TZNAME' => 'MST',
			'TZOFFSETFROM' => '-0600',
			'TZOFFSETTO' => '-0700',
		],
		5 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19370411T000000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=4;BYDAY=2SU;UNTIL=19410413T000000',
			'TZNAME' => 'MDT',
			'TZOFFSETFROM' => '-0700',
			'TZOFFSETTO' => '-0600',
		],
		6 => [
			'type' => 'STANDARD',
			'DTSTART' => '19371010T000000',
			'TZNAME' => 'MST',
			'TZOFFSETFROM' => '-0600',
			'TZOFFSETTO' => '-0700',
		],
		7 => [
			'type' => 'STANDARD',
			'DTSTART' => '19381002T000000',
			'TZNAME' => 'MST',
			'TZOFFSETFROM' => '-0600',
			'TZOFFSETTO' => '-0700',
		],
		8 => [
			'type' => 'STANDARD',
			'DTSTART' => '19391008T000000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=10;BYDAY=2SU;UNTIL=19411012T000000',
			'TZNAME' => 'MST',
			'TZOFFSETFROM' => '-0600',
			'TZOFFSETTO' => '-0700',
		],
		9 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19420209T020000',
			'TZNAME' => 'MWT',
			'TZOFFSETFROM' => '-0700',
			'TZOFFSETTO' => '-0600',
		],
		10 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19450814T170000',
			'TZNAME' => 'MPT',
			'TZOFFSETFROM' => '-0600',
			'TZOFFSETTO' => '-0600',
		],
		11 => [
			'type' => 'STANDARD',
			'DTSTART' => '19450930T020000',
			'TZNAME' => 'MST',
			'TZOFFSETFROM' => '-0600',
			'TZOFFSETTO' => '-0700',
		],
		12 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19460414T020000',
			'TZNAME' => 'MDT',
			'TZOFFSETFROM' => '-0700',
			'TZOFFSETTO' => '-0600',
		],
		13 => [
			'type' => 'STANDARD',
			'DTSTART' => '19461013T020000',
			'TZNAME' => 'MST',
			'TZOFFSETFROM' => '-0600',
			'TZOFFSETTO' => '-0700',
		],
		14 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19470427T020000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=4;BYDAY=-1SU;UNTIL=19570428T020000',
			'TZNAME' => 'MDT',
			'TZOFFSETFROM' => '-0700',
			'TZOFFSETTO' => '-0600',
		],
		15 => [
			'type' => 'STANDARD',
			'DTSTART' => '19470928T020000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=9;BYDAY=-1SU;UNTIL=19570929T020000',
			'TZNAME' => 'MST',
			'TZOFFSETFROM' => '-0600',
			'TZOFFSETTO' => '-0700',
		],
		16 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19590426T020000',
			'TZNAME' => 'MDT',
			'TZOFFSETFROM' => '-0700',
			'TZOFFSETTO' => '-0600',
		],
		17 => [
			'type' => 'STANDARD',
			'DTSTART' => '19591025T020000',
			'TZNAME' => 'MST',
			'TZOFFSETFROM' => '-0600',
			'TZOFFSETTO' => '-0700',
		],
		18 => [
			'type' => 'STANDARD',
			'DTSTART' => '19600424T020000',
			'TZNAME' => 'CST',
			'TZOFFSETFROM' => '-0700',
			'TZOFFSETTO' => '-0600',
		],
	];
}

?>