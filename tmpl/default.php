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
 * - \defined checks global namespace 
 * - defined checks local namespace
 */
\defined('_JEXEC') or die;
?>

<!--
<script>
	var visualisation_data_url = <?php echo '"'.$params->get("visualisation_data_url").'"' ?>;
	var graph_title_text = <?php echo '"'.$params->get("graph_title_text").'"' ?>;
	var graph_subtitle_text = <?php echo '"'.$params->get("graph_subtitle_text").'"' ?>;
	var DOM_element = '<?php echo 'map-scattergraph-'.$module->id;?>';
	
	console.log('== default.php ==');
    console.log(visualisation_data_url);
    console.log(graph_title_text);
    console.log(graph_subtitle_text);
    console.log(DOM_element);
    console.log('===');
</script>
-->

<!-- Get the module class suffix-->
<div class="<?php echo $params->get("moduleclass_sfx");?>">
	
	<!-- Get the text to be displayed before the graph-->
	<div><?php echo $params->get("pretext");?> </div>

    <!-- Create unique id for displaying the graph-->
	<div id="<?php echo 'map-scattergraph-'.$module->id;?>" style='width: 100%; height: 600px;'></div>
	
    <!-- Load highcharts graphs library -->
	<!-- <script src="https://code.highcharts.com/highcharts.js"></script> -->
		
	<!-- load graph -->
	<!--<script src="./media/mod_amultisscatterplots/js/scatterplots.js"></script> -->

	<!-- Get the text to be displayed after the graph-->	
	<div><?php echo $params->get("posttext");?></div>

</div>
