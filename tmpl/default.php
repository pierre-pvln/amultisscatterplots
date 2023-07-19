<?php 
/**
 * @package     mod_amultisscatterplots
 * @author      Pierre Veelen, amultis.eu
 * @copyright   Copyright (C) 2023 Pierre Veelen. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 *
 * default.php  Used to output the data to html page.
 *
 */

/*
 * No direct access to this file
 */
defined('_JEXEC') or die;

/* $document = JFactory::getDocument(); */
/* $document->addScript('https://code.highcharts.com/highcharts.js'); */

?>

<!-- Get the module class suffix-->
<div class="<?php echo $params->get("moduleclass_sfx");?>">

	<!-- Get the text to be displayed before the graph-->
	<div> <?php echo $params->get("pretext");?> </div>

	<div id='map-bargraph' style='width: 100%; height: 600px;'></div>
	
    <!-- Load highcharts graphs library -->
	<script src="https://code.highcharts.com/highcharts.js"></script>
	
	<!-- Set required parameters -->
	<script>
		visualisation_data_url = <?php echo '"'.$params->get("visualisation_data_url").'"' ?>;
		graph_title_text = <?php echo '"'.$params->get("graph_title_text").'"' ?>;
    </script>
	
	<!-- load graph -->
	<script src="./media/mod_amultisscatterplots/js/bargraphs.js"></script>

	<!-- Get the text to be displayed after the graph-->	
	<div><?php echo $params->get("posttext");?></div>

</div>
