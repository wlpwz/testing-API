<?php /* Smarty version Smarty 3.1.4, created on 2014-03-29 09:42:40
         compiled from "/home/work/pop-b1/src/views/target/tasks.tpl" */ ?>
<?php /*%%SmartyHeaderCode:915576721533625101c33a5-70382903%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a0bc3847f39f1ba5830088b92cb52259a5e7b3b' => 
    array (
      0 => '/home/work/pop-b1/src/views/target/tasks.tpl',
      1 => 1396055236,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '915576721533625101c33a5-70382903',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'range' => 0,
    'desc' => 0,
    'time' => 0,
    'summary' => 0,
    'flag' => 0,
    'items' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5336251027870',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5336251027870')) {function content_5336251027870($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['range'] = new Smarty_variable(array("daily"=>"最近一天","weekly"=>"最近一周","monthly"=>"最近一月"), null, 0);?>
<!-- Right Content Part -->
    <div class="headline">
              <ul class="breadcrumb">
                  <li><a href="?r=target/index">PIE平台数据指标</a></li>
                  <li><a href="?r=target/tasks">任务统计</a></li>
                  <li class="active">任务数据</li>
               </ul>
     </div>

		<div id="summary">
						 <div class="headline"><h5><i class="fa fa-table"></i>数据概况</h5></div>
				     <table id="sample-table-2" class="table table-striped table-bordered table-hover dataTable">
                      <thead>
                            <tr role="row">
																	<th></th>
                                  <th>任务总数</th>
                                  <th>新增任务数量</th>
																	<th>累计提交任务总用户量</th>
																	<th>网页数量/提取结果量</th>
                                  <th>统计时段</th>
                            </tr>
                      </thead>
                      <tbody>
															  <?php $_smarty_tpl->tpl_vars['flag'] = new Smarty_variable(0, null, 0);?>
															 <?php  $_smarty_tpl->tpl_vars['desc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['desc']->_loop = false;
 $_smarty_tpl->tpl_vars['time'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['range']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['desc']->key => $_smarty_tpl->tpl_vars['desc']->value){
$_smarty_tpl->tpl_vars['desc']->_loop = true;
 $_smarty_tpl->tpl_vars['time']->value = $_smarty_tpl->tpl_vars['desc']->key;
?>
																	<tr>
																	<td><?php echo $_smarty_tpl->tpl_vars['desc']->value;?>
</td>		
                                  <td><?php echo intval($_smarty_tpl->tpl_vars['summary']->value[$_smarty_tpl->tpl_vars['time']->value]['pie_total_task_count']->count);?>
</td>
                                  <td><?php echo intval($_smarty_tpl->tpl_vars['summary']->value[$_smarty_tpl->tpl_vars['time']->value]['pie_added_task_count']->count);?>
</td>
																	<td>
																			<?php echo intval($_smarty_tpl->tpl_vars['summary']->value[$_smarty_tpl->tpl_vars['time']->value]['pie_total_task_user']->count);?>

											                <?php if ($_smarty_tpl->tpl_vars['flag']->value==0){?>
                                     			 <a class="mylink" href="?r=target/users&type=pie_total_task_user">(详情)</a> 
                                      		<?php $_smarty_tpl->tpl_vars['flag'] = new Smarty_variable(1, null, 0);?>
																			<?php }?>
																	</td>
																	<td><?php echo number_format($_smarty_tpl->tpl_vars['summary']->value[$_smarty_tpl->tpl_vars['time']->value]['pie_url_total_number']->count);?>
 /
																			<?php echo number_format($_smarty_tpl->tpl_vars['summary']->value[$_smarty_tpl->tpl_vars['time']->value]['pie_result_number']->count);?>
</td>
                                  <td>
																	 <?php if ($_smarty_tpl->tpl_vars['time']->value=="weekly"){?>
																			<?php echo date("Y.m.d",$_smarty_tpl->tpl_vars['summary']->value[$_smarty_tpl->tpl_vars['time']->value]['pie_total_task_count']->ctime-6*86400);?>
 至
																	 <?php }elseif($_smarty_tpl->tpl_vars['time']->value=="monthly"){?>
																			<?php echo date("Y.m.d",$_smarty_tpl->tpl_vars['summary']->value[$_smarty_tpl->tpl_vars['time']->value]['pie_total_task_count']->ctime-29*86400);?>
 至
																	 <?php }?>
																	 <?php echo date("Y.m.d",$_smarty_tpl->tpl_vars['summary']->value[$_smarty_tpl->tpl_vars['time']->value]['pie_total_task_count']->ctime);?>
</td>
																	</tr>
															<?php } ?>
                      </tbody>
             </table>
		</div>

		<!-- Show Line With Echart  --!>
		<div class="headline"><h5><i class="fa fa-signal"></i>变化趋势</h5></div>
		<div class="time-bar alert-info">
         <span class="time-range time-selected" time_range="daily">天级数据</span>|
				 <span class="time-range" time_range="weekly">周级数据</span>|
				 <span class="time-range" time_range="monthly">月级数据</span>
    </div>  
		<div class="col-md-9">
          <span><input type="radio" name="data_type" value="pie_total_task_count" checked>任务总数</span>
          <span class="mar5"><input type="radio" name="data_type" value="pie_added_task_count">新增任务数量</span>
					<span class="mar5"><input type="radio" name="data_type" value="pie_total_task_user">提交任务用户数</span>
    </div>
		<div id="echart" style="width: 100%; height: 300px; border: 1px solid rgb(204, 204, 204); cursor: default;"></div>
		<!-- End Show Line With Echart  --!>

<div style="display:none;">
		<div id="items"><?php echo $_smarty_tpl->tpl_vars['items']->value;?>
</div>
</div>
<!-- End Right Content Part -->
<script src="static/echarts/src/asset/js/esl/esl.js"></script>
<script src="static/js/echarts_line.js"></script>
<script type="text/javascript" src="static/js/target_index.js"></script>
<?php }} ?>