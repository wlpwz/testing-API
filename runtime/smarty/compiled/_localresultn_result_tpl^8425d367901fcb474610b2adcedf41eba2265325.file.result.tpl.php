<?php /* Smarty version Smarty 3.1.4, created on 2014-09-23 17:31:00
         compiled from "/home/work/ec_test_service/src/views/localresultn/result.tpl" */ ?>
<?php /*%%SmartyHeaderCode:180080677754212d46a37235-49360464%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8425d367901fcb474610b2adcedf41eba2265325' => 
    array (
      0 => '/home/work/ec_test_service/src/views/localresultn/result.tpl',
      1 => 1411464657,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '180080677754212d46a37235-49360464',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_54212d46adbbb',
  'variables' => 
  array (
    'this' => 0,
    'taskid' => 0,
    'newolddiff' => 0,
    'memory' => 0,
    'speed' => 0,
    'resultftp' => 0,
    'newdiff' => 0,
    'olddiff' => 0,
    'newec' => 0,
    'oldec' => 0,
    'dir' => 0,
    'input_data' => 0,
    'output_data_new' => 0,
    'output_data_old' => 0,
    'summery_result' => 0,
    'cov_result' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54212d46adbbb')) {function content_54212d46adbbb($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'ecTask'));?>

<div class="container">
    <div class="row">
		<div style="margin-top:20px;margin-left:-50px">
			<!--LEFT CONTENT-->
            <div class="col-md-2">
                <div class="list-group">
					<B class="list-group-item " style="background-color:#33cc99">离线任务<?php echo $_smarty_tpl->tpl_vars['taskid']->value;?>
详情：</B>
                    <a href="#summery" class="list-group-item active">离线运行概况</a>
					<?php if ($_smarty_tpl->tpl_vars['newolddiff']->value==1||'newdiff'==1||'olddiff'==1){?>

                    <a href="#diff" class="list-group-item ">DIFF测试结果</a>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['memory']->value==1||$_smarty_tpl->tpl_vars['speed']->value==1){?>
                    <a href="?r=localresult/performance&taskid=<?php echo $_smarty_tpl->tpl_vars['taskid']->value;?>
&resultftp=<?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
" class="list-group-item ">性能测试结果</a>
					<?php }?>
                </div>
            </div>
			<!--END LEFT CONTENT-->
			<!--RIGHT CONTENT-->
			<div class="col-md-10">
				<div class="head_line">
   					<ul class="breadcrumb">
						<li><a href="index.php?r=ecTask/localmission">离线运行任务列表</a></li>
      					<li>离线任务详情</li> 
     		 			<li class="active">运行概况</li> 
   					</ul>   
				</div> 
				<div class="panel panel-default" id="summery">
					<div class="panel-heading">结果概况</div>
					<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:15px;">
						<tr>    
                            <td>测试功能点：</td>
							<td width="85%">
							<?php if ($_smarty_tpl->tpl_vars['newolddiff']->value==1){?>
                            新旧版本DIFF  &nbsp;&nbsp;&nbsp;&nbsp;
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['newdiff']->value==1){?>
								新版一致性DIFF &nbsp;&nbsp;&nbsp;&nbsp;
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['olddiff']->value==1){?>
								旧版一致性DIFF &nbsp;&nbsp;&nbsp;&nbsp;
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['memory']->value==1){?>
								物理内存使用统计 &nbsp;&nbsp;&nbsp;&nbsp;
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['speed']->value==1){?>
                                包处理速度统计 &nbsp;&nbsp;&nbsp;&nbsp;
                            <?php }?>
							<?php if ($_smarty_tpl->tpl_vars['newolddiff']->value==0&&$_smarty_tpl->tpl_vars['newdiff']->value==0&&$_smarty_tpl->tpl_vars['olddiff']->value==0&&$_smarty_tpl->tpl_vars['memory']->value==0&&$_smarty_tpl->tpl_vars['speed']->value==0){?>
								无
							<?php }?>
							</td>
                        </tr>	
						<tr>
							<td>新版EC执行环境：</td>
							<td width="85%"><?php echo $_smarty_tpl->tpl_vars['newec']->value;?>
</td>
						</tr>	
						<tr>
                            <td>旧版EC执行环境：</td>
                            <td width="85%"><?php echo $_smarty_tpl->tpl_vars['oldec']->value;?>
</td>
                        </tr> 
						<tr>
							<td>运行结果地址：</td>
							<td width="85%"><?php echo $_smarty_tpl->tpl_vars['dir']->value;?>
</td>
						</tr>
						<?php if ($_smarty_tpl->tpl_vars['newolddiff']->value==0&&'newdiff'==0&&'olddiff'==0){?>
							<tr>
                                <td>输入包地址：</td>
                                <td width="85%"><?php echo $_smarty_tpl->tpl_vars['input_data']->value;?>
</td>
                            </tr>
                            <tr>
                                <td>输出包地址：</td>
                                <td width="85%"><?php echo $_smarty_tpl->tpl_vars['output_data_new']->value;?>

                                <br>
                                    <?php echo $_smarty_tpl->tpl_vars['output_data_old']->value;?>

                                </td>
                            </tr>
						<?php }?>
					</table>
				</div>
				<div class="panel-group accordion" id="accordion">
				<div class="panel panel-info" >
				    <div class="panel-heading"><a class="accordion-toggle" value=false onclick="showCovFile(this)"><span style="cursor:pointer">覆盖率信息  <strong >&nu;</strong></span></a></div>
						<table width="100%" class="table table-bordered table-striped" id="cov_table">
<?php echo $_smarty_tpl->tpl_vars['summery_result']->value;?>

						</table>
						<script>
							function showCovFile(node)
							{
								var flag = node.getAttribute("value");
								if (flag == "false")
								{
									document.getElementById("cov_table").innerHTML='<?php echo $_smarty_tpl->tpl_vars['cov_result']->value;?>
';
									node.setAttribute("value","true");
									node.innerHTML="<span style=\"cursor:pointer\">覆盖率信息 <strong>&Lambda;</strong></span>";
								}
								else
								{
									document.getElementById("cov_table").innerHTML="<?php echo $_smarty_tpl->tpl_vars['summery_result']->value;?>
";
									node.setAttribute("value","false");
									node.innerHTML="<span style=\"cursor:pointer\">覆盖率信息 <strong>&nu;</strong></span>";

								}
							}
						</script>
					</div>
				</div>
				</div>
				<?php echo $_smarty_tpl->getSubTemplate ("diffresult.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

			</div>
			<!--END RIGHT CONTENT-->
		</div>
	</div>
</div>
<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<?php }} ?>