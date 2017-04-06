function showScatterChart(divId, title, subtitle, legendData, seriesData){
	 require.config({
		packages: [
			{
				name: 'echarts',
				location: '/static/echarts/src',
				main: 'echarts'
			},
			{
				name: 'zrender',
				location: '/static/echarts/zrender/src',
				main: 'zrender'
			}
		]
	});

	require(
			[
					'echarts',
					'echarts/chart/scatter'
			],
			function(ec){
					var chart = ec.init(document.getElementById(divId));
					var option = {
						title : {
							text: title,
							subtext: subtitle
						},
						tooltip : {
							trigger: 'item',
							formatter : function(value) {
								var day = new Date(parseInt(value[2][0])*1000).toLocaleString().substr(0,11);;
								return value[0] + ' :<br/>'
									 + day + value[2][1];
							}
						},
						legend: {
							data:legendData
						},
						toolbox: {
							show : true,
							feature : {
								mark : true,
								dataZoom : true,
								dataView : {readOnly: false},
								restore : true,
								saveAsImage : true
							}
						},
						xAxis : [
							{
								type : 'value',
								power: 1,
								precision: 2,
								scale:true,
								axisLabel : {
									formatter: function(value) {
										var d = new Date(parseInt(value)*1000);
										return d.getMonth()+1 + "月";
									}
								}
							}
						],
						yAxis : [
							{
								type : 'value',
								power: 1,
								precision: 2,
								scale:true,
								axisLabel : {
									formatter: '{value}'
								},
								splitArea : {show : true}
							}
						],
						series : seriesData
					};
				chart.setOption(option);																																																									 
			});		
}
