

function showLinePieChart(divId, legendData, xAxisData, seriesLine, precision) {
  if(precision == null) {
    precision = 0;
  }
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
      'echarts/chart/line'
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
            //power : 1,
            //scale : true,
            precision : precision,
            splitNumber : 9,
            position : 'right',
            splitArea : {show : true}
        }
     ],
     legend: {
         x: 'left',
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
      calculable : true,
     series : seriesLine 
  	};
  	chart.setOption(option);
  });
};
