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

namespace SMF;

/**
 * Extends \DateInterval with some extra features for SMF.
 */
class TimeInterval extends \DateInterval implements \Stringable
{
	/*******************
	 * Public properties
	 *******************/

	/**
	 * @var int
	 *
	 * Number of years.
	 */
	public int $y;

	/**
	 * @var int
	 *
	 * Number of months.
	 */
	public int $m;

	/**
	 * @var int
	 *
	 * Number of days.
	 */
	public int $d;

	/**
	 * @var int
	 *
	 * Number of hours.
	 */
	public int $h;

	/**
	 * @var int
	 *
	 * Number of minutes.
	 */
	public int $i;

	/**
	 * @var int
	 *
	 * Number of seconds.
	 */
	public int $s;

	/**
	 * @var float
	 *
	 * Number of microseconds, as a fraction of a second.
	 */
	public float $f;

	/**
	 * @var int
	 *
	 * 1 if the interval represents a negative time period and 0 otherwise.
	 */
	public int $invert;

	/**
	 * @var mixed
	 *
	 * If the object was created by Time::diff(), then this is the total number
	 * of full days between the start and end dates. Otherwise, false.
	 */
	public mixed $days;

	/**
	 * @var bool
	 *
	 * Whether the object was created by TimeInterval::createFromDateString().
	 */
	public bool $from_string;

	/**
	 * @var string
	 *
	 * The string used as argument to TimeInterval::createFromDateString().
	 */
	public string $date_string;

	/****************
	 * Public methods
	 ****************/

	/**
	 * Constructor.
	 *
	 * Like \DateInterval::__construct(), except that it can accept fractional
	 * values for whatever the smallest unit is. In other words, it supports the
	 * complete spec for ISO 8601 durations, not just a subset of the spec.
	 *
	 * @param string $duration An ISO 8601 duration string.
	 */
	public function __construct(string $duration)
	{
		// First, check for duration string (e.g. 'P1DT2H').
		// Matches could be just 'P' if alt format was used.
		$valid = preg_match('/P(?:(?P<y>[\d\.]+)Y)?(?:(?P<m>[\d\.]+)M)?(?:(?P<w>[\d\.]+)W)?(?:(?P<d>[\d\.]+)D)?(?:T(?:(?P<h>[\d\.]+)H)?(?:(?P<i>[\d\.]+)M)?(?:(?P<s>[\d\.]+)S)?)?/', $duration, $matches) && $matches[0] !== 'P';

		// Next, check for alt format (e.g. 'P0000-00-01T02:00:00').
		if (!$valid) {
			$valid = preg_match('/P(?P<y>\d+)-?(?P<m>\d+)-?(?P<w>\d+)-?(?P<d>\d+)T(?P<h>\d+):?(?P<i>\d+):?(?P<s>[\d\.]+)/', $duration, $matches);
		}

		if (!$valid) {
			throw new \ValueError();
		}

		// Clean up $matches.
		$matches = array_map(
			// Quick way to cast to int or float without extra logic.
			fn($v) => $v + 0,
			// Filter out the stuff we don't need.
			array_filter(
				$matches,
				fn($v, $k) => !is_int($k) && $v !== '',
				ARRAY_FILTER_USE_BOTH,
			),
		);

		// For simplicity, convert weeks to days.
		if (!empty($matches['w'])) {
			$matches['d'] = ($matches['d'] ?? 0) + $matches['w'] * 7;
			unset($matches['w']);
		}

		// Figure out if we have any fractional values.
		$frac = [
			'prop' => null,
			'value' => null,
		];

		$props = [
			's' => [
				'frac_prop' => 'f',
				'multiplier' => 1,
				'unit' => 'S',
			],
			'i' => [
				'frac_prop' => 's',
				'multiplier' => 60,
				'unit' => 'M',
			],
			'h' => [
				'frac_prop' => 'i',
				'multiplier' => 60,
				'unit' => 'H',
			],
			'd' => [
				'frac_prop' => 'h',
				'multiplier' => 24,
				'unit' => 'D',
			],
			'm' => [
				'frac_prop' => 'd',
				// This is calibrated so that 'P0.5M' means 'P15D' but 'P0.99M' means 'P28D'.
				'multiplier' => !isset($matches['m']) || fmod($matches['m'], 1.0) <= 0.5 ? 30 : 32 - (4 * fmod($matches['m'], 1.0)),
				'unit' => 'M',
			],
			'y' => [
				'frac_prop' => 'm',
				'multiplier' => 12,
				'unit' => 'Y',
			],
		];

		$can_be_fractional = true;

		foreach ($props as $prop => $info) {
			if (!isset($matches[$prop])) {
				continue;
			}

			if (is_float($matches[$prop])) {
				if (!$can_be_fractional) {
					throw new \ValueError();
				}

				$frac['prop'] = $info['frac_prop'];
				$frac['value'] = round(($matches[$prop] - (int) $matches[$prop]) * $info['multiplier'], 6);

				$matches[$prop] = (int) $matches[$prop];
			}

			// ISO 8601 only allows the smallest provided unit to be fractional.
			$can_be_fractional = false;
		}

		// Add the fractional value where appropriate.
		if (isset($frac['prop'])) {
			$this->{$frac['prop']} += $frac['value'];
		}

		// Set our properties.
		$this->y = $matches['y'] ?? 0;
		$this->m = $matches['m'] ?? 0;
		$this->d = $matches['d'] ?? 0;
		$this->h = $matches['h'] ?? 0;
		$this->i = $matches['i'] ?? 0;
		$this->s = $matches['s'] ?? 0;
		$this->f = $matches['f'] ?? 0.0;
		$this->days = false;
		$this->from_string = false;
	}

	/**
	 * Formats the interval as a string so it can be reconstructed later.
	 *
	 * @return string A ISO 8601 duration string suitable for reconstructing
	 *    this interval.
	 */
	public function __toString(): string
	{
		$format = 'P';

		foreach (['y', 'm', 'd', 'h', 'i', 's'] as $prop) {
			if ($prop === 'h') {
				$format .= 'T';
			}

			if (!empty($this->{$prop}) || ($prop === 's' && !empty($this->f))) {
				$format .= '%' . $prop . ($prop === 'i' ? 'M' : strtoupper($prop));
			}
		}

		$string = rtrim($this->format($format), 'PT');

		if ($string === '') {
			$string = 'PT0S';
		}

		if (!empty($this->f)) {
			$string = preg_replace_callback('/\d+(?=S)/', fn($m) => $m[0] + $this->f, $string);
		}

		return $string;
	}

	/**
	 * Formats this interval as a string that can be parsed by
	 * TimeInterval::createFromDateString().
	 *
	 * @return string A parsable string suitable for reconstructing
	 *    this interval.
	 */
	public function toParsable(): string
	{
		$result = [];

		$props = [
			'invert' => null,
			'y' => 'years',
			'm' => 'months',
			'd' => 'days',
			'h' => 'hours',
			'i' => 'minutes',
			's' => 'seconds',
			'f' => 'microseconds',
		];

		foreach ($props as $prop => $string) {
			if (empty($this->{$prop})) {
				continue;
			}

			switch ($prop) {
				case 'invert':
					$result[] = '-';
					break;

				default:
					$result[] = $this->format('%' . $prop) . ' ' . $string;
					break;
			}
		}

		if (empty($result)) {
			$result[] = '0 seconds';
		}

		return implode(' ', $result);
	}

	/**
	 * Converts this interval to a number of seconds.
	 *
	 * Because months have variable lengths, leap years exist, etc., it is
	 * necessary to provide a reference date that the interval will measure
	 * from in order to calculate the exact number of seconds.
	 *
	 * @param \DateTimeInterface $when Reference date that this interval will
	 *    be added to in order to calculate the exact number of seconds.
	 * @return int|float Number of seconds in this interval, counting from the
	 *    reference date.
	 */
	public function toSeconds(\DateTimeInterface $when): int|float
	{
		$later = \DateTime::createFromInterface($when);
		$later->add($this);

		$fmt = !empty($this->f) ? 'U.u' : 'U';

		return ($later->format($fmt) - $when->format($fmt));
	}

	/**
	 * Formats the interval using an arbitrary format string.
	 *
	 * @param string $format The format string. Accepts all the same format
	 *    specifiers that \DateInterval::format() accepts.
	 * @return string The formatted interval.
	 */
	public function format(string $format): string
	{
		return strtr($format, [
			'%Y' => sprintf('%02d', $this->y),
			'%y' => sprintf('%01d', $this->y),
			'%M' => sprintf('%02d', $this->m),
			'%m' => sprintf('%01d', $this->m),
			'%D' => sprintf('%02d', $this->d),
			'%d' => sprintf('%01d', $this->d),
			'%a' => is_int($this->days) ? sprintf('%01d', $this->days) : '(unknown)',
			'%H' => sprintf('%02d', $this->h),
			'%h' => sprintf('%01d', $this->h),
			'%I' => sprintf('%02d', $this->i),
			'%i' => sprintf('%01d', $this->i),
			'%S' => sprintf('%02d', $this->s),
			'%s' => sprintf('%01d', $this->s),
			'%F' => substr(sprintf('%06f', $this->f), 2),
			'%f' => ltrim(sprintf('%06f', $this->f), '0.'),
			'%R' => $this->invert ? '-' : '+',
			'%r' => $this->invert ? '-' : '',
			'%%' => '%',
		]);
	}

	/***********************
	 * Public static methods
	 ***********************/

	/**
	 * Convert a \DateInterval object into a TimeInterval object.
	 *
	 * @param string $object A \DateInterval object.
	 * @return TimeInterval A TimeInterval object.
	 */
	public static function createFromDateInterval(\DateInterval $object): static
	{
		$new = new TimeInterval('P0D');

		foreach (get_object_vars($object) as $prop => $value) {
			$new->{$prop} = $value;
		}

		return $new;
	}

	/**
	 * Creates a TimeInterval from the relative parts of a date string.
	 *
	 * @param string $datetime A date with relative parts.
	 * @return TimeInterval A TimeInterval object.
	 */
	public static function createFromDateString(string $datetime): static
	{
		$object = parent::createFromDateString($datetime);

		$new = self::createFromDateInterval($object);

		$new->y = (int) $object->format('%y');
		$new->m = (int) $object->format('%m');
		$new->d = abs((int) $object->format('%d'));
		$new->h = (int) $object->format('%h');
		$new->i = (int) $object->format('%i');
		$new->s = (int) $object->format('%s');
		$new->f = (float) ('0.' . $object->format('%F'));
		$new->invert = (int) ($object->format('%d') < 0);

		return $new;
	}
}

?>