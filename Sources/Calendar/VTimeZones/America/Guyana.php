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

namespace SMF\Calendar\VTimeZones\America;

/**
 * America/Guyana
 */
class Guyana extends \SMF\Calendar\VTimeZone
{
	/*******************
	 * Public properties
	 *******************/

	/**
	 * @var string
	 *
	 * Time zone identifier.
	 */
	public string $tzid = 'America/Guyana';

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
			'DTSTART' => '19110801T000000',
			'TZNAME' => 'UTC-04',
			'TZOFFSETFROM' => '-035239',
			'TZOFFSETTO' => '-0400',
		],
		1 => [
			'type' => 'STANDARD',
			'DTSTART' => '19150301T000000',
			'TZNAME' => 'UTC-0345',
			'TZOFFSETFROM' => '-0400',
			'TZOFFSETTO' => '-0345',
		],
		2 => [
			'type' => 'STANDARD',
			'DTSTART' => '19750801T000000',
			'TZNAME' => 'UTC-03',
			'TZOFFSETFROM' => '-0345',
			'TZOFFSETTO' => '-0300',
		],
		3 => [
			'type' => 'STANDARD',
			'DTSTART' => '19920329T010000',
			'TZNAME' => 'UTC-04',
			'TZOFFSETFROM' => '-0300',
			'TZOFFSETTO' => '-0400',
		],
	];
}

?>