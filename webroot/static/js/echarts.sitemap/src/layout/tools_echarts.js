
        
        window.option = {
            tooltip : {
                trigger: 'axis'
            },
            legend: {
                data:['联通','电信']
            },/*
            dataRange:{
                splitNumber:3,
                min:10000
            },*/
            calculable : false,
            toolbox:{
                show:true,
                itemSize:16,
                feature:{
                    magicType:['line', 'bar']
                }
            },
            /*axis:[
                {
                    splitLine : {
                        show:true,
                        lineStyle: {
                            color: '#483d8b',
                            type: 'dotted',
                            width: 5
                        }
                    }
                }
            ],*/
            xAxis : [
                {
                    type : 'category',
                    /*data : label,*/
                    splitLine : {
                        show:true,
                        lineStyle: {
                            color: '#dedede',
                            type: 'dashed',
                            width: 1
                        }
                    }
                }
            ],
            yAxis : [
                {
                    type : 'value',
                    position:'left',
                    splitNumber:5,
                    max:99999,
                    min:3333,
                    axisTick:{show:true},
                    splitArea : {show : false},
                    splitLine : {
                        show:true,
                        lineStyle: {
                            color: '#dedede',
                            type: 'dashed',
                            width: 1
                        }
                    }
                }
            ],
            series : [
                /*,
                {
                    name:'降水量',
                    type:'line',
                    data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
                }*/
            ]
        };