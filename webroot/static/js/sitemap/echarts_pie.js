function showPieWithOptions(divId, title, subtitle, legendData, pieData){
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
          'echarts/chart/pie'
      ],
      function(ec){
          var chart = ec.init(document.getElementById(divId));
					 var option = {
              title : {
                 text: title,
								 subtext: subtitle,
                 x:'center'
              },
              tooltip : {
                 trigger: 'item',
                 formatter: "{a} <br/>{b} : {c} ({d}%)"
              },
              legend: {
                 orient : 'vertical',
                 x : 'left',
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
            name:title,
            type:'pie',
            radius : [0, 75],
            center: [,225],
            data: pieData                                                                                                                                                                                                                                                   
           }                                                                                                                                         
          ]                                                                                                                                          
        };                                                                                                                                           

          chart.setOption(option);                                                                                                                   
      });		
}
