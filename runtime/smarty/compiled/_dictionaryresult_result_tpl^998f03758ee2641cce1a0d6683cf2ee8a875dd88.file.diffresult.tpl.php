<?php /* Smarty version Smarty 3.1.4, created on 2016-12-22 11:38:07
         compiled from "/home/work/ec_test_service/src/views/dictionaryresult/diffresult.tpl" */ ?>
<?php /*%%SmartyHeaderCode:102354042154a9062bb525d1-21855676%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '998f03758ee2641cce1a0d6683cf2ee8a875dd88' => 
    array (
      0 => '/home/work/ec_test_service/src/views/dictionaryresult/diffresult.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '102354042154a9062bb525d1-21855676',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_54a9062bb8633',
  'variables' => 
  array (
    'newold' => 0,
    'input_data' => 0,
    'output_data_new' => 0,
    'output_data_old' => 0,
    'diffid_newold' => 0,
    'time' => 0,
    'saver_diffid' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54a9062bb8633')) {function content_54a9062bb8633($_smarty_tpl) {?>				<?php if ($_smarty_tpl->tpl_vars['newold']->value==1){?>
				<div id="diff">
					<div class="panel panel-default" id="newolddiff">
						<div class="panel-heading">新旧版本DIFF概况</font></div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:14px;">
							<tr>
								<td>输入包地址：</td>
								<td ><input style="display:none" id="copy4" value="<?php echo $_smarty_tpl->tpl_vars['input_data']->value;?>
"><a href="javascript:void(0);" id="btnCopy4" title="复制" onclick="toClipboard(this.id,'copy4')"><?php echo $_smarty_tpl->tpl_vars['input_data']->value;?>
</a></td>
							</tr>
							<tr>
								<td>新DC输出包地址：</td>
                                <td><input style="display:none" id="copy5" value="<?php echo $_smarty_tpl->tpl_vars['output_data_new']->value;?>
"><a href="javascript:void(0);" id="btnCopy5" title="复制" onclick="toClipboard(this.id,'copy5')"><?php echo $_smarty_tpl->tpl_vars['output_data_new']->value;?>
</a></td>
							</tr>
							<tr>
								<td>旧DC输出包地址：</td>
								<td><input style="display:none" id="copy6" value="<?php echo $_smarty_tpl->tpl_vars['output_data_old']->value;?>
"><a href="javascript:void(0);" id="btnCopy6" title="复制" onclick="toClipboard(this.id,'copy6')">	<?php echo $_smarty_tpl->tpl_vars['output_data_old']->value;?>
</a>	</td>
                            </tr>
							<tr>
                                <td>DIFF_ID</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['diffid_newold']->value;?>
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="?r=dcDiff/index&dt=<?php echo $_smarty_tpl->tpl_vars['time']->value;?>
&id=<?php echo $_smarty_tpl->tpl_vars['diffid_newold']->value;?>
">cachediff详情</a>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="http://pat.baidu.com/index.php?r=diff/resultanalysis&diffid=<?php echo $_smarty_tpl->tpl_vars['saver_diffid']->value;?>
">saverdiff详情</a>
								</td>
                            </tr>	
						</table>
					</div>	
					
		</div>
	<?php }?>
			<!--END RIGHT CONTENT-->
<?php }} ?>