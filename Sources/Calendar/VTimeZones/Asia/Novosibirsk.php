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

namespace SMF\Calendar\VTimeZones\Asia;

/**
 * Asia/Novosibirsk
 */
class Novosibirsk extends \SMF\Calendar\VTimeZone
{
	/*******************
	 * Public properties
	 *******************/

	/**
	 * @var string
	 *
	 * Time zone identifier.
	 */
	public string $tzid = 'Asia/Novosibirsk';

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
			'DTSTART' => '19191214T060000',
			'TZNAME' => 'UTC+06',
			'TZOFFSETFROM' => '+053140',
			'TZOFFSETTO' => '+0600',
		],
		1 => [
			'type' => 'STANDARD',
			'DTSTART' => '19300621T000000',
			'TZNAME' => 'UTC+07',
			'TZOFFSETFROM' => '+0600',
			'TZOFFSETTO' => '+0700',
		],
		2 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19810401T000000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=4;BYMONTHDAY=1;UNTIL=19840401T000000',
			'TZNAME' => 'UTC+08',
			'TZOFFSETFROM' => '+0700',
			'TZOFFSETTO' => '+0800',
		],
		3 => [
			'type' => 'STANDARD',
			'DTSTART' => '19811001T000000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=10;BYMONTHDAY=1;UNTIL=19831001T000000',
			'TZNAME' => 'UTC+07',
			'TZOFFSETFROM' => '+0800',
			'TZOFFSETTO' => '+0700',
		],
		4 => [
			'type' => 'STANDARD',
			'DTSTART' => '19840930T030000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=9;BYDAY=-1SU;UNTIL=19950924T020000',
			'TZNAME' => 'UTC+07',
			'TZOFFSETFROM' => '+0800',
			'TZOFFSETTO' => '+0700',
		],
		5 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19850331T020000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=3;BYDAY=-1SU;UNTIL=20100328T020000',
			'TZNAME' => 'UTC+08',
			'TZOFFSETFROM' => '+0700',
			'TZOFFSETTO' => '+0800',
		],
		6 => [
			'type' => 'STANDARD',
			'DTSTART' => '19920119T020000',
			'TZNAME' => 'UTC+07',
			'TZOFFSETFROM' => '+0600',
			'TZOFFSETTO' => '+0700',
		],
		7 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19930523T000000',
			'TZNAME' => 'UTC+07',
			'TZOFFSETFROM' => '+0800',
			'TZOFFSETTO' => '+0700',
		],
		8 => [
			'type' => 'STANDARD',
			'DTSTART' => '19961027T030000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=10;BYDAY=-1SU;UNTIL=20101031T020000',
			'TZNAME' => 'UTC+06',
			'TZOFFSETFROM' => '+0700',
			'TZOFFSETTO' => '+0600',
		],
		9 => [
			'type' => 'STANDARD',
			'DTSTART' => '20110327T020000',
			'TZNAME' => 'UTC+07',
			'TZOFFSETFROM' => '+0600',
			'TZOFFSETTO' => '+0700',
		],
		10 => [
			'type' => 'STANDARD',
			'DTSTART' => '20141026T020000',
			'TZNAME' => 'UTC+06',
			'TZOFFSETFROM' => '+0700',
			'TZOFFSETTO' => '+0600',
		],
		11 => [
			'type' => 'STANDARD',
			'DTSTART' => '20160724T020000',
			'TZNAME' => 'UTC+07',
			'TZOFFSETFROM' => '+0600',
			'TZOFFSETTO' => '+0700',
		],
	];
}

?>