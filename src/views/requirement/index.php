<link rel="stylesheet" href="static/font-awesome-4.0.3/css/font-awesome.min.css" />
<style type="text/css">
input.btn-primary{width:5%}
</style>
     <div style="text-align:center">
     <form action="?r=requirement/query" method="post">
日期：<input class="span1" style="width:80px" type="text" name="from" value=<?php echo "'".date("Y-m-d",strtotime("-1 day"))."'";?>/>
至 <input class="span1" style="width:80px" type="text" name="to" value=<?php echo "'".date("Y-m-d",strtotime("+1 day"))."'";?>/>&nbsp;&nbsp;
处理状态<select class="span2 mr10" name="state" id="state">
 						<option value="0" selected="">全部</option>
  						<option value="1">未跟进</option>
  						<option value="2">跟进中</option>
              <option value="3">已解决</option>
					</select>
     <input class="btn-primary" type="submit" value="查询" />
      </form>
     </div>

   <table class="table table-bordered table-striped table-hover valignM" id="saver_sitemap">                                       
            <thead>                                                                                                                        
                  <tr class="info">                                                                                                        
                  <th style="width: 7%">序号</th>                                                                                       
                  <th style="width: 10%">所属平台</th>                                                                                    
                  <th style="width: 10%">监控类别</th>  
                  <th style="width: 10%">监控名称</th> 
                  <th style="width: 9%">报警时间</th>
                  <th style="width: 10%">报警内容</th>
                  <th style="width: 10%">报警原因</th>
                  <th style="width: 10%">处理状态</th>
                  <th style="width: 9%">问题级别</th>                                                                                     
                  <th style="width: 15%">操作</th>                                                                                                       
                  </tr>                                                                                                                    
            </thead>                                                                                                                       
            <tbody>                                                                                                                        
               <?php                               
                                                                                                           
                  if(isset($alarm)) {                                                                                                       
                    foreach($alarm as $item) {                                                                                              
                      echo "<tr class=\"gradeA\">";                                                                                        
                      echo "<td>" . $item['id'] . "</td>";
                      if($item['plat']==1)                                                                              
                      {echo "<td>站长平台中文</td>";}
                      else if($item['plat']==2)
                      {echo "<td>站长平台国际化</td>";}
                      else{echo "<td>百度分享</td>";}    
                      if($item['alarm_type']==1)
                      {echo "<td>二进制模块</td>";}                                                                 
                      else if($item['alarm_type']==2)
                      {echo "<td>脚本模块</td>";}
                      else if($item['alarm_type']==4)
					  {echo "<td>线上bug</td>";}
					  else{echo "<td>产品指标</td>";}                                                                          
                      echo "<td>" . $item['alarm_title'] . "</td>";
                      echo "<td>" . $item['alarm_time'] . "</td>";
                      echo "<td>" . $item['alarm_content'] . "</td>";
                      if($item['alarm_reason']==1)
                      {echo "<td>监控不稳定</td>";}                                                                 
                      else if($item['alarm_reason']==2)
                      {echo "<td>误报</td>";}
                      else if($item['alarm_reason']==3)
                      {echo "<td><a href='?r=requirement/problemtab'>监控发现</a></td>";}
                      else if($item['alarm_reason']==4)
                      {echo "<td>监控未发现</td>";} 
                      else{echo "<td></td>";}
                      if($item['status']==1)
                      {echo "<td>未跟进</td>";}                                                                 
                      else if($item['status']==2)
                      {echo "<td>跟进中</td>";}
                      else if($item['status']==3)
                      {echo "<td>解决</td>";} 
                      else{echo "<td></td>";}
                      if($item['level']==1)                                                                                               
                      {echo "<td>严重</td>";}                                                                                            
                      else if($item['level']==2)                                                                                          
                      {echo "<td>中等</td>";}  
                      else if($item['level']==3)
                      {echo "<td>较轻</td>";}  
                      else{echo "<td></td>";} 
							        echo "<td><button onclick="."window.open('index.php?r=requirement/handle&id=".$item['id']."')>开始处理</button></td>";
                      echo "</tr>";                                                                                                        
                    }                                                                                                                      
                  }                                                                                                                        
                ?>                                                                                                                         
            </tbody>                                                                                                                       
          </table>  

   <section class="column width4 first">
     <span>报警准则率</span>
     <div id="alarm" style="display:inline-block;width:450px;height:350px;border:1px solid #ccc"></div>
   </section>

   <section class="column width4">
     <span>问题召回率</span>
     <div id="problem" style="display:inline-block;width:450px;height:350px;border:1px solid #ccc"></div>
   </section>       

   <script src="http://code.highcharts.com/highcharts.js"></script> 
   <script type="text/javascript">
     $(document).ready(function () { 
         var colors = Highcharts.getOptions().colors,
            categories = ['监控不稳定', '误报', '监控发现'],
            data = [{
                    color: colors[6],
                    drilldown: {
                        name: '监控不稳定',
                        categories: ['监控不稳定'],
                        data: [<?php echo $nstable;?>],
                        color: colors[6]
                    }
                }, {
                    color: colors[0],
                    drilldown: {
                        name: '误报',
                        categories: ['误报'],
                        data: [<?php echo $wb;?>],
                        color: colors[0]
                    }
                }, {
                    color: colors[5],
                    drilldown: {
                        name: '监控发现',
                        categories: ['监控发现'],
                        data: [<?php echo $find;?>],
                        color: colors[5]
                    }
                }];
    $('#saver_sitemap').dataTable({'bAutoWidth':false, 'bSort':false}); 
    
        // Build the data arrays
        var browserData = [];
        var versionsData = [];
        for (var i = 0; i < data.length; i++) {
    
            // add browser data
            browserData.push({
                name: categories[i],
                y: data[i].y,
                color: data[i].color
            });
    
            // add version data
            for (var j = 0; j < data[i].drilldown.data.length; j++) {
                var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5 ;
                versionsData.push({
                    name: data[i].drilldown.categories[j],
                    y: data[i].drilldown.data[j],
                    color: Highcharts.Color(data[i].color).brighten(brightness).get()
                });
            }
        }
    
        // Create the chart
        $('#alarm').highcharts({
            chart: {
                type: 'pie'
            },
            title: {
                text: '报警准确率'
            },
            yAxis: {
                title: {
                    text: 'Total percent market share'
                }
            },
            plotOptions: {
                pie: {
                    shadow: false,
                    center: ['50%', '50%']
                }
            },
            tooltip: {
        	    valueSuffix: '%'
            },
            series: [{
                name: 'Browsers',
                data: browserData,
                size: '60%',
                dataLabels: {
                    color: 'white',
                    distance: -30
                }
            }, {
                name: "报警准确率",
                data: versionsData,
                size: '80%',
                innerSize: '60%',
            }]
        });
        
        //secondchart
        var colors = Highcharts.getOptions().colors,
            categories = ['监控未发现', '监控发现'],
            data = [{
                    color: colors[0],
                    drilldown: {
                        name: '监控未发现',
                        categories: ['监控未发现'],
                        data: [<?php echo $unfind;?>],
                        color: colors[0]
                    }
                }, {
                    color: colors[6],
                    drilldown: {
                        name: '监控发现',
                        categories: ['监控发现'],
                        data: [<?php echo $find2;?>],
                        color: colors[6]
                    }
                }];
    
    
        // Build the data arrays
        var browserData = [];
        var versionsData = [];
        for (var i = 0; i < data.length; i++) {
    
            // add browser data
            browserData.push({
                name: categories[i],
                y: data[i].y,
                color: data[i].color
            });
// add version data
            for (var j = 0; j < data[i].drilldown.data.length; j++) {
                var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5 ;
                versionsData.push({                                                                                                        
                    name: data[i].drilldown.categories[j],                                                                                 
                    y: data[i].drilldown.data[j],                                                                                          
                    color: Highcharts.Color(data[i].color).brighten(brightness).get()                                                      
                });                                                                                                                        
            }                                                                                                                              
        }
    
        // Create the chart                                                                                                                
        $('#problem').highcharts({                                                                                                           
            chart: {                                                                                                                       
                type: 'pie'                                                                                                                
            },                                                                                                                             
            title: {                                                                                                                       
                text: '报警准确率'                                                                                                         
            },                                                                                                                             
            yAxis: {                                                                                                                       
                title: {                                                                                                                   
                    text: 'Total percent market share'                                                                                     
                }                                                                                                                          
            },                                                                                                                             
            plotOptions: {                                                                                                                 
                pie: {                                                                                                                     
                    shadow: false,                                                                                                         
                    center: ['50%', '50%']                                                                                                 
                }                                                                                                                          
            },                                                                                                                             
            tooltip: {                                                                                                                     
              valueSuffix: '%'                                                                                                             
            },                                                                                                                             
            series: [{                                                                                                                     
                name: 'Browsers',                                                                                                          
                data: browserData,                                                                                                         
                size: '60%',                                                                                                               
                dataLabels: {                                                                                                              
                    color: 'white',                                                                                                        
                    distance: -30                                                                                                          
                }                                                                                                                          
            }, {                                                                                                                           
                name: "报警准确率",                                                                                                        
                data: versionsData,                                                                                                        
                size: '80%',                                                                                                               
                innerSize: '60%',         
 }]                                                                                                                             
        });
     });
   </script>                                              
