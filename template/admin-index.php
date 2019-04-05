<body>
<script src="http://cdn.highcharts.com.cn/highcharts/highcharts.js"></script>
<script src="https://img.highcharts.com.cn/highcharts/highcharts-3d.js"></script>
<div class="am-g">
    <div class="am-u-sm-12">
	<legend>数据概览</legend>
		<div id="container" style="height: 500px"></div>
		<br>
		<div class="am-panel am-panel-default">
    <div class="am-panel-bd">通过该组件,可以观察用户的时间趋向,用于探索未来的线下活动</div>
</div>
	</div>
</div>
</div>
 <script>
 var chart=null;
 Highcharts.setOptions({ global: { useUTC: false } }); 
$(document).ready(function() {
 // Give the points a 3D feel by adding a radial gradient
Highcharts.getOptions().colors = $.map(Highcharts.getOptions().colors, function (color) {
	return {
		radialGradient: {
			cx: 0.4,
			cy: 0.3,
			r: 0.5
		},
		stops: [
			[0, color],
			[1, Highcharts.Color(color).brighten(-0.2).get('rgb')]
		]
	};
});
// Set up the chart
 chart = new Highcharts.Chart({
	chart: {
		renderTo: 'container',
		margin: 100,
		type: 'scatter',
		
		options3d: {
			enabled: true,
			alpha: 10,
			beta: 30,
			depth: 250,
			viewDistance: 5,
			frame: {
				bottom: { size: 1, color: 'rgba(0,0,0,0.02)' },
				back: { size: 1, color: 'rgba(0,0,0,0.04)' },
				side: { size: 1, color: 'rgba(0,0,0,0.06)' }
			}
		}
	},
	title: {
		text: '运动时间分布'
	},
	subtitle: {
		text: '最近7天的运动时间数据'
	},
	plotOptions: {
		
	},
	yAxis: {
		min: 0,
		max: 23,
		title: "小时"
	},
	xAxis: {
		min:<?php loadfirst(); ?>,
		type:"datetime",
		title:"日期"
	},
	zAxis: {
		min: 0,
		max: 59,
		title:"分钟"
	},
	legend: {
		enabled: false
	},
	series: [{
		name: '户外跑',
		colorByPoint: true,
		data: <?php loaddata(); ?>
		}]
});
// Add mouse events for rotation
$(chart.container).bind('mousedown.hc touchstart.hc', function (e) {
	e = chart.pointer.normalize(e);
	var posX = e.pageX,
		posY = e.pageY,
		alpha = chart.options.chart.options3d.alpha,
		beta = chart.options.chart.options3d.beta,
		newAlpha,
		newBeta,
		sensitivity = 5; // lower is more sensitive
	$(document).bind({
		'mousemove.hc touchdrag.hc': function (e) {
			// Run beta
			newBeta = beta + (posX - e.pageX) / sensitivity;
			newBeta = Math.min(100, Math.max(-100, newBeta));
			chart.options.chart.options3d.beta = newBeta;
			// Run alpha
			newAlpha = alpha + (e.pageY - posY) / sensitivity;
			newAlpha = Math.min(100, Math.max(-100, newAlpha));
			chart.options.chart.options3d.alpha = newAlpha;
			chart.redraw(false);
		},
		'mouseup touchend': function () {
			$(document).unbind('.hc');
		}
	});
});
});

 </script>
</body>