<?php /* Smarty version Smarty 3.1.4, created on 2014-03-30 10:36:48
         compiled from "/home/work/pop-b1/src/views/target/users.tpl" */ ?>
<?php /*%%SmartyHeaderCode:170212975453378340884c65-43575438%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da44faf103de1fed9e111a816865f3d96b7aa62f' => 
    array (
      0 => '/home/work/pop-b1/src/views/target/users.tpl',
      1 => 1396055236,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '170212975453378340884c65-43575438',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'type' => 0,
    'url' => 0,
    'title' => 0,
    'list' => 0,
    'rval' => 0,
    'department' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5337834091e74',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5337834091e74')) {function content_5337834091e74($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/home/work/pop-b1/src/vendors/Smarty/plugins/modifier.truncate.php';
?><?php $_smarty_tpl->tpl_vars['title'] = new Smarty_variable(array("pie_total_template_user"=>array("t0"=>"PIE平台数据指标","t1"=>"模板统计","t2"=>"提交模板用户详情统计"),"pie_total_task_user"=>array("t0"=>"PIE平台数据指标","t1"=>"任务统计","t2"=>"提交任务用户详情统计")), null, 0);?>
<?php $_smarty_tpl->tpl_vars['url'] = new Smarty_variable(array("pie_total_template_user"=>array("t0"=>"?r=target/index","t1"=>"?r=target/index"),"pie_total_task_user"=>array("t0"=>"?r=target/index","t1"=>"?r=target/tasks")), null, 0);?>

<!-- Right Content Part -->
						<div class="headline">
         			<ul class="breadcrumb">
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value[$_smarty_tpl->tpl_vars['type']->value]["t0"];?>
"><?php echo $_smarty_tpl->tpl_vars['title']->value[$_smarty_tpl->tpl_vars['type']->value]["t0"];?>
</a></li>
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value[$_smarty_tpl->tpl_vars['type']->value]["t1"];?>
"><?php echo $_smarty_tpl->tpl_vars['title']->value[$_smarty_tpl->tpl_vars['type']->value]["t1"];?>
</a></li>
                  <li class="active"><?php echo $_smarty_tpl->tpl_vars['title']->value[$_smarty_tpl->tpl_vars['type']->value]["t2"];?>
</li> 
        			 </ul>   
    				</div> 					

						<div class="headline"><h5><i class="fa fa-users"></i>部门分布</h5></div>
					  <div id="chartPieDepartment" style="display: inline-block; width: 900px; height: 350px; border: 1px solid rgb(204, 204, 204); cursor: move;"></div>				
	
						<div class="headline"><h5><i class="fa fa-table"></i>数据详情</h5></div>
						<div class="right-table">	
									<table id="sample-table-2" class="table table-striped table-bordered table-hover dataTable">
											<thead>
														<tr role="row">
																	<th>用户名</th>
																	<th>职位</th>
																	<th>所属部门</th>
																	<th>所属产品线</th>
														</tr>
											</thead>
											<tbody>
														<?php  $_smarty_tpl->tpl_vars['rval'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rval']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rval']->key => $_smarty_tpl->tpl_vars['rval']->value){
$_smarty_tpl->tpl_vars['rval']->_loop = true;
?>									
														<tr>		
																	<td><?php echo $_smarty_tpl->tpl_vars['rval']->value->username;?>
</td>
																	<td><?php echo $_smarty_tpl->tpl_vars['rval']->value->user->position;?>
</td>
																	<td><?php echo $_smarty_tpl->tpl_vars['rval']->value->user->department;?>
</td>
																	<td title="<?php echo $_smarty_tpl->tpl_vars['rval']->value->user->product;?>
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['rval']->value->user->product,35,"...");?>
</td>
														</td>
														<?php } ?>
											</tbody>
									</table>
					</div>

<div style="display:none;">
		<div id="department_json"><?php echo $_smarty_tpl->tpl_vars['department']->value;?>
</div>
</div>
<!-- End Right Content Part -->
<script src="static/echarts/src/asset/js/esl/esl.js"></script>
<script src="static/js/echarts_pie.js"></script>
<script src="static/js/target_users.js"></script>
<?php }} ?>