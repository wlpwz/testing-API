<?php /* Smarty version Smarty 3.1.4, created on 2014-03-29 09:39:58
         compiled from "/home/work/pop-b1/src/views/backend/task.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8329345985336246e6dc767-42261304%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f1061d389f77383fc15f7dbf23b0e876c658d16' => 
    array (
      0 => '/home/work/pop-b1/src/views/backend/task.tpl',
      1 => 1396055236,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8329345985336246e6dc767-42261304',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'summary' => 0,
    'step' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5336246e75b60',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5336246e75b60')) {function content_5336246e75b60($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/work/pop-b1/src/vendors/Smarty/plugins/modifier.date_format.php';
?><!-- Right Content Part -->
	    	<div class="headline">
      		   <ul class="breadcrumb">
                  		<li><a href="?r=backend/task">系统风险监控</a></li>
                		  <li><a href="?r=backend/task">后台任务运行状况</a></li>
            		      <li class="active">数据概况</li> 
        		 </ul>   
    		</div> 

					<div class="headline"><h5><i class="fa fa-video-camera"></i>最新运行情况</h5></div>
						<div class="right-table">	
									<table id="sample-table-2" class="table table-striped table-bordered table-hover dataTable">
											<thead>
														<tr role="row">
																	<th>运行阶段</th>
																	<th>任务执行时间（均：秒）</th>
																	<th title="get_url_list和crawl_page阶段取URL_TOTAL_NUM作为数据量参照值，其他阶段则取RESULT_NUM作为数据量参照值">最大执行时间（秒）/数据量<i class="fa fa-smile-o color-green"></i></th>
																	<th title="get_url_list和crawl_page阶段取URL_TOTAL_NUM作为数据量参照值，其他阶段则取RESULT_NUM作为数据量参照值">最小执行时间（秒）/数据量<i title="" class="fa fa-smile-o color-green"></i></th>
																	<th>失败次数/总执行次数</th>
																	<th>任务数量</th>
																	<th>更新日期</th>
														</tr>
											</thead>
											<tbody>
														<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['step'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['summary']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['step']->value = $_smarty_tpl->tpl_vars['val']->key;
?>									
														<tr>
																	<td><?php echo $_smarty_tpl->tpl_vars['step']->value;?>
</td>	
																	<td><?php echo $_smarty_tpl->tpl_vars['val']->value['cost_time']['count'];?>
</td>
																	<td><?php echo $_smarty_tpl->tpl_vars['val']->value['max_cost_time']['count'];?>
/<?php echo ceil($_smarty_tpl->tpl_vars['val']->value['maxtime_data_size']['count']);?>
</td>
																	<td><?php echo $_smarty_tpl->tpl_vars['val']->value['min_cost_time']['count'];?>
/<?php echo ceil($_smarty_tpl->tpl_vars['val']->value['mintime_data_size']['count']);?>
</td>
																  <td><a class="mylink" href="?r=backend/error&type=<?php echo $_smarty_tpl->tpl_vars['step']->value;?>
&date=<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['val']->value['cost_time']['ctime'],"%Y-%m-%d");?>
"><?php echo intval($_smarty_tpl->tpl_vars['val']->value['fail_rec_number']['count']);?>
/<?php echo intval($_smarty_tpl->tpl_vars['val']->value['total_rec_number']['count']);?>
</a></td>
																	<td><?php echo intval($_smarty_tpl->tpl_vars['val']->value['total_task_count']['count']);?>
</td>
																	<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['val']->value['cost_time']['ctime'],"%Y-%m-%d");?>
</td>
														</tr>	
														<?php } ?>
											</tbody>
									</table>
					</div>
	
					<h5><i class="fa fa-bars"></i>任务执行时间（均）</h5>	
					<div id="cost_time" style="width: 100%; height: 300px; border: 1px solid rgb(204, 204, 204); cursor: default;"></div>

					<h5><i class="fa fa-bars"></i>失败次数</h5> 
					<div id="fail_rec_number" style="width: 100%; height: 300px; border: 1px solid rgb(204, 204, 204); cursor: default;"></div>

					<h5><i class="fa fa-bars"></i>任务数量</h5>
					<div id="total_task_count" style="width: 100%; height: 300px; border: 1px solid rgb(204, 204, 204); cursor: default;"></div>
</script>
<!-- End Right Content Part -->
<script src="static/echarts/src/asset/js/esl/esl.js"></script>
<script src="static/js/echarts_line.js"></script>
<script type="text/javascript" src="static/js/backend_task.js"></script>


<?php }} ?>