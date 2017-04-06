function showPieWithOptions(divId, title, subtitle,pieData) {
    divId.highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: title
        },
        subtitle: {
            text: subtitle
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}% | {point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f}% '
                },
                showInLegend: true
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: pieData
        }]
    });
}
function showLines(divId, title, subtitle,seriesData){
	divId.highcharts({    	
    chart: {
			type: 'spline',
            zoomType:"x"
		},
		title: {
			text: title 
		},
		subtitle: {
			text: subtitle
		},
		xAxis: {
			type: 'datetime',
			dateTimeLabelFormats: {
				month: '%e',
				year: '%b',
			}
		},
		yAxis: {
			title: {
				text: '数量'
			},
			min: 0,
            stackLabels:{
                enabled: true
            }
		},
		tooltip: {
            shared: true
		},
        legend: {
            layout: 'vertical',
            align: 'center',
            verticalAlign: 'bottom',
            backgroundColor:'white'
        },
		series: seriesData
    });
}
