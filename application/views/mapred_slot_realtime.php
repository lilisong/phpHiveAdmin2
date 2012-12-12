<div class="span4">
		<script type="text/javascript">
$(function () {
	var chart = new Highcharts.Chart({
	
	    chart: {
	        renderTo: 'mapred_slot_realtime',
	        type: 'gauge',
	        plotBorderWidth: 1,
	        plotBackgroundColor: {
	        	linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	        	stops: [
	        		[0, '#FFF4C6'],
	        		[0.3, '#FFFFFF'],
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
	        data: [-20],
	        yAxis: 0
	    }, {
	        data: [-20],
	        yAxis: 1
	    }]
	
	},
	
	// Let the music play
	function(chart) {
	    setInterval(function() {
	        var left = chart.series[0].points[0],
	            right = chart.series[1].points[0],
	            leftVal, 
	            inc = (Math.random() - 0.5) * 3;
	
	        //leftVal =  left.y + inc;
	        //rightVal = leftVal + inc / 3;
			leftVal =  <?php echo $mapTasks;?>;
	        rightVal = <?php echo $reduceTasks;?>;
	        /*if (leftVal < 0 || leftVal > <?php echo $maxMapTasks;?>) {
	            leftVal = left.y - inc;
	        }
	        if (rightVal < 0 || rightVal > <?php echo $maxReduceTasks;?>) {
	            rightVal = leftVal;
	        }*/
	
	        left.update(leftVal, false);
	        right.update(rightVal, false);
	        chart.redraw();
	
	    }, 1000);
	
	});
});

		</script>

<div id="mapred_slot_realtime" style="width: 600px; height: 300px; "></div>
</div>