<?php /* Smarty version Smarty 3.1.4, created on 2016-12-19 18:59:13
         compiled from "/home/work/ec_test_service/src/views/performance/diffchart.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18337196235857ba25716ad2-76027581%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c732e366f210ed3705d6537d9accf77d00afe3c0' => 
    array (
      0 => '/home/work/ec_test_service/src/views/performance/diffchart.tpl',
      1 => 1482145128,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18337196235857ba25716ad2-76027581',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5857ba2578029',
  'variables' => 
  array (
    'task1_id' => 0,
    'task2_id' => 0,
    'local_path1' => 0,
    'data_path1' => 0,
    'local_path2' => 0,
    'data_path2' => 0,
    'performances_name' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5857ba2578029')) {function content_5857ba2578029($_smarty_tpl) {?><!--RIGHT CONTENT-->
<div id="performance_container">
</div>
<script type="text/javascript" SRC="static/js/performance_echarts/sprintf.js"></script>
<script type="text/javascript" SRC="static/js/performance_echarts/esl.js"></script>
<script type="text/javascript" SRC="static/js/performance_echarts/echarts_line.js"></script>
<script type="text/javascript">
function appendPerformanceDiv(performance_key)
{
	var div_parent_prefix= '<div class="panel panel-default">'
	var div_body = div_parent_prefix
				 + sprintf('<div class="panel-heading" id="%s"><?php echo $_smarty_tpl->tpl_vars['task1_id']->value;?>
性能指标——%s<div>', "head-title-"+performance_key, performance_key)
				 + '<div class="panel-body">'
				 +  sprintf('<div id="performanceWait1-%s">', performance_key)
				 +  '<span id="result_bottom_2_left" style="display:block;margin-left:435px;"> <img src="images/waiting.png"  id="bottom_logo"></span>'
				 + '</div>'
				 + sprintf('<div id="performanceData1-%s" style="display:none;width:100%;height:300px;border:1px solid #ccc"></div>',performance_key)
				 +'</div>'
				 + sprintf('<div class="panel-heading" id="%s"><?php echo $_smarty_tpl->tpl_vars['task2_id']->value;?>
性能指标——%s<div>', "head-title-"+performance_key, performance_key)
				 + '<div class="panel-body">'
				 +  sprintf('<div id="performanceWait2-%s">', performance_key)
				 +  '<span id="result_bottom_2_left" style="display:block;margin-left:435px;"> <img src="images/waiting.png"  id="bottom_logo"></span>'
				 + '</div>'
				 + sprintf('<div id="performanceData2-%s" style="display:none;width:100%;height:300px;border:1px solid #ccc"></div>',performance_key)
				 +'</div>'

				 +'</div>'

	 $("#performance_container").append(div_body)
}
$(document).ready(function(){
	var local_path1 = '<?php echo $_smarty_tpl->tpl_vars['local_path1']->value;?>
';
	var data_path1 = '<?php echo $_smarty_tpl->tpl_vars['data_path1']->value;?>
';
	var local_path2 = '<?php echo $_smarty_tpl->tpl_vars['local_path2']->value;?>
';
	var data_path2 = '<?php echo $_smarty_tpl->tpl_vars['data_path2']->value;?>
';
    var param={local_path1:local_path1,data_path1:data_path1,local_path2:local_path2,data_path2:data_path2};
	var url = "?r=performance/diffchart";
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
	var arr = <?php echo json_encode($_smarty_tpl->tpl_vars['performances_name']->value);?>

	var performanceData1 = data['data1']['performanceData'];
	var performanceData2 = data['data2']['performanceData'];
    var performances1 = data['data1']['performances'];
	var performances2 = data['data2']['performances'];
	var length1 = performanceData1.length;
	var length2 = performanceData2.length;

	if(performanceData1['status'] == 1 || performanceData2['status'] == 2){
		alert("性能指标详细数据获取失败，请联系QA！");
		return;
	}
	//x轴
	var xAxis1 = [];
	var xAxis2 = [];
	for (var i=0;i<length1;i++){
		xAxis1.push(performanceData1[i]["time"]);
	}
	for (var i=0;i<length2;i++){
		xAxis2.push(performanceData2[i]["time"]);
	}
	//y轴
	for (var i=1,j=1;i<performances1.length;i++,j++){
        legend1 = performances1[i];
        if (selectedList.indexOf(legend1) != -1)
        {
			seriseData1 = [];
	        var unit1 = data['data1']['unit_data'][[legend1]];
			for (var j=0;j<length1;j++){
				seriseData1.push(performanceData1[j][performances1[i]]);
			}
	        
		    serise1 = [
			    {
	                name:performances1[i],
				    type:'line',
					symbolSize: 0 | 0,
					data:seriseData1,
				}
			];

			var echartsId1 = "performanceData1-" + legend1;
			var waitId1 = "performanceWait1-" + legend1;

			console.log("ready to show www");
			console.log(unit1);
			console.log(waitId1);
			showLineChart(echartsId1, [legend1], xAxis1, serise1, 0, unit1);
			document.getElementById(waitId1).style.display = "none";
			document.getElementById(echartsId1).style.display = "";
		}
		
		legend2 = performances2[i];
        if (selectedList.indexOf(legend2) != -1)
        {
			seriseData2 = [];
	        var unit2 = data['data2']['unit_data'][[legend2]];
			for (var j=0;j<length2;j++){
				seriseData2.push(performanceData2[j][performances2[i]]);
			}
	        
		    serise2 = [
			    {
	                name:performances2[i],
				    type:'line',
					symbolSize: 0 | 0,
					data:seriseData2,
				}
			];

			var echartsId2 = "performanceData2-" + legend2;
			var waitId2 = "performanceWait2-" + legend2;

			console.log("ready to show www");
			console.log(unit2);
			console.log(waitId2);
			showLineChart(echartsId2, [legend2], xAxis2, serise2, 0, unit2);
			document.getElementById(waitId2).style.display = "none";
			document.getElementById(echartsId2).style.display = "";
		}
	}
}
</script>
<?php }} ?>