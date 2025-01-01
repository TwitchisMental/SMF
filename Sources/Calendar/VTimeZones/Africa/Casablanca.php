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

namespace SMF\Calendar\VTimeZones\Africa;

/**
 * Africa/Casablanca
 */
class Casablanca extends \SMF\Calendar\VTimeZone
{
	/*******************
	 * Public properties
	 *******************/

	/**
	 * @var string
	 *
	 * Time zone identifier.
	 */
	public string $tzid = 'Africa/Casablanca';

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
			'DTSTART' => '19131026T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+003020',
			'TZOFFSETTO' => '+0000',
		],
		1 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19390912T000000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		2 => [
			'type' => 'STANDARD',
			'DTSTART' => '19391119T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		3 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19400225T000000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		4 => [
			'type' => 'STANDARD',
			'DTSTART' => '19451118T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		5 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19500611T000000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		6 => [
			'type' => 'STANDARD',
			'DTSTART' => '19501029T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		7 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19670603T120000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		8 => [
			'type' => 'STANDARD',
			'DTSTART' => '19671001T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		9 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19740624T000000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		10 => [
			'type' => 'STANDARD',
			'DTSTART' => '19740901T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		11 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19760501T000000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=5;BYMONTHDAY=1;UNTIL=19770501T000000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		12 => [
			'type' => 'STANDARD',
			'DTSTART' => '19760801T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		13 => [
			'type' => 'STANDARD',
			'DTSTART' => '19770928T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		14 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19780601T000000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		15 => [
			'type' => 'STANDARD',
			'DTSTART' => '19780804T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		16 => [
			'type' => 'STANDARD',
			'DTSTART' => '19840316T000000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		17 => [
			'type' => 'STANDARD',
			'DTSTART' => '19860101T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		18 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20080601T000000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		19 => [
			'type' => 'STANDARD',
			'DTSTART' => '20080901T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		20 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20090601T000000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		21 => [
			'type' => 'STANDARD',
			'DTSTART' => '20090821T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		22 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20100502T000000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		23 => [
			'type' => 'STANDARD',
			'DTSTART' => '20100808T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		24 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20110403T000000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		25 => [
			'type' => 'STANDARD',
			'DTSTART' => '20110731T000000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		26 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20120429T020000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=4;BYDAY=-1SU;UNTIL=20130428T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		27 => [
			'type' => 'STANDARD',
			'DTSTART' => '20120720T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		28 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20120820T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		29 => [
			'type' => 'STANDARD',
			'DTSTART' => '20120930T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		30 => [
			'type' => 'STANDARD',
			'DTSTART' => '20130707T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		31 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20130810T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		32 => [
			'type' => 'STANDARD',
			'DTSTART' => '20131027T030000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=10;BYDAY=-1SU;UNTIL=20181028T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		33 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20140330T020000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=3;BYDAY=-1SU;UNTIL=20180325T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		34 => [
			'type' => 'STANDARD',
			'DTSTART' => '20140628T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		35 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20140802T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		36 => [
			'type' => 'STANDARD',
			'DTSTART' => '20150614T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		37 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20150719T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		38 => [
			'type' => 'STANDARD',
			'DTSTART' => '20160605T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		39 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20160710T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		40 => [
			'type' => 'STANDARD',
			'DTSTART' => '20170521T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		41 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20170702T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		42 => [
			'type' => 'STANDARD',
			'DTSTART' => '20180513T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		43 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20180617T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		44 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20190505T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		45 => [
			'type' => 'STANDARD',
			'DTSTART' => '20190609T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		46 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20200419T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		47 => [
			'type' => 'STANDARD',
			'DTSTART' => '20200531T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		48 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20210411T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		49 => [
			'type' => 'STANDARD',
			'DTSTART' => '20210516T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		50 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20220327T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		51 => [
			'type' => 'STANDARD',
			'DTSTART' => '20220508T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		52 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20230319T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		53 => [
			'type' => 'STANDARD',
			'DTSTART' => '20230423T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		54 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20240310T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		55 => [
			'type' => 'STANDARD',
			'DTSTART' => '20240414T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		56 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20250223T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		57 => [
			'type' => 'STANDARD',
			'DTSTART' => '20250406T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		58 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20260215T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		59 => [
			'type' => 'STANDARD',
			'DTSTART' => '20260322T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		60 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20270207T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		61 => [
			'type' => 'STANDARD',
			'DTSTART' => '20270314T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		62 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20280123T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		63 => [
			'type' => 'STANDARD',
			'DTSTART' => '20280305T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		64 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20290114T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		65 => [
			'type' => 'STANDARD',
			'DTSTART' => '20290218T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		66 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20291230T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		67 => [
			'type' => 'STANDARD',
			'DTSTART' => '20300210T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		68 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20301222T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		69 => [
			'type' => 'STANDARD',
			'DTSTART' => '20310126T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		70 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20311214T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		71 => [
			'type' => 'STANDARD',
			'DTSTART' => '20320118T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		72 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20321128T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		73 => [
			'type' => 'STANDARD',
			'DTSTART' => '20330109T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		74 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20331120T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		75 => [
			'type' => 'STANDARD',
			'DTSTART' => '20331225T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		76 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20341105T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		77 => [
			'type' => 'STANDARD',
			'DTSTART' => '20341217T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		78 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20351028T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		79 => [
			'type' => 'STANDARD',
			'DTSTART' => '20351209T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		80 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20361019T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		81 => [
			'type' => 'STANDARD',
			'DTSTART' => '20361123T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		82 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20371004T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		83 => [
			'type' => 'STANDARD',
			'DTSTART' => '20371115T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		84 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20380926T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		85 => [
			'type' => 'STANDARD',
			'DTSTART' => '20381031T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		86 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20390918T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		87 => [
			'type' => 'STANDARD',
			'DTSTART' => '20391023T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		88 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20400902T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		89 => [
			'type' => 'STANDARD',
			'DTSTART' => '20401014T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		90 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20410825T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		91 => [
			'type' => 'STANDARD',
			'DTSTART' => '20410929T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		92 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20420810T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		93 => [
			'type' => 'STANDARD',
			'DTSTART' => '20420921T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		94 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20430802T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		95 => [
			'type' => 'STANDARD',
			'DTSTART' => '20430913T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		96 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20440724T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		97 => [
			'type' => 'STANDARD',
			'DTSTART' => '20440828T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		98 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20450709T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		99 => [
			'type' => 'STANDARD',
			'DTSTART' => '20450820T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		100 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20460701T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		101 => [
			'type' => 'STANDARD',
			'DTSTART' => '20460805T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		102 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20470623T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		103 => [
			'type' => 'STANDARD',
			'DTSTART' => '20470728T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		104 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20480607T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		105 => [
			'type' => 'STANDARD',
			'DTSTART' => '20480719T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		106 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20490530T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		107 => [
			'type' => 'STANDARD',
			'DTSTART' => '20490704T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		108 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20500515T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		109 => [
			'type' => 'STANDARD',
			'DTSTART' => '20500626T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		110 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20510507T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		111 => [
			'type' => 'STANDARD',
			'DTSTART' => '20510618T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		112 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20520428T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		113 => [
			'type' => 'STANDARD',
			'DTSTART' => '20520602T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		114 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20530413T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		115 => [
			'type' => 'STANDARD',
			'DTSTART' => '20530525T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		116 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20540405T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		117 => [
			'type' => 'STANDARD',
			'DTSTART' => '20540510T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		118 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20550328T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		119 => [
			'type' => 'STANDARD',
			'DTSTART' => '20550502T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		120 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20560312T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		121 => [
			'type' => 'STANDARD',
			'DTSTART' => '20560423T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		122 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20570304T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		123 => [
			'type' => 'STANDARD',
			'DTSTART' => '20570408T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		124 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20580217T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		125 => [
			'type' => 'STANDARD',
			'DTSTART' => '20580331T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		126 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20590209T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		127 => [
			'type' => 'STANDARD',
			'DTSTART' => '20590323T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		128 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20600201T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		129 => [
			'type' => 'STANDARD',
			'DTSTART' => '20600307T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		130 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20610116T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		131 => [
			'type' => 'STANDARD',
			'DTSTART' => '20610227T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		132 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20620108T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		133 => [
			'type' => 'STANDARD',
			'DTSTART' => '20620212T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		134 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20621231T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		135 => [
			'type' => 'STANDARD',
			'DTSTART' => '20630204T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		136 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20631216T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		137 => [
			'type' => 'STANDARD',
			'DTSTART' => '20640127T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		138 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20641207T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		139 => [
			'type' => 'STANDARD',
			'DTSTART' => '20650111T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		140 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20651122T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		141 => [
			'type' => 'STANDARD',
			'DTSTART' => '20660103T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		142 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20661114T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		143 => [
			'type' => 'STANDARD',
			'DTSTART' => '20661226T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		144 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20671106T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		145 => [
			'type' => 'STANDARD',
			'DTSTART' => '20671211T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		146 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20681021T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		147 => [
			'type' => 'STANDARD',
			'DTSTART' => '20681202T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		148 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20691013T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		149 => [
			'type' => 'STANDARD',
			'DTSTART' => '20691117T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		150 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20701005T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		151 => [
			'type' => 'STANDARD',
			'DTSTART' => '20701109T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		152 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20710920T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		153 => [
			'type' => 'STANDARD',
			'DTSTART' => '20711101T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		154 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20720911T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		155 => [
			'type' => 'STANDARD',
			'DTSTART' => '20721016T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		156 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20730827T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		157 => [
			'type' => 'STANDARD',
			'DTSTART' => '20731008T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		158 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20740819T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		159 => [
			'type' => 'STANDARD',
			'DTSTART' => '20740930T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		160 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20750811T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		161 => [
			'type' => 'STANDARD',
			'DTSTART' => '20750915T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		162 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20760726T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		163 => [
			'type' => 'STANDARD',
			'DTSTART' => '20760906T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		164 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20770718T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		165 => [
			'type' => 'STANDARD',
			'DTSTART' => '20770822T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		166 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20780710T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		167 => [
			'type' => 'STANDARD',
			'DTSTART' => '20780814T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		168 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20790625T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		169 => [
			'type' => 'STANDARD',
			'DTSTART' => '20790806T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		170 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20800616T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		171 => [
			'type' => 'STANDARD',
			'DTSTART' => '20800721T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		172 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20810601T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		173 => [
			'type' => 'STANDARD',
			'DTSTART' => '20810713T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		174 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20820524T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		175 => [
			'type' => 'STANDARD',
			'DTSTART' => '20820628T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		176 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20830516T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		177 => [
			'type' => 'STANDARD',
			'DTSTART' => '20830620T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		178 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20840430T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		179 => [
			'type' => 'STANDARD',
			'DTSTART' => '20840611T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		180 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20850422T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		181 => [
			'type' => 'STANDARD',
			'DTSTART' => '20850527T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		182 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20860414T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		183 => [
			'type' => 'STANDARD',
			'DTSTART' => '20860519T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		184 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '20870330T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		185 => [
			'type' => 'STANDARD',
			'DTSTART' => '20870511T020000',
			'TZNAME' => 'UTC+01',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
	];
}

?>