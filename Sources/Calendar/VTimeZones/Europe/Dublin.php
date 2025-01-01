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

namespace SMF\Calendar\VTimeZones\Europe;

/**
 * Europe/Dublin
 */
class Dublin extends \SMF\Calendar\VTimeZone
{
	/*******************
	 * Public properties
	 *******************/

	/**
	 * @var string
	 *
	 * Time zone identifier.
	 */
	public string $tzid = 'Europe/Dublin';

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
			'DTSTART' => '19161001T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+003439',
			'TZOFFSETTO' => '+0000',
		],
		1 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19170408T020000',
			'TZNAME' => 'BST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		2 => [
			'type' => 'STANDARD',
			'DTSTART' => '19170917T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		3 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19180324T020000',
			'TZNAME' => 'BST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		4 => [
			'type' => 'STANDARD',
			'DTSTART' => '19180930T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		5 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19190330T020000',
			'TZNAME' => 'BST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		6 => [
			'type' => 'STANDARD',
			'DTSTART' => '19190929T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		7 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19200328T020000',
			'TZNAME' => 'BST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		8 => [
			'type' => 'STANDARD',
			'DTSTART' => '19201025T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		9 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19210403T020000',
			'TZNAME' => 'BST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		10 => [
			'type' => 'STANDARD',
			'DTSTART' => '19211003T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		11 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19220326T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		12 => [
			'type' => 'STANDARD',
			'DTSTART' => '19221008T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		13 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19230422T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		14 => [
			'type' => 'STANDARD',
			'DTSTART' => '19230916T030000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=9;BYDAY=SU;BYMONTHDAY=16,17,18,19,20,21,22;UNTIL=19240921T020000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		15 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19240413T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		16 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19250419T020000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=4;BYDAY=SU;BYMONTHDAY=16,17,18,19,20,21,22;UNTIL=19260418T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		17 => [
			'type' => 'STANDARD',
			'DTSTART' => '19251004T030000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=10;BYDAY=SU;BYMONTHDAY=2,3,4,5,6,7,8;UNTIL=19381002T020000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		18 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19270410T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		19 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19280422T020000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=4;BYDAY=SU;BYMONTHDAY=16,17,18,19,20,21,22;UNTIL=19290421T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		20 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19300413T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		21 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19310419T020000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=4;BYDAY=SU;BYMONTHDAY=16,17,18,19,20,21,22;UNTIL=19320417T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		22 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19330409T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		23 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19340422T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		24 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19350414T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		25 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19360419T020000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=4;BYDAY=SU;BYMONTHDAY=16,17,18,19,20,21,22;UNTIL=19370418T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		26 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19380410T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		27 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19390416T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		28 => [
			'type' => 'STANDARD',
			'DTSTART' => '19391119T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		29 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19400225T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		30 => [
			'type' => 'STANDARD',
			'DTSTART' => '19461006T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		31 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19470316T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		32 => [
			'type' => 'STANDARD',
			'DTSTART' => '19471102T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		33 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19480418T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		34 => [
			'type' => 'STANDARD',
			'DTSTART' => '19481031T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		35 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19490403T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		36 => [
			'type' => 'STANDARD',
			'DTSTART' => '19491030T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		37 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19500416T020000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=4;BYDAY=SU;BYMONTHDAY=14,15,16,17,18,19,20;UNTIL=19520420T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		38 => [
			'type' => 'STANDARD',
			'DTSTART' => '19501022T030000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=10;BYDAY=SU;BYMONTHDAY=21,22,23,24,25,26,27;UNTIL=19521026T020000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		39 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19530419T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		40 => [
			'type' => 'STANDARD',
			'DTSTART' => '19531004T030000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=10;BYDAY=SU;BYMONTHDAY=2,3,4,5,6,7,8;UNTIL=19601002T020000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		41 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19540411T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		42 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19550417T020000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=4;BYDAY=SU;BYMONTHDAY=16,17,18,19,20,21,22;UNTIL=19560422T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		43 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19570414T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		44 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19580420T020000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=4;BYDAY=SU;BYMONTHDAY=16,17,18,19,20,21,22;UNTIL=19590419T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		45 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19600410T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		46 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19610326T020000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=3;BYDAY=-1SU;UNTIL=19630331T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		47 => [
			'type' => 'STANDARD',
			'DTSTART' => '19611029T030000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=10;BYDAY=SU;BYMONTHDAY=23,24,25,26,27,28,29;UNTIL=19681027T020000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		48 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19640322T020000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=3;BYDAY=SU;BYMONTHDAY=19,20,21,22,23,24,25;UNTIL=19670319T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		49 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19680218T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		50 => [
			'type' => 'STANDARD',
			'DTSTART' => '19681027T000000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0100',
		],
		51 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19711031T030000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		52 => [
			'type' => 'STANDARD',
			'DTSTART' => '19720816T010000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=3;BYDAY=SU;BYMONTHDAY=16,17,18,19,20,21,22;UNTIL=19800316T020000',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		53 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19730328T020000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=10;BYDAY=SU;BYMONTHDAY=23,24,25,26,27,28,29;UNTIL=19801026T020000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		54 => [
			'type' => 'STANDARD',
			'DTSTART' => '19810826T000000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=3;BYDAY=-1SU',
			'TZNAME' => 'IST',
			'TZOFFSETFROM' => '+0000',
			'TZOFFSETTO' => '+0100',
		],
		55 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19820324T010000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=10;BYDAY=SU;BYMONTHDAY=23,24,25,26,27,28,29;UNTIL=19891029T010000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		56 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19910327T010000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=10;BYDAY=4SU;UNTIL=19951022T010000',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
		57 => [
			'type' => 'DAYLIGHT',
			'DTSTART' => '19970326T010000',
			'RRULE' => 'FREQ=YEARLY;BYMONTH=10;BYDAY=-1SU',
			'TZNAME' => 'GMT',
			'TZOFFSETFROM' => '+0100',
			'TZOFFSETTO' => '+0000',
		],
	];
}

?>