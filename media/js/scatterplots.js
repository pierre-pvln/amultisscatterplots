// Retrieve the options set for "mod_amultisscatterplots"
var options = Joomla.getOptions('mod_amultisscatterplots');

console.log('1= scatterplots.js ==');
console.log(options);

//Check if any options available
if(options.length !== 0) {
  console.log('2= scatterplots.js ==');
  console.log(options.length);
  console.log('options array not empty');
  for (i in options) {
	// Access individual options
	let visualisation_data_url = options[i].visualisation_data_url;
	let graph_title_text = options[i].graph_title_text;
	let graph_subtitle_text = options[i].graph_subtitle_text;
	let module_id_name = options[i].module_id_name;

	console.log('3= scatterplots.js ==');
	console.log(visualisation_data_url);
	console.log(graph_title_text);
	console.log(graph_subtitle_text);
	console.log(module_id_name);
	console.log('4= scatterplots.js ==');

	/* Inspiration: https://www.highcharts.com/docs/getting-started/how-to-set-options#global-options
	 * If you want to apply a set of options to all charts on the same page, use Highcharts.setOptions like shown below. 
	 */
	Highcharts.setOptions({
		colors: ['rgba(5,141,199,0.5)', 'rgba(80,180,50,0.5)', 'rgba(237,86,27,0.5)']
	});

	const series = [{
		name: 'Basketball',
		id: 'basketball',
		marker: { 
			symbol: 'circle'
		}
	},
	{
		name: 'Triathlon',
		id: 'triathlon',
		marker: {
			symbol: 'triangle'
		}
	},
	{
		name: 'Volleyball',
		id: 'volleyball',
		marker: {
			symbol: 'square'
		}
	}];

	// get the data asynchronous
	async function getData() {
		const response = await fetch(
	        visualisation_data_url
	//		'https://cdn.jsdelivr.net/gh/highcharts/highcharts@24912efc85/samples/data/olympic2012.json'
		);
		return response.json();
	}

	getData().then(data => {
		const getData = sportName => {
			const temp = [];
			data.forEach(elm => {
				if (elm.sport === sportName && elm.weight > 0 && elm.height > 0) {
					temp.push([elm.height, elm.weight]);
				}
			});
			return temp;
		};
		
		series.forEach(s => {
			s.data = getData(s.id);
		});
        console.log(series)

		/* Inspiration https://stackoverflow.com/questions/762011/what-is-the-difference-between-let-and-var
		 * 
		 * Using let to define unique value; with each iteration you get a new variable (see Loops with closures in inspiration) 
		 */
		let scatter_chart = Highcharts.chart(module_id_name, {
			chart: {
				type: 'scatter',
				zoomType: 'xy'
			},
			title: {
				text: graph_title_text,
				align: 'left'
			},
			subtitle: {
				text:
				graph_subtitle_text + ' ' +
			  'Source: <a href="https://www.theguardian.com/sport/datablog/2012/aug/07/olympics-2012-athletes-age-weight-height">The Guardian</a>',
				align: 'left'
			},
			xAxis: {
				title: {
					text: 'Height'
				},
				labels: {
					format: '{value} m'
				},
				startOnTick: true,
				endOnTick: true,
				showLastLabel: true
			},
			yAxis: {
				title: {
					text: 'Weight'
				},
				labels: {
					format: '{value} kg'
				}
			},
			legend: {
				enabled: true
			},
			plotOptions: {
				scatter: {
					marker: {
						radius: 2.5,
						symbol: 'circle',
						states: {
							hover: {
								enabled: true,
								lineColor: 'rgb(100,100,100)'
							}
						}
					},
					states: {
						hover: {
							marker: {
								enabled: false
							}
						}
					},
					jitter: {
						x: 0.005
					}
				}
			},
			tooltip: {
				pointFormat: 'Height: {point.x} m <br/> Weight: {point.y} kg'
			},
			series
		});
	}
	);

  }
};


