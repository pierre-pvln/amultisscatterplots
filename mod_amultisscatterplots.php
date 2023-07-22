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
use aMultisNamespace\Module\ScatterPlots\Site\Helper\ScatterPlotsHelper;

/**
 * Retrieve the installed extensions of the Joomla! website in $list
 *
 * @params	An object containing the module parameters as set in the back-end for the module;
 * 			Not used in this one yet (for future use).
 *
 */
$list = ScatterPlotsHelper::getItems($params);

/**
 * Load the generic highcharts.js graphs library
 *
 */
$document = Factory::getDocument();
$document->addScript('https://code.highcharts.com/highcharts.js');
//$document->addScript('/media/mod_amultisscatterplots/js/scatterplots.js');
 	
/**
 * Get layout values from back-end setting tab advanced in $params 
 * This retrieves the 'layout' parameter. Note the second part
 * which states to use a default value of 'default' if the parameter 'layout' cannot be
 * retrieved for some reason
 * 
 */
$layout = $params->get('layout','default');
	
/**
 * This method returns the path to the layout file for the module.
 * Output depends if the layout has not been overridden or not. 
 * 
 */
require ModuleHelper::getLayoutpath('mod_amultisscatterplots', $layout);
?>
<script>
	<!-- Set required parameters for the scatterplots.js -->
	var visualisation_data_url = <?php echo '"'.$params->get("visualisation_data_url").'"' ?>;
	var graph_title_text = <?php echo '"'.$params->get("graph_title_text").'"' ?>;
	var graph_subtitle_text = <?php echo '"'.$params->get("graph_subtitle_text").'"' ?>;
	var DOM_element = '<?php echo 'map-scattergraph-'.$module->id;?>';
	
	console.log('== mod_amultisscatterplots.php ==');
    console.log(visualisation_data_url);
    console.log(graph_title_text);
    console.log(graph_subtitle_text);
    console.log(DOM_element);
    console.log('===');
	
	jQuery.get(visualisation_data_url,
		function (data, textStatus) {
          // https://api.highcharts.com/class-reference/Highcharts.Chart
		  // 
		  Highcharts.chart(DOM_element, {
			chart: {
				type: 'column',
				zoomType: 'x',
				backgroundColor: '#F2F4F8',
			},
			
			title: {
				text: graph_title_text
			},

			subtitle: {
				text: graph_subtitle_text
			},
			
			xAxis: {
				type: 'datetime',
				labels: {
					rotation: -45
				},
				TickInterval: 24 * 60 * 60 * 1000 // 1 day
			  },

			yAxis: {
				title: {
				  text: 'Number of ships'
				},				
			},				

			tooltip: {
				formatter: function() {
				  var stackName = this.series.userOptions.stack;
				  return '<b>' + stackName + '</b><br/><b>' + Highcharts.dateFormat('%d %b %Y', this.x) + '</b><br/>' +
					this.series.name + ': ' + this.y + '<br/>' +
					'Total: ' + this.point.stackTotal;
				}
			
			},
			
			legend: {
				labelFormatter: function() {
				  return this.name + ' (' + this.userOptions.stack + ')';
				}
			},
			
			plotOptions: {
				column: {
					stacking: 'normal'
					},
					
				series: {
					marker: {
						enabled: false
					}
				}

			},

			series: data
			});
		}
	);
	
</script>
