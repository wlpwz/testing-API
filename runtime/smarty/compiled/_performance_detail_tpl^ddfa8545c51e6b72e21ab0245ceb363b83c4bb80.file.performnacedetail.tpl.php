<?php /* Smarty version Smarty 3.1.4, created on 2016-12-19 19:08:04
         compiled from "/home/work/ec_test_service/src/views/performance/performnacedetail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18992436775735aea1c72167-19971812%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ddfa8545c51e6b72e21ab0245ceb363b83c4bb80' => 
    array (
      0 => '/home/work/ec_test_service/src/views/performance/performnacedetail.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18992436775735aea1c72167-19971812',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5735aea1cd3d4',
  'variables' => 
  array (
    'performances' => 0,
    'local_path' => 0,
    'data_path' => 0,
    'performances_name' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5735aea1cd3d4')) {function content_5735aea1cd3d4($_smarty_tpl) {?><!--RIGHT CONTENT-->
<div id="performance_container">
<!--    <?php  $_smarty_tpl->tpl_vars['performance'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['performance']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['performances']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['performance']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['performance']->key => $_smarty_tpl->tpl_vars['performance']->value){
$_smarty_tpl->tpl_vars['performance']->_loop = true;
 $_smarty_tpl->tpl_vars['performance']->index++;
?>
	<div class="panel panel-default">
        <div class="panel-heading" id="head-title-<?php echo $_smarty_tpl->tpl_vars['performance']->index;?>
">性能指标——<?php echo $_smarty_tpl->tpl_vars['performance']->key;?>
</div>
		<div class="panel-body">
		    <div id="performanceWait<?php echo $_smarty_tpl->tpl_vars['performance']->index;?>
">
			    <span id="result_bottom_2_left" style="display:block;margin-left:435px;"> <img src="images/waiting.png"  id="bottom_logo"></span>
			</div>
			<div id="performanceData<?php echo $_smarty_tpl->tpl_vars['performance']->index;?>
" style="display:none;width:100%;height:300px;border:1px solid #ccc"></div>
        </div>
	</div>
   <?php } ?> -->
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
	var local_path = '<?php echo $_smarty_tpl->tpl_vars['local_path']->value;?>
';
	var data_path = '<?php echo $_smarty_tpl->tpl_vars['data_path']->value;?>
';
    var param={local_path:local_path,data_path:data_path};
	var url = "?r=performance/filedata";
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
<?php }} ?>