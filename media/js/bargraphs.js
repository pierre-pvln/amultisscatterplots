jQuery.get(visualisation_data_url,
		function (data, textStatus) {
		  Highcharts.chart('map-bargraph', {
			chart: {
				type: 'column',
				zoomType: 'x',
				backgroundColor: '#F2F4F8',
			},
			
			title: {
				text: graph_title_text
			},

			subtitle: {
				text: 'Number and type of ships per day'
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
