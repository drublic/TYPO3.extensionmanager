<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/


/**
 * Display a deactivate / activate link
 *
 * @author Susanne Moog <typo3@susannemoog.de>
 * @package Extension Manager
 * @subpackage ViewHelpers
 */
class Tx_Extensionmanager_ViewHelpers_ToggleExtensionInstallationStateViewHelper
	extends Tx_Fluid_ViewHelpers_Link_ActionViewHelper {

	/**
	 * @var string
	 */
	protected $tagName = 'a';

	/**
	 * Renders an install link
	 *
	 * @param string $extension
	 * @return string the rendered a tag
	 */
	public function render($extension) {
		$uriBuilder = $this->controllerContext->getUriBuilder();
		$action = 'toggleExtensionInstallationState';
		$uri = $uriBuilder
			->reset()
			->uriFor($action, array(
				'extension' => $extension['key']
			), 'Action');
		$this->tag->addAttribute('href', $uri);
		$label = $extension['installed'] ? 'Deactivate' : 'Activate';
		$this->tag->setContent($label);

		return $this->tag->render();
	}
}

?>