<?php
/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines https://www.simplemachines.org
 * @copyright 2023 Simple Machines and individual contributors
 * @license https://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 3.0 Alpha 1
 */

use SMF\Config;
use SMF\Lang;
use SMF\Theme;
use SMF\Utils;

/**
 * Choose which type of report to run?
 */
function template_report_type()
{
	echo '
		<form action="', Config::$scripturl, '?action=admin;area=reports" method="post" accept-charset="', Utils::$context['character_set'], '">
			<div class="cat_bar">
				<h3 class="catbg">', Lang::$txt['generate_reports_type'], '</h3>
			</div>
			<div class="windowbg">
				<dl class="settings">';

	// Go through each type of report they can run.
	foreach (Utils::$context['report_types'] as $type)
	{
		if (isset($type['description']))
			echo '
					<dt>', $type['description'], '</dt>';

		echo '
					<dd>
						<input type="radio" id="rt_', $type['id'], '" name="rt" value="', $type['id'], '"', $type['is_first'] ? ' checked' : '', '>
						<strong><label for="rt_', $type['id'], '">', $type['title'], '</label></strong>
					</dd>';
	}
	echo '
				</dl>
				<input type="submit" name="continue" value="', Lang::$txt['generate_reports_continue'], '" class="button">
				<input type="hidden" name="', Utils::$context['session_var'], '" value="', Utils::$context['session_id'], '">
			</div><!-- .windowbg -->
		</form>';
}

/**
 * This is the standard template for showing reports.
 */
function template_main()
{
	echo '
		<div class="cat_bar">
			<h3 class="catbg">', Lang::$txt['results'], '</h3>
		</div>
		<div id="report_buttons">';

	if (!empty(Utils::$context['report_buttons']))
		template_button_strip(Utils::$context['report_buttons'], 'right');

	echo '
		</div>';

	// Go through each table!
	foreach (Utils::$context['tables'] as $table)
	{
		echo '
		<table class="table_grid report_results">';

		if (!empty($table['title']))
			echo '
			<thead>
				<tr class="title_bar">
					<th scope="col" colspan="', $table['column_count'], '">', $table['title'], '</th>
				</tr>
			</thead>
			<tbody>';

		// Now do each row!
		$row_number = 0;
		foreach ($table['data'] as $row)
		{
			if ($row_number == 0 && !empty($table['shading']['top']))
				echo '
				<tr class="windowbg table_caption">';
			else
				echo '
				<tr class="', !empty($row[0]['separator']) ? 'title_bar' : 'windowbg', '">';

			// Now do each column.
			$column_number = 0;

			foreach ($row as $data)
			{
				// If this is a special separator, skip over!
				if (!empty($data['separator']) && $column_number == 0)
				{
					echo '
					<td colspan="', $table['column_count'], '" class="smalltext">
						', $data['v'], ':
					</td>';
					break;
				}

				// Shaded?
				if ($column_number == 0 && !empty($table['shading']['left']))
					echo '
					<td class="table_caption ', $table['align']['shaded'], 'text"', $table['width']['shaded'] != 'auto' ? ' width="' . $table['width']['shaded'] . '"' : '', '>
						', $data['v'] == $table['default_value'] ? '' : ($data['v'] . (empty($data['v']) ? '' : ':')), '
					</td>';
				else
					echo '
					<td class="smalltext centertext" ', $table['width']['normal'] != 'auto' ? ' width="' . $table['width']['normal'] . '"' : '', !empty($data['style']) ? ' style="' . $data['style'] . '"' : '', '>
						', $data['v'], '
					</td>';

				$column_number++;
			}

			echo '
				</tr>';

			$row_number++;
		}
		echo '
			</tbody>
		</table>';
	}
}

/**
 * Header of the print page!
 */
function template_print_above()
{
	echo '<!DOCTYPE html>
<html', Utils::$context['right_to_left'] ? ' dir="rtl"' : '', '>
	<head>
		<meta charset="', Utils::$context['character_set'], '">
		<title>', Utils::$context['page_title'], '</title>
		<link rel="stylesheet" href="', Theme::$current->settings['default_theme_url'], '/css/report.css', Utils::$context['browser_cache'], '">
	</head>
	<body>';
}

/**
 * The main print page
 */
function template_print()
{
	// Go through each table!
	foreach (Utils::$context['tables'] as $table)
	{
		echo '
		<div style="overflow: visible;', $table['max_width'] != 'auto' ? ' width: ' . $table['max_width'] . 'px;' : '', '">
			<table class="bordercolor">';

		if (!empty($table['title']))
			echo '
				<tr class="title_bar">
					<td colspan="', $table['column_count'], '">
						', $table['title'], '
					</td>
				</tr>';

		// Now do each row!
		$row_number = 0;
		foreach ($table['data'] as $row)
		{
			if ($row_number == 0 && !empty($table['shading']['top']))
				echo '
				<tr class="titlebg">';
			else
				echo '
				<tr class="windowbg">';

			// Now do each column!!
			$column_number = 0;
			foreach ($row as $data)
			{
				// If this is a special separator, skip over!
				if (!empty($data['separator']) && $column_number == 0)
				{
					echo '
					<td colspan="', $table['column_count'], '" class="smalltext">
						<strong>', $data['v'], ':</strong>
					</td>';
					break;
				}

				// Shaded?
				if ($column_number == 0 && !empty($table['shading']['left']))
					echo '
					<td class="titlebg ', $table['align']['shaded'], 'text"', $table['width']['shaded'] != 'auto' ? ' width="' . $table['width']['shaded'] . '"' : '', '>
						', $data['v'] == $table['default_value'] ? '' : ($data['v'] . (empty($data['v']) ? '' : ':')), '
					</td>';
				else
					echo '
					<td class="centertext" ', $table['width']['normal'] != 'auto' ? ' width="' . $table['width']['normal'] . '"' : '', !empty($data['style']) ? ' style="' . $data['style'] . '"' : '', '>
						', $data['v'], '
					</td>';

				$column_number++;
			}

			echo '
				</tr>';

			$row_number++;
		}
		echo '
			</table>
		</div>
		<br>';
	}
}

/**
 * Footer of the print page.
 */
function template_print_below()
{
	echo '
		<div class="copyright">', Theme::copyright(), '</div>
	</body>
</html>';
}

?>