<?php /* Smarty version Smarty 3.1.4, created on 2014-09-22 16:01:52
         compiled from "/home/work/ec_test_service/src/views/localresult/diffresult.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1388630208541802dfc95447-73721624%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '03b4f5bfc5df61a7968106b8dc0df75d1bf3df38' => 
    array (
      0 => '/home/work/ec_test_service/src/views/localresult/diffresult.tpl',
      1 => 1411372909,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1388630208541802dfc95447-73721624',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_541802dfef105',
  'variables' => 
  array (
    'this' => 0,
    'taskid' => 0,
    'resultftp' => 0,
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
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541802dfef105')) {function content_541802dfef105($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'ecTask'));?>

<div class="container">
    <div class="row">
		<div style="margin-top:20px;margin-left:-50px">
			<!--LEFT CONTENT-->
            <div class="col-md-2">
                <div class="list-group">
					<B class="list-group-item " style="background-color:#33cc99">离线任务<?php echo $_smarty_tpl->tpl_vars['taskid']->value;?>
详情：</B>
                    <a href="?r=localresult/result&taskid=<?php echo $_smarty_tpl->tpl_vars['taskid']->value;?>
&resultftp=<?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
" class="list-group-item ">离线运行概况</a>
                    <a href="#" class="list-group-item active ">DIFF测试结果</a>
                    <a href="?r=localresult/performance&taskid=<?php echo $_smarty_tpl->tpl_vars['taskid']->value;?>
&resultftp=<?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
" class="list-group-item ">性能测试结果</a>
                </div>
            </div>
			<!--END LEFT CONTENT-->
			<!--RIGHT CONTENT-->
			<div class="col-md-10">
				<div class="head_line">
   					<ul class="breadcrumb">
						<li><a href="index.php?r=ecTask/localmission">离线运行任务列表</a></li>
      					<li>离线任务详情</li> 
     		 			<li class="active">DIFF测试结果</li> 
   					</ul>   
				</div> 
					<?php if ($_smarty_tpl->tpl_vars['newolddiff']->value==1){?>
					<div class="panel panel-info">
						<div class="panel-heading">当前进行的是：<font color="#ff6666">比较新旧版本DIFF测试</font></div>
						<table width="100%" class="panel-body table">
							<tr>
								<td>输入包地址</td>
								<td width="80%"><?php echo $_smarty_tpl->tpl_vars['input_data']->value;?>
</td>
							</tr>
							<tr>
                                <td>输出包地址:</td><td></td>
							</tr>
							<tr>
								<td>新EC:</td>
                                <td width="80%"><?php echo $_smarty_tpl->tpl_vars['output_data_new']->value;?>
</td>
							</tr>
							<tr>
								<td>旧EC:</td>
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
					<div class="panel panel-success">
						<div class="panel-heading">当前进行的是：<font color="#ff6666">比较新版一致性DIFF测试</font></div>
						<table width="100%" class="panel-body table">
							<tr>
								<td>输入包地址</td>
								<td width="80%"><?php echo $_smarty_tpl->tpl_vars['input_data']->value;?>
</td>
							</tr>
							<tr>
                                <td>输出包地址</td>
                            </tr>
							<tr>
								<td>新EC1:</td>
                                <td width="80%"><?php echo $_smarty_tpl->tpl_vars['output_data_new']->value;?>
</td>
							</tr>
							<tr>
								<td>新EC2:</td>
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
					<div class="panel panel-warning">
						<div class="panel-heading">当前进行的是：<font color="#ff6666">比较旧版一致性DIFF测试</font></div>
						<table width="100%" class="panel-body table">
							<tr>
								<td>输入包地址</td>
								<td width="80%"><?php echo $_smarty_tpl->tpl_vars['input_data']->value;?>
</td>
							</tr>
							<tr>
                                <td>输出包地址</td>
                            </tr>
							<tr>
								<td>旧EC1:</td>
                                <td width="80%"><?php echo $_smarty_tpl->tpl_vars['output_data_old']->value;?>
</td>
							</tr>
							<tr>
								<td>旧EC2:</td>
								<td width="80%">	<?php echo $_smarty_tpl->tpl_vars['output_data_old_2']->value;?>

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
		</div>
	</div>
</div>
<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<?php }} ?>