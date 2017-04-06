<?php /* Smarty version Smarty 3.1.4, created on 2016-12-22 11:38:07
         compiled from "/home/work/ec_test_service/src/views/dictionaryresult/performance.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150065625154a9062bb88e83-63160244%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4894055976bfeb3b6279d18cd388933fb6295312' => 
    array (
      0 => '/home/work/ec_test_service/src/views/dictionaryresult/performance.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150065625154a9062bb88e83-63160244',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_54a9062bbe8db',
  'variables' => 
  array (
    'memory' => 0,
    'ec_type' => 0,
    'memoryftp1' => 0,
    'memoryftp3' => 0,
    'speed' => 0,
    'speed1' => 0,
    'speed3' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54a9062bbe8db')) {function content_54a9062bbe8db($_smarty_tpl) {?><!--RIGHT CONTENT-->
	<?php if ($_smarty_tpl->tpl_vars['memory']->value==1){?>				
		<?php if ($_smarty_tpl->tpl_vars['ec_type']->value==0){?>		
			<div id="memory">
				<div class="panel panel-default">
                    <div class="panel-heading">内存测试结果  新版DC内存图</div>
					<div class="panel-body">
						<iframe frameborder=0 src="<?php echo $_smarty_tpl->tpl_vars['memoryftp1']->value;?>
" width="100%" height=400></iframe>
                    </div>
				</div>
				<div class="panel panel-default">
                    <div class="panel-heading">内存测试结果 旧版DC内存图</div>
					<div class="panel-body">
					        <iframe frameborder=0  src="<?php echo $_smarty_tpl->tpl_vars['memoryftp3']->value;?>
" width="100%" height=400></iframe>
					</div> 
				</div>
			</div>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['ec_type']->value==1){?>
			<div id="memory">
                <div class="panel panel-default">
                    <div class="panel-heading">内存测试结果  新版DC内存图</div>
                    <div class="panel-body">
                        <iframe frameborder=0 src="<?php echo $_smarty_tpl->tpl_vars['memoryftp1']->value;?>
" width="100%" height=400></iframe>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">内存测试结果  旧版DC内存图</div>  
                    <div class="panel-body">
                            <iframe frameborder=0  src="<?php echo $_smarty_tpl->tpl_vars['memoryftp3']->value;?>
" width="100%" height=400></iframe>
                    </div>  
                </div>  
			</div>
		<?php }?>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['speed']->value==1){?>
		<?php if ($_smarty_tpl->tpl_vars['ec_type']->value==0){?>
			<div id="speed">
				<div class="panel panel-success">
					<div class="panel-heading">包处理速度统计</div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:center;font-size:15px;">
							<tr>
                            	<td>版本</td>
								<td width="33.33%">新版DC</td>
								<td width="33.3">旧版DC</td>
                        	</tr>
							<tr>
                                <td>速度</td>
                                <td width="33.33%"><?php echo $_smarty_tpl->tpl_vars['speed1']->value;?>
包/秒</td>
								<td width="33.33%"><?php echo $_smarty_tpl->tpl_vars['speed3']->value;?>
包/秒</td>
                            </tr>	

						</table>
					</div>
				</div>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['ec_type']->value==1){?>
			<div id="speed">
                <div class="panel panel-success">
                    <div class="panel-heading">包处理速度统计</div>
                        <table width="100%" class="table table-bordered table-striped" style="text-align:center;font-size:
15px;">
                            <tr>
                                <td>新版DC</td>
                                <td width="83.33%"><?php echo $_smarty_tpl->tpl_vars['speed1']->value;?>
包/秒</td>
                            </tr>
                            <tr>
                                <td>旧版DC</td>
                                <td width="83.33%"><?php echo $_smarty_tpl->tpl_vars['speed3']->value;?>
包/秒</td>
                            </tr>
                        </table>
                    </div>
                </div>
		<?php }?>
	<?php }?>
			<!--END RIGHT CONTENT-->
<?php }} ?>