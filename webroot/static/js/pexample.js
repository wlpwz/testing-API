var myChart;

console.log("in pexample.js");
//var chart_array= new Array();

require.config({
    packages: [
        {
             name: 'echarts',
            location: '/static/js/echarts.sitemap/src',
            main: 'echarts'
        },
        {
            name: 'zrender',
            location: '/static/js/echarts.sitemap/zrender/src',
            main: 'zrender'
        }
    ]
});


//var echarts;
require(
    [
        'echarts',
        'echarts/chart/line',
        'echarts/chart/bar',
        'echarts/chart/scatter',
        'echarts/chart/k',
        'echarts/chart/pie',
        'echarts/chart/map',
        'echarts/chart/force'
    ],
    function(ec) {
        for (var i = 0; i < chart_array.length; i++) {
            var chartObj=chart_array[i];
            var temp_id=chartObj.id;
            var temp_value=chartObj.value;
            console.log(temp_id);
            console.log(temp_value);
            var temp_doc= document.getElementById(temp_id);
            var temp_chart = ec.init(temp_doc);
            temp_chart.setOption(temp_value);
            // temp_chart.setOption(temp_value, true);
        };
        // var myChart = ec.init(document.getElementById('main'));
        // var option = {"title":[],"tooltip":{"trigger":"item","formatter":"{b} : {c} ({d}%)"},"legend":{"orient":"vertical","x":"right","y":"bottom","data":["google","baidu","sogou"]},"toolbox":{"show":true,"feature":{"mark":true,"restore":true,"dataView":{"readOnly":false}}},"calculable":true,"series":[{"name":"main","type":"pie","data":[{"value":18,"name":"google"},{"value":70,"name":"baidu"},{"value":12,"name":"sogou"}]}]} ;
    
            // var option = {
            //     tooltip : {
            //         trigger: 'axis'
            //     },
            //     legend: {
            //         data:['蒸发量','降水量']
            //     },
            //     toolbox: {
            //         show : true,
            //         feature : {
            //             mark : true,
            //             dataView : {readOnly: false},
            //             magicType:['line', 'bar'],
            //             restore : true,
            //             saveAsImage : true
            //         }
            //     },
            //     calculable : true,
            //     xAxis : [
            //         {
            //             type : 'category',
            //             data : ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月']
            //         }
            //     ],
            //     yAxis : [
            //         {
            //             type : 'value',
            //             splitArea : {show : true}
            //         }
            //     ],
            //     series : [
            //         {
            //             name:'蒸发量',
            //             type:'bar',
            //             data:[2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3]
            //         },
            //         {
            //             name:'降水量',
            //             type:'bar',
            //             data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
            //         }
            //     ]
            // };
            
            // myChart.setOption(option);
    }
)
