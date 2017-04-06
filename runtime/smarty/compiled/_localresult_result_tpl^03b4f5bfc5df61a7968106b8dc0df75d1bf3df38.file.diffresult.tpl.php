<?php /* Smarty version Smarty 3.1.4, created on 2017-02-14 11:31:17
         compiled from "/home/work/ec_test_service/src/views/localresult/diffresult.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11875935955420e883d6e091-09047329%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '03b4f5bfc5df61a7968106b8dc0df75d1bf3df38' => 
    array (
      0 => '/home/work/ec_test_service/src/views/localresult/diffresult.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11875935955420e883d6e091-09047329',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5420e883e0569',
  'variables' => 
  array (
    'newolddiff' => 0,
    'input_data' => 0,
    'output_data_new' => 0,
    'output_data_old' => 0,
    'diffid_newold' => 0,
    'newdiff' => 0,
    'int_data' => 0,
    'output_data_new_2' => 0,
    'diffid_new' => 0,
    'olddiff' => 0,
    'output_data_old_2' => 0,
    'diffid_old' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5420e883e0569')) {function content_5420e883e0569($_smarty_tpl) {?>			<div id="diff">
					<?php if ($_smarty_tpl->tpl_vars['newolddiff']->value==1){?>
					<div class="panel panel-default" id="newolddiff">
						<div class="panel-heading">新旧版本DIFF概况</font></div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:14px;">
							<tr>
								<td>输入包地址：</td>
								<td width="80%"><input style="display:none" id="copy4" value="<?php echo $_smarty_tpl->tpl_vars['input_data']->value;?>
"><a href="javascript:void(0);" id="btnCopy4" title="复制" onclick="toClipboard(this.id,'copy4')"><?php echo $_smarty_tpl->tpl_vars['input_data']->value;?>
</a></td>
							</tr>
							<tr>
								<td>新EC输出包地址：</td>
                                <td width="80%"><input style="display:none" id="copy5" value="<?php echo $_smarty_tpl->tpl_vars['output_data_new']->value;?>
"><a href="javascript:void(0);" id="btnCopy5" title="复制" onclick="toClipboard(this.id,'copy5')"><?php echo $_smarty_tpl->tpl_vars['output_data_new']->value;?>
</a></td>
							</tr>
							<tr>
								<td>旧EC输出包地址：</td>
								<td width="80%"><input style="display:none" id="copy6" value="<?php echo $_smarty_tpl->tpl_vars['output_data_old']->value;?>
"><a href="javascript:void(0);" id="btnCopy6" title="复制" onclick="toClipboard(this.id,'copy6')">	<?php echo $_smarty_tpl->tpl_vars['output_data_old']->value;?>
</a>	</td>
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
					<div class="panel panel-default" id="newdiff">
						<div class="panel-heading">新版一致性DIFF概况</font></div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:14px;">
							<tr>
								<td>输入包地址：</td>
								<td width="80%"><input style="display:none" id="copy7" value="<?php echo $_smarty_tpl->tpl_vars['int_data']->value;?>
"><a href="jabascript:void(0);" id="btnCopy7" title="复制" onclick="toClipboard(this.id,'copy7')"><?php echo $_smarty_tpl->tpl_vars['input_data']->value;?>
</a></td>
                            </tr>
							<tr>
								<td>新EC1输出包地址：</td>
                                <td width="80%"><input style="display:none" id="copy8" value="<?php echo $_smarty_tpl->tpl_vars['output_data_new']->value;?>
"><a href="jabascript:void(0);" id="btnCopy8" title="复制" onclick="toClipboard(this.id,'copy8')"><?php echo $_smarty_tpl->tpl_vars['output_data_new']->value;?>
</a></td>
							</tr>
							<tr>
								<td>新EC2输出包地址：</td>
								<td width="80%"><input style="display:none" id="copy9" value="<?php echo $_smarty_tpl->tpl_vars['output_data_new_2']->value;?>
"><a href="jabascript:void(0);" id="btnCopy9" title="复制" onclick="toClipboard(this.id,'copy9')">	<?php echo $_smarty_tpl->tpl_vars['output_data_new_2']->value;?>
</a>
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
					<div class="panel panel-default" id="olddiff">
						<div class="panel-heading">旧版一致性DIFF概况</div>
						<table width="100%" class="table table-bordered table-striped"style="text-align:left;font-size:14px;">
							<tr>
								<td>输入包地址：</td>
								<td width="80%"><input style="display:none" id="copy10" value="<?php echo $_smarty_tpl->tpl_vars['input_data']->value;?>
"><a href="jabascript:void(0);" id="btnCopy10" title="复制" onclick="toClipboard(this.id,'copy10')"> <?php echo $_smarty_tpl->tpl_vars['input_data']->value;?>
</a></td>
							</tr>
							<tr>
								<td>旧EC1输出包地址：</td>
                                <td width="80%"><input style="display:none" id="copy11" value="<?php echo $_smarty_tpl->tpl_vars['output_data_old']->value;?>
"><a href="jabascript:void(0);" id="btnCopy11" title="复制" onclick="toClipboard(this.id,'copy11')"><?php echo $_smarty_tpl->tpl_vars['output_data_old']->value;?>
</a></td>
							</tr>
							<tr>
								<td>旧EC2输出包地址：</td>
								<td width="80%"><input style="display:none" id="copy12" value="<?php echo $_smarty_tpl->tpl_vars['output_data_old_2']->value;?>
"><a href="jabascript:void(0);" id="btnCopy12" title="复制" onclick="toClipboard(this.id,'copy12')"><?php echo $_smarty_tpl->tpl_vars['output_data_old_2']->value;?>
</a>
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