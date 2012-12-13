<div class="span4">
<script type="text/javascript">
$(function () {
	var chart = new Highcharts.Chart({
		chart: {
			backgroundColor: "#DFDFDF",
			renderTo: 'mapred_slot_realtime',
			type: 'gauge',
			plotBorderWidth: 1,
			plotBackgroundColor: {
			linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
				stops: [
					[0, '#FFF4C6'],
					[0.3, '#EFFFFF'],
					[1, '#FFF4C6']
				]
			},
			plotBackgroundImage: null,
			height: 200
		},
	
		title: {
			text: 'Map/Reduce Slots'
		},
		
		pane: [{
			startAngle: -45,
			endAngle: 45,
			background: null,
			center: ['25%', '145%'],
			size: 300
		}, {
			startAngle: -45,
			endAngle: 45,
			background: null,
			center: ['75%', '145%'],
			size: 300
		}],						
	
		yAxis: [{
			min: 0, //-20,
			max: <?php echo $maxMapTasks;?>, //6,
			minorTickPosition: 'outside',
			tickPosition: 'outside',
			labels: {
				rotation: 'auto',
				distance: 20
			},
			plotBands: [{
				from: 0,
				to: 0,
				color: '#C02316',
				innerRadius: '100%',
				outerRadius: '105%'
			}],
			pane: 0,
			title: {
				text: 'Using<br/><span style="font-size:8px">Map Slots</span>',
				y: -40
			}
		}, {
			min: 0, //-20,
			max: <?php echo $maxReduceTasks;?>, //6,
			minorTickPosition: 'outside',
			tickPosition: 'outside',
			labels: {
				rotation: 'auto',
				distance: 20
			},
			plotBands: [{
				from: 0,
				to: 0,
				color: '#C02316',
				innerRadius: '100%',
				outerRadius: '105%'
			}],
			pane: 1,
			title: {
				text: 'Using<br/><span style="font-size:8px">Reduce Slots</span>',
				y: -40
			}
		}],
		
		plotOptions: {
			gauge: {
				dataLabels: {
					enabled: false
				},
				dial: {
					radius: '100%'
				}
			}
		},
			
	
		series: [{
			data: [<?php echo $maxMapTasks;?>],
			yAxis: 0
		}, {
			data: [<?php echo $maxReduceTasks;?>],
			yAxis: 1
		}]
	
	},
	
	function(chart) {
		setInterval(function() {
			var left = chart.series[0].points[0];
			var right = chart.series[1].points[0];
			var leftVal;
			var rightVal;

			$.getJSON('<?php echo $this->config->base_url();?>index.php/manage/GetClusterStatus/', function(data){
				leftVal =  data.mapTasks;
				rightVal = data.reduceTasks;
				
				left.update(leftVal, false);
				right.update(rightVal, false);
				chart.redraw();
			});
	
		}, 2000);
	
	});
});
</script>


<script type="text/javascript">
var map=0;

$(function () {
	$(document).ready(function() {
		Highcharts.setOptions({
			global: {
				useUTC: false
			}
		});

		var chart;
		chart = new Highcharts.Chart({
			chart: {
				backgroundColor: "#DFDFDF",
				renderTo: 'mapred_slots_lines',
				type: 'spline',
				marginRight: 10,
				events: {
					load: function() {

						// set up the updating of the chart each second
						var series = this.series[0];
						setInterval(function() {
							var x = (new Date()).getTime(), // current time
								y = map;
								
							series.addPoint([x, y], true, true);
							$.getJSON("<?php echo $this->config->base_url();?>index.php/manage/GetClusterStatus/", function(data){
								map=data.mapTasks;
							});
						}, 2000);
					}
				}
			},
			title: {
				text: 'Map/Reduce Slots used'
			},
			xAxis: {
				type: 'datetime',
				tickPixelInterval: 150
			},
			yAxis: {
				title: {
					text: 'Value'
				},
				plotLines: [{
					value: 0,
					width: 1,
					color: '#808080'
				}]
			},
			tooltip: {
				formatter: function() {
						return '<b>'+ this.series.name +'</b><br/>'+
						Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
						Highcharts.numberFormat(this.y, 2);
				}
			},
			legend: {
				enabled: false
			},
			exporting: {
				enabled: false
			},
			series: [{
				name: 'Map Slots',
				data: (function() {
					// generate an array of random data
					var data = [],
						time = (new Date()).getTime(),
						i;
	
					for (i = -19; i <= 0; i++) {
						data.push({
							x: time + i * 1000,
							y: 0//Math.random()
						});
					}
					return data;
				})()
			}]
		});
	});
	
});
</script>
<div id="mapred_slot_realtime" style="width: 600px; height: 300px; "></div>
<div id="mapred_slots_lines" style="width: 600px; height: 200px; "></div>
</div>