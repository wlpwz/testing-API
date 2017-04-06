<?php /* Smarty version Smarty 3.1.4, created on 2014-09-23 16:20:22
         compiled from "/home/work/ec_test_service/src/views/localresultn/diffresult.tpl" */ ?>
<?php /*%%SmartyHeaderCode:99933731554212d46ae10e0-32586868%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d6255d381e218ef1c910e14e2f91987bccc1179' => 
    array (
      0 => '/home/work/ec_test_service/src/views/localresultn/diffresult.tpl',
      1 => 1411460416,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '99933731554212d46ae10e0-32586868',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'newolddiff' => 0,
    'input_data' => 0,
    'output_data_new' => 0,
    'output_data_old' => 0,
    'diffid_newold' => 0,
    'newdiff' => 0,
    'output_data_new_2' => 0,
    'diffid_new' => 0,
    'olddiff' => 0,
    'output_data_old_2' => 0,
    'diffid_old' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_54212d46b4a3d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54212d46b4a3d')) {function content_54212d46b4a3d($_smarty_tpl) {?>			<div id="diff">
					<?php if ($_smarty_tpl->tpl_vars['newolddiff']->value==1){?>
					<div class="panel panel-default">
						<div class="panel-heading">新旧版本DIFF概况</font></div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:15px;">
							<tr>
								<td>输入包地址：</td>
								<td width="80%"><?php echo $_smarty_tpl->tpl_vars['input_data']->value;?>
</td>
							</tr>
							<tr>
								<td>新EC输出包地址：</td>
                                <td width="80%"><?php echo $_smarty_tpl->tpl_vars['output_data_new']->value;?>
</td>
							</tr>
							<tr>
								<td>旧EC输出包地址：</td>
								<td width="80%">	<?php echo $_smarty_tpl->tpl_vars['output_data_old']->value;?>

								</td>
                            </tr>
							<tr>
                                <td>DIFF_ID</td>
                                <td width="80%"><?php echo $_smarty_tpl->tpl_vars['diffid_newold']->value;?>
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="?r=diff/resultanalysis&diffid=<?php echo $_smarty_tpl->tpl_vars['diffid_newold']->value;?>
">diff详情</a>
								</td>
                            </tr>	
						</table>
					</div>	
					<?php }?>
					
					<?php if ($_smarty_tpl->tpl_vars['newdiff']->value==1){?>
					<div class="panel panel-default">
						<div class="panel-heading">新版一致性DIFF概况</font></div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:15px;">
							<tr>
								<td>输入包地址：</td>
								<td width="80%"><?php echo $_smarty_tpl->tpl_vars['input_data']->value;?>
</td>
                            </tr>
							<tr>
								<td>新EC1输出包地址：</td>
                                <td width="80%"><?php echo $_smarty_tpl->tpl_vars['output_data_new']->value;?>
</td>
							</tr>
							<tr>
								<td>新EC2输出包地址：</td>
								<td width="80%">	<?php echo $_smarty_tpl->tpl_vars['output_data_new_2']->value;?>

								</td>
                            </tr>
							<tr>
                                <td>DIFF_ID</td>
                                <td width="80%"><?php echo $_smarty_tpl->tpl_vars['diffid_new']->value;?>
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="?r=diff/resultanalysis&diffid=<?php echo $_smarty_tpl->tpl_vars['diffid_new']->value;?>
">diff详情</a>
								</td>
                            </tr>	

						</table>
					</div>
					<?php }?>

					<?php if ($_smarty_tpl->tpl_vars['olddiff']->value==1){?>
					<div class="panel panel-default">
						<div class="panel-heading">旧版一致性DIFF概况</div>
						<table width="100%" class="table table-bordered table-striped"style="text-align:left;font-size:15px;">
							<tr>
								<td>输入包地址：</td>
								<td width="80%"><?php echo $_smarty_tpl->tpl_vars['input_data']->value;?>
</td>
							</tr>
							<tr>
								<td>旧EC1输出包地址：</td>
                                <td width="80%"><?php echo $_smarty_tpl->tpl_vars['output_data_old']->value;?>
</td>
							</tr>
							<tr>
								<td>旧EC2输出包地址：</td>
								<td width="80%"><?php echo $_smarty_tpl->tpl_vars['output_data_old_2']->value;?>

								</td>
                            </tr>
							<tr>
                                <td>DIFF_ID</td>
                                <td width="80%"><?php echo $_smarty_tpl->tpl_vars['diffid_old']->value;?>
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="?r=diff/resultanalysis&diffid=<?php echo $_smarty_tpl->tpl_vars['diffid_old']->value;?>
">diff详情</a>
								</td>
                            </tr>	

						</table>
					</div>
					<?php }?>
		</div>
			<!--END RIGHT CONTENT-->
<?php }} ?>