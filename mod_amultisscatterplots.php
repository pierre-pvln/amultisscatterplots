<?php
 
/**
 * @package     mod_amultisscatterplots
 * @author      Pierre Veelen, amulits.dev
 * @copyright   Copyright (C) 2023 Pierre Veelen. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

/*
 * No direct access to this file
 * - \defined checks global namespace 
 * - defined checks local namespace
 */
\defined('_JEXEC') or die;

/*
 * Import ModuleHelper to our current scope at the begin of the file. 
 * We need it later for displaying the output.
 */
use Joomla\CMS\Helper\ModuleHelper;

/*
 * Import Factory to our current scope at the begin of the file. 
 * We need it later for adding javascripts.
 */
use Joomla\CMS\Factory;

/*
 * Load Jquery, Needed for Highcharts
 *
 */
use Joomla\CMS\HTML\HTMLHelper;
HTMLHelper::_('jquery.framework');

/*
 * Import Helper to our current scope at the begin of the file. 
 * We need it later for displaying the output.
 */
//use aMultisNamespace\Module\ScatterPlots\Site\Helper\ScatterPlotsHelper;

/**
 * Retrieve the installed extensions of the Joomla! website in $list
 *
 * @params	An object containing the module parameters as set in the back-end for the module;
 * 			Not used in this one yet (for future use).
 *
 */
//$list = ScatterPlotsHelper::getItems($params);

/**
 * Get layout values from back-end setting tab advanced in $params 
 * This retrieves the 'layout' parameter. Note the second part
 * which states to use a default value of 'default' if the parameter 'layout' cannot be
 * retrieved for some reason
 * 
 */
$layout = $params->get('layout','default');

/**
 * Load the generic highcharts.js graphs library
 *
 */
$document = Factory::getDocument();
$document->addScript('https://code.highcharts.com/highcharts.js');

/**
 * This method returns the path to the layout file for the module.
 * Output depends if the layout has not been overridden or not. 
 * 
 */
require ModuleHelper::getLayoutpath('mod_amultisscatterplots', $layout);

echo "<div id=debug-dummy-id-1>Einde van php deel mod_amultisscatterplots.php</div>";

?>
<div id=debug-dummy-id-2>Einde van html deel mod_amultisscatterplots.php</div>
