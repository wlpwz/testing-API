

function showLineChart(divId ,title, subtitle, legendData, xAxisData, seriesData, precision) {
	if(precision == null) {
		precision = 0;
	}
	if(typeof(toolboxY) == 'undefined') {
		toolboxY = 'top';
	}
  //echarts
  require.config({
    packages: [
      {
        name: 'echarts',
        location: '/static/echarts/src',
        main: 'echarts'
      },
      {
        name: 'zrender',
        //location: 'http://ecomfe.github.io/zrender/src',
        location: '/static/echarts/zrender/src',
        main: 'zrender'
      }
    ]
  });

  require(
    [
      'echarts',
      'echarts/chart/line',
      'echarts/chart/bar'
    ],
    function (ec) {
      var chart = ec.init(document.getElementById(divId));
      var option = {
        title : {
        x: 'center',
        text: title,
				subtext: subtitle,
      	},
				tooltip : {
          trigger: 'axis'
        },
      xAxis : [
        {
            type : 'category',
            splitLine : {show : false},
            data : xAxisData
        }
      ],
      yAxis : [
        {
            type : 'value',
						power : 1,
						scale : true,
            precision : precision,
            splitNumber : 9,
            position : 'right',
            splitArea : {show : true}
        }
      ],
      legend: {
				orient : 'vertical',
				x : 'left',
        data: legendData
      },
      toolbox: {
         show : true,
				 y : toolboxY,
         feature : {
             mark : true,
						 dataZoom : true,
             dataView : {readOnly: false},
             magicType : ['line', 'bar'],
             restore : true,
             saveAsImage : true
         }
      },
      calculable : true,
      series : seriesData
    };
    chart.setOption(option);
  });
};
