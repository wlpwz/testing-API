function showRadarChart(divId, title, subtitle, legendData, indicatorData, seriesData){
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
          'echarts/chart/radar'
      ],
      function(ec){
          var chart = ec.init(document.getElementById(divId));
					var option = {
						title : {
							text: title,
							subtext: subtitle,
						},
						tooltip : {
							trigger: 'axis'
						},
						legend: {
							orient : 'vertical',
							x : 'right',
							y : 'bottom',
							data: legendData
						},
						toolbox: {
							show : true,
							feature : {
								mark : true,
								dataView : {readOnly: false},
								restore : true,
								saveAsImage : true
							}
						},
						polar : [
							{
								indicator : indicatorData
							}
						],
						calculable : true,
						series : seriesData
					};

          chart.setOption(option);                                                                                                                   
      });		
}
