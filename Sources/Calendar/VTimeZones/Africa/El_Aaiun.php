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

namespace SMF\Calendar\VTimeZones\Africa;

/**
 * Africa/El_Aaiun
 */
class El_Aaiun extends \SMF\Calendar\VTimeZone
{
	/*******************
	 * Public properties
	 *******************/

	/**
	 * @var string
	 *
	 * Time zone identifier.
	 */
	public string $tzid = 'Africa/El_Aaiun';

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
			'DTSTART' => '19340101T000000',
			'TZNAME' => 'UTC-01',
			'TZOFFSETFROM' => '+005248',
			'TZOFFSETTO' => '-0100',
		],
		1 => [
			'type' => 'STANDARD',
			'DTSTART' => '19760414T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '-0100',
			'TZOFFSETTO' => '+0000',
		],
		2 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19760501T000000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=5;BYMONTHDAY=1;UNTIL=19770501T000000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		3 => [
			'type' => 'STANDARD',
			'DTSTART' => '19760801T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		4 => [
			'type' => 'STANDARD',
			'DTSTART' => '19770928T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		5 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19780601T000000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		6 => [
			'type' => 'STANDARD',
			'DTSTART' => '19780804T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		7 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20080601T000000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		8 => [
			'type' => 'STANDARD',
			'DTSTART' => '20080901T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		9 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20090601T000000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		10 => [
			'type' => 'STANDARD',
			'DTSTART' => '20090821T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		11 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20100502T000000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		12 => [
			'type' => 'STANDARD',
			'DTSTART' => '20100808T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		13 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20110403T000000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		14 => [
			'type' => 'STANDARD',
			'DTSTART' => '20110731T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		15 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20120429T020000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=4;BYDAY=-1SU;UNTIL=20130428T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		16 => [
			'type' => 'STANDARD',
			'DTSTART' => '20120720T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		17 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20120820T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		18 => [
			'type' => 'STANDARD',
			'DTSTART' => '20120930T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		19 => [
			'type' => 'STANDARD',
			'DTSTART' => '20130707T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		20 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20130810T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		21 => [
			'type' => 'STANDARD',
			'DTSTART' => '20131027T030000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=10;BYDAY=-1SU;UNTIL=20181028T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		22 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20140330T020000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=3;BYDAY=-1SU;UNTIL=20180325T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		23 => [
			'type' => 'STANDARD',
			'DTSTART' => '20140628T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		24 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20140802T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		25 => [
			'type' => 'STANDARD',
			'DTSTART' => '20150614T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		26 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20150719T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		27 => [
			'type' => 'STANDARD',
			'DTSTART' => '20160605T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		28 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20160710T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		29 => [
			'type' => 'STANDARD',
			'DTSTART' => '20170521T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		30 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20170702T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		31 => [
			'type' => 'STANDARD',
			'DTSTART' => '20180513T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		32 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20180617T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		33 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20190505T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		34 => [
			'type' => 'STANDARD',
			'DTSTART' => '20190609T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		35 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20200419T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		36 => [
			'type' => 'STANDARD',
			'DTSTART' => '20200531T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		37 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20210411T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		38 => [
			'type' => 'STANDARD',
			'DTSTART' => '20210516T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		39 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20220327T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		40 => [
			'type' => 'STANDARD',
			'DTSTART' => '20220508T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		41 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20230319T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		42 => [
			'type' => 'STANDARD',
			'DTSTART' => '20230423T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		43 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20240310T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		44 => [
			'type' => 'STANDARD',
			'DTSTART' => '20240414T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		45 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20250223T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		46 => [
			'type' => 'STANDARD',
			'DTSTART' => '20250406T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		47 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20260215T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		48 => [
			'type' => 'STANDARD',
			'DTSTART' => '20260322T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		49 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20270207T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		50 => [
			'type' => 'STANDARD',
			'DTSTART' => '20270314T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		51 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20280123T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		52 => [
			'type' => 'STANDARD',
			'DTSTART' => '20280305T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		53 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20290114T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		54 => [
			'type' => 'STANDARD',
			'DTSTART' => '20290218T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		55 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20291230T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		56 => [
			'type' => 'STANDARD',
			'DTSTART' => '20300210T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		57 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20301222T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		58 => [
			'type' => 'STANDARD',
			'DTSTART' => '20310126T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		59 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20311214T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		60 => [
			'type' => 'STANDARD',
			'DTSTART' => '20320118T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		61 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20321128T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		62 => [
			'type' => 'STANDARD',
			'DTSTART' => '20330109T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		63 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20331120T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		64 => [
			'type' => 'STANDARD',
			'DTSTART' => '20331225T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		65 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20341105T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		66 => [
			'type' => 'STANDARD',
			'DTSTART' => '20341217T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		67 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20351028T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		68 => [
			'type' => 'STANDARD',
			'DTSTART' => '20351209T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		69 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20361019T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		70 => [
			'type' => 'STANDARD',
			'DTSTART' => '20361123T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		71 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20371004T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		72 => [
			'type' => 'STANDARD',
			'DTSTART' => '20371115T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		73 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20380926T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		74 => [
			'type' => 'STANDARD',
			'DTSTART' => '20381031T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		75 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20390918T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		76 => [
			'type' => 'STANDARD',
			'DTSTART' => '20391023T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		77 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20400902T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		78 => [
			'type' => 'STANDARD',
			'DTSTART' => '20401014T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		79 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20410825T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		80 => [
			'type' => 'STANDARD',
			'DTSTART' => '20410929T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		81 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20420810T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		82 => [
			'type' => 'STANDARD',
			'DTSTART' => '20420921T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		83 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20430802T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		84 => [
			'type' => 'STANDARD',
			'DTSTART' => '20430913T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		85 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20440724T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		86 => [
			'type' => 'STANDARD',
			'DTSTART' => '20440828T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		87 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20450709T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		88 => [
			'type' => 'STANDARD',
			'DTSTART' => '20450820T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		89 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20460701T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		90 => [
			'type' => 'STANDARD',
			'DTSTART' => '20460805T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		91 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20470623T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		92 => [
			'type' => 'STANDARD',
			'DTSTART' => '20470728T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		93 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20480607T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		94 => [
			'type' => 'STANDARD',
			'DTSTART' => '20480719T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		95 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20490530T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		96 => [
			'type' => 'STANDARD',
			'DTSTART' => '20490704T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		97 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20500515T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		98 => [
			'type' => 'STANDARD',
			'DTSTART' => '20500626T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		99 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20510507T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		100 => [
			'type' => 'STANDARD',
			'DTSTART' => '20510618T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		101 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20520428T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		102 => [
			'type' => 'STANDARD',
			'DTSTART' => '20520602T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		103 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20530413T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		104 => [
			'type' => 'STANDARD',
			'DTSTART' => '20530525T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		105 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20540405T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		106 => [
			'type' => 'STANDARD',
			'DTSTART' => '20540510T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		107 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20550328T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		108 => [
			'type' => 'STANDARD',
			'DTSTART' => '20550502T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		109 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20560312T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		110 => [
			'type' => 'STANDARD',
			'DTSTART' => '20560423T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		111 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20570304T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		112 => [
			'type' => 'STANDARD',
			'DTSTART' => '20570408T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		113 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20580217T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		114 => [
			'type' => 'STANDARD',
			'DTSTART' => '20580331T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		115 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20590209T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		116 => [
			'type' => 'STANDARD',
			'DTSTART' => '20590323T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		117 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20600201T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		118 => [
			'type' => 'STANDARD',
			'DTSTART' => '20600307T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		119 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20610116T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		120 => [
			'type' => 'STANDARD',
			'DTSTART' => '20610227T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		121 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20620108T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		122 => [
			'type' => 'STANDARD',
			'DTSTART' => '20620212T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		123 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20621231T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		124 => [
			'type' => 'STANDARD',
			'DTSTART' => '20630204T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		125 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20631216T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		126 => [
			'type' => 'STANDARD',
			'DTSTART' => '20640127T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		127 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20641207T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		128 => [
			'type' => 'STANDARD',
			'DTSTART' => '20650111T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		129 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20651122T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		130 => [
			'type' => 'STANDARD',
			'DTSTART' => '20660103T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		131 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20661114T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		132 => [
			'type' => 'STANDARD',
			'DTSTART' => '20661226T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		133 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20671106T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		134 => [
			'type' => 'STANDARD',
			'DTSTART' => '20671211T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		135 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20681021T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		136 => [
			'type' => 'STANDARD',
			'DTSTART' => '20681202T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		137 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20691013T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		138 => [
			'type' => 'STANDARD',
			'DTSTART' => '20691117T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		139 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20701005T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		140 => [
			'type' => 'STANDARD',
			'DTSTART' => '20701109T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		141 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20710920T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		142 => [
			'type' => 'STANDARD',
			'DTSTART' => '20711101T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		143 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20720911T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		144 => [
			'type' => 'STANDARD',
			'DTSTART' => '20721016T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		145 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20730827T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		146 => [
			'type' => 'STANDARD',
			'DTSTART' => '20731008T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		147 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20740819T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		148 => [
			'type' => 'STANDARD',
			'DTSTART' => '20740930T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		149 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20750811T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		150 => [
			'type' => 'STANDARD',
			'DTSTART' => '20750915T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		151 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20760726T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		152 => [
			'type' => 'STANDARD',
			'DTSTART' => '20760906T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		153 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20770718T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		154 => [
			'type' => 'STANDARD',
			'DTSTART' => '20770822T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		155 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20780710T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		156 => [
			'type' => 'STANDARD',
			'DTSTART' => '20780814T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		157 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20790625T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		158 => [
			'type' => 'STANDARD',
			'DTSTART' => '20790806T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		159 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20800616T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		160 => [
			'type' => 'STANDARD',
			'DTSTART' => '20800721T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		161 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20810601T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		162 => [
			'type' => 'STANDARD',
			'DTSTART' => '20810713T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		163 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20820524T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		164 => [
			'type' => 'STANDARD',
			'DTSTART' => '20820628T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		165 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20830516T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		166 => [
			'type' => 'STANDARD',
			'DTSTART' => '20830620T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		167 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20840430T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		168 => [
			'type' => 'STANDARD',
			'DTSTART' => '20840611T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		169 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20850422T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		170 => [
			'type' => 'STANDARD',
			'DTSTART' => '20850527T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		171 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20860414T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		172 => [
			'type' => 'STANDARD',
			'DTSTART' => '20860519T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		173 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20870330T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		174 => [
			'type' => 'STANDARD',
			'DTSTART' => '20870511T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
	];
}

?>