<?php /* Smarty version Smarty 3.1.4, created on 2014-03-29 14:56:08
         compiled from "/home/work/pop-b1/src/views/product/users.tpl" */ ?>
<?php /*%%SmartyHeaderCode:179724283053366e88cb6412-71369705%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e2b79162453c5461092a63b02ea4c41ddbadbdc3' => 
    array (
      0 => '/home/work/pop-b1/src/views/product/users.tpl',
      1 => 1396055236,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '179724283053366e88cb6412-71369705',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'obj' => 0,
    'list' => 0,
    'rval' => 0,
    'department' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53366e88d0c9e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53366e88d0c9e')) {function content_53366e88d0c9e($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/home/work/pop-b1/src/vendors/Smarty/plugins/modifier.truncate.php';
?><!-- Right Content Part -->
						<div class="headline">
         			<ul class="breadcrumb">
                  <li><a href="?r=product/index">产品数据指标</a></li>
                  <li><a href="javascript:;"><?php echo $_smarty_tpl->tpl_vars['obj']->value->cname;?>
</a></li>
                  <li class="active">用户分布情况统计</li> 
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