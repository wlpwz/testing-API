<?php /* Smarty version Smarty 3.1.4, created on 2014-03-29 09:40:02
         compiled from "/home/work/pop-b1/src/views/monitem/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16882071975336247267a120-99099049%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8de4063932aa4084c6aae711acf8a9c79123b726' => 
    array (
      0 => '/home/work/pop-b1/src/views/monitem/list.tpl',
      1 => 1396055236,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16882071975336247267a120-99099049',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'rval' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_533624726c5d4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_533624726c5d4')) {function content_533624726c5d4($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/work/pop-b1/src/vendors/Smarty/plugins/modifier.date_format.php';
?><!-- Right Content Part -->
						<div class="headline">
         			<ul class="breadcrumb">
                  <li><a href="?r=monitem/list">监控项管理</a></li>
                  <li><a href="?r=monitem/list">平台监控项</a></li>
                  <li class="active">配置管理</li> 
        			 </ul>   
    				</div> 					
	
						<div class="right-table">
		                  <table id="sample-table-2" class="table table-striped table-bordered table-hover dataTable">
                      <thead> 
                            <tr role="row">
                                  <th>ID</th> 
                                  <th>监控项</th> 
                                  <th>中文名称</th> 
                                  <th>创建时间</th> 
                            </tr>   
                      </thead>
                      <tbody> 
                            <?php  $_smarty_tpl->tpl_vars['rval'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rval']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rval']->key => $_smarty_tpl->tpl_vars['rval']->value){
$_smarty_tpl->tpl_vars['rval']->_loop = true;
?>         
                            <tr>
																	<td><?php echo $_smarty_tpl->tpl_vars['rval']->value->id;?>
</td>    
																	<td><?php echo $_smarty_tpl->tpl_vars['rval']->value->type;?>
</td>
																	<td><?php if ($_smarty_tpl->tpl_vars['rval']->value->cname){?><?php echo $_smarty_tpl->tpl_vars['rval']->value->cname;?>
<?php }else{ ?>-<?php }?></t>
																	<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rval']->value->create_time,"%Y-%m-%d %H:%M:%S");?>
</td>
                            </tr>   
                            <?php } ?>
                      </tbody>
                  </table>					 
						</div>

<!-- End Right Content Part -->
<?php }} ?>