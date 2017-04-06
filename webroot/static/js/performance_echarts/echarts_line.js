function showLineChart(divId, legendData, xAxisData, seriesData, precision, unit) {
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
            splitArea : {show : true},
			axisLabel :{
                formatter: '{value}' + unit
			}
        }
      ],
      legend: {
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
	  dataZoom: {
		orient : "horizontal",
		show : true, 
		realtime : true,
		start : 0,
		end : 100
	},
      calculable : true,
      series : seriesData
    };
    chart.setOption(option);
  });
};
