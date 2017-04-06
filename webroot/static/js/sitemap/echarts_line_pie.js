

function showLinePieChart(divId, legendData, xAxisData, seriesLine, seriesPie, precision) {
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
      'echarts/chart/pie',
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
     series : [
         {
             name:'数值',
             type:'line',
             data: seriesLine
         },
         {
             name:'分布情况',
             type:'pie',
						 tooltip : {
								trigger: 'item',
								formatter: '{a} <br/>{b} : {c} ({d}%)'
						 },
             radius : [0, 60],
             center: [180,130],
             itemStyle :　{
                 normal : {
                     labelLine : {
                         length : 30
                     }
                 }
             },
             data: seriesPie
         }
     ]
  	};
  	chart.setOption(option);
  });
};
