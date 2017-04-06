<!--RIGHT CONTENT-->
<div id="performance_container">
<!--    {%foreach $performances as $performance%}
	<div class="panel panel-default">
        <div class="panel-heading" id="head-title-{%$performance@index%}">性能指标——{%$performance@key%}</div>
		<div class="panel-body">
		    <div id="performanceWait{%$performance@index%}">
			    <span id="result_bottom_2_left" style="display:block;margin-left:435px;"> <img src="images/waiting.png"  id="bottom_logo"></span>
			</div>
			<div id="performanceData{%$performance@index%}" style="display:none;width:100%;height:300px;border:1px solid #ccc"></div>
        </div>
	</div>
   {%/foreach%} -->
</div>
<script type="text/javascript" SRC="static/js/performance_echarts/sprintf.js"></script>
<script type="text/javascript" SRC="static/js/performance_echarts/esl.js"></script>
<script type="text/javascript" SRC="static/js/performance_echarts/echarts_line.js"></script>
<script type="text/javascript">
function appendPerformanceDiv(performance_key)
{
	var div_parent_prefix= '<div class="panel panel-default">'
	var div_body = div_parent_prefix
				 + sprintf('<div class="panel-heading" id="%s">性能指标——%s<div>', "head-title-"+performance_key, performance_key)
				 + '<div class="panel-body">'
				 +  sprintf('<div id="performanceWait-%s">', performance_key)
				 +  '<span id="result_bottom_2_left" style="display:block;margin-left:435px;"> <img src="images/waiting.png"  id="bottom_logo"></span>'
				 + '</div>'
				 + sprintf('<div id="performanceData-%s" style="display:none;width:100%;height:300px;border:1px solid #ccc"></div>',performance_key)
				 +'</div></div>'

	 $("#performance_container").append(div_body)
}
$(document).ready(function(){
	var local_path = '{%$local_path%}';
	var data_path = '{%$data_path%}';
    var param={local_path:local_path,data_path:data_path};
	var url = "?r=performance/qpsfiledata";
	$.ajax({
        type:"POST",
		async:true,
		url:url,
		data:param,
		dataType:"json",
		success:function(ajaxObj){
			console.log(ajaxObj);
		    createCharts(ajaxObj);
		},
        error:function(){
		}
    });
});

function createCharts(ret_ajax_obj)
{	

	var selectedIndex = [];
	$.each($('th[role=key-list]'),function(key, value)
	{
		appendPerformanceDiv(value.innerText);
		selectedIndex.push(value.innerText);
	});

	renderEcharts(ret_ajax_obj, selectedIndex)
}

function renderEcharts(data, selectedList){
	var arr = {%json_encode($performances_name)%}
	var performanceData = data['performanceData'];
    var performances = data['performances'];
	var length = performanceData.length;

	if(performanceData['status'] == 1){
		alert("性能指标详细数据获取失败，请联系QA！");
		return;
	}
	
	var xAxis = [];
	for (var i=0;i<length;i++){
		//xAxis_legend_candidate = performanceData[i]
		//写死time 为横坐标
		//xAxis.push(performanceData[i][performances[0]]);
		xAxis.push(performanceData[i]["time"]);
	}
	
	for (var i=1;i<performances.length;i++){
        legend = performances[i];
        if (selectedList.indexOf(legend) != -1)
        {
			seriseData = [];
	        var unit = data['unit_data'][[legend]];
			for (var j=0;j<length;j++){
				seriseData.push(performanceData[j][performances[i]]);
			}
	        
		    serise = [
			    {
	                name:performances[i],
				    type:'line',
					 symbolSize: 0 | 0,
					data:seriseData,
				}
			];

			var echartsId = "performanceData-" + legend;
			var waitId = "performanceWait-" + legend;

			console.log("ready to show www");
			console.log(unit);
			console.log(waitId);
			showLineChart(echartsId, [legend], xAxis, serise, 0, unit);
			document.getElementById(waitId).style.display = "none";
			document.getElementById(echartsId).style.display = "";
		}
	}
}
</script>
