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

namespace SMF\OutputTypes;

use SMF\OutputTypeInterface;

class Xml implements OutputTypeInterface
{
	/****************
	 * Public methods
	 ****************/

	public function getMimeType(): string
	{
		return 'application/xml';
	}
}

?>