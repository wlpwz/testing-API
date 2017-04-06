<?php /* Smarty version Smarty 3.1.4, created on 2017-03-09 17:19:39
         compiled from "/home/work/ec_test_service/src/views/run/runresult.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4725171035417e0c18586f0-60908738%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '93206206d7ca0b903f1fc333a3a1577c70ca842c' => 
    array (
      0 => '/home/work/ec_test_service/src/views/run/runresult.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4725171035417e0c18586f0-60908738',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5417e0c1a0f95',
  'variables' => 
  array (
    'this' => 0,
    'taskid' => 0,
    'run_type' => 0,
    'ec1_new_memory_first' => 0,
    'ec2_new_memory_first' => 0,
    'ec1_new_speed_first' => 0,
    'ec2_new_speed_first' => 0,
    'ec1_core_num_first' => 0,
    'ec2_core_num_first' => 0,
    'new_output_pack_num_first' => 0,
    'ec1_new_memory_second' => 0,
    'ec2_new_memory_second' => 0,
    'ec1_new_speed_second' => 0,
    'ec2_new_speed_second' => 0,
    'ec1_core_num_second' => 0,
    'ec2_core_num_second' => 0,
    'new_output_pack_num_second' => 0,
    'ec1_old_memory_first' => 0,
    'ec2_old_memory_first' => 0,
    'ec1_old_speed_first' => 0,
    'ec2_old_speed_first' => 0,
    'ec1_old_core_num_first' => 0,
    'ec2_old_core_num_first' => 0,
    'old_output_pack_num_first' => 0,
    'ec1_new_core_num_first' => 0,
    'ec2_new_core_num_first' => 0,
    'ec1_new_core_num_second' => 0,
    'ec2_new_core_num_second' => 0,
    'mem1' => 0,
    'mem2' => 0,
    'consistent_diff_id' => 0,
    'newold_diff_id' => 0,
    'input_pack_num' => 0,
    'host_name' => 0,
    'run_path' => 0,
    'new_ec_output_first' => 0,
    'new_ec_output_second' => 0,
    'old_ec_output_first' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5417e0c1a0f95')) {function content_5417e0c1a0f95($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'ecTask'));?>

<div class="container">
    <div class="row">
		<div style="margin-top:20px;margin-left:-50px">
			<!--LEFT CONTENT-->
            <div class="col-md-2">
                <div class="list-group">
					<B class="list-group-item " style="background-color:#F5F5F5;">在线运行任务<?php echo $_smarty_tpl->tpl_vars['taskid']->value;?>
详情：</B>
                    <a href="#" class="list-group-item active">结果概况</a>
                </div>
            </div>
			<!--END LEFT CONTENT-->
			<!--RIGHT CONTENT-->
			<div class="col-md-10">
				<div class="head_line">
   					<ul class="breadcrumb">
						<li><a href="index.php?r=ecTask/runmission">在线运行任务列表</a></li>
      					<li>在线任务详情</li> 
     		 			<li class="active">结果概况</li> 
   					</ul>   
				</div> 
				<div class="panel panel-default">
					<?php if ($_smarty_tpl->tpl_vars['run_type']->value=="consistentdiff\n"){?>
						<!-- <div class="panel-heading"><strong>结果概要：</strong><font color="black">比较新版EC DIFF测试</font></div> -->
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['run_type']->value=="newolddiff\n"){?>
                        <!-- <div class="panel-heading"><strong>当前DIFF类型为：</strong><font color="black">比较新旧EC DIFF测试</font></div>-->
                    <?php }?>
					<?php if ($_smarty_tpl->tpl_vars['run_type']->value=="newolddiff\n"){?>
                        <!-- <div class="panel-heading"><strong>当前DIFF类型为：</strong><font color="black">比较新版EC DIFF测试和新旧EC DIFF测试</font></div>-->
                    <?php }?>
					<div class="panel-heading">结果概要</div>
					<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:15px;">
                            <tr>
                                <th style="text-align:center;">版本</th>
                                <th style="text-align:center;">EC1使用内存</th>
                                <th style="text-align:center;">EC2使用内存</th>
								<th style="text-align:center;">EC1包处理速度</th>
								<th style="text-align:center;">EC2包处理速度</th>	
                    			<th style="text-align:center;">EC1出core数量</th>
								<th style="text-align:center;">EC2出core数量</th>
								<th style="text-align:center;">输出包数量</th>
                            </tr>
							
								<?php if ($_smarty_tpl->tpl_vars['run_type']->value=="consistentdiff\n"){?>
								<tr>
								<td>新EC1</td>
								<td><?php echo $_smarty_tpl->tpl_vars['ec1_new_memory_first']->value;?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['ec2_new_memory_first']->value;?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['ec1_new_speed_first']->value;?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['ec2_new_speed_first']->value;?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['ec1_core_num_first']->value;?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['ec2_core_num_first']->value;?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['new_output_pack_num_first']->value;?>
</td>
								</tr>
								<tr>
                                <td>新EC2</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec1_new_memory_second']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec2_new_memory_second']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec1_new_speed_second']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec2_new_speed_second']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec1_core_num_second']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec2_core_num_second']->value;?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['new_output_pack_num_second']->value;?>
</td>
                                </tr>
								<?php }?>

								<?php if ($_smarty_tpl->tpl_vars['run_type']->value=="newolddiff\n"){?>
                                <tr>
                                <td>旧EC</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec1_old_memory_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec2_old_memory_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec1_old_speed_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec2_old_speed_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec1_old_core_num_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec2_old_core_num_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['old_output_pack_num_first']->value;?>
</td>
                                </tr>
                                <tr>
                                <td>新EC</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec1_new_memory_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec2_new_memory_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec1_new_speed_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec2_new_speed_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec1_new_core_num_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec2_new_core_num_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['new_output_pack_num_first']->value;?>
</td>
                                </tr>
                                <?php }?>
								<?php if ($_smarty_tpl->tpl_vars['run_type']->value=="both\n"){?>
                                <tr>
                                <td>旧EC</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec1_old_memory_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec2_old_memory_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec1_old_speed_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec2_old_speed_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec1_old_core_num_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec2_old_core_num_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['old_output_pack_num_first']->value;?>
</td>
                                </tr>
                                <tr>
                                <td>新EC1</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec1_new_memory_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec2_new_memory_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec1_new_speed_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec2_new_speed_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec1_new_core_num_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec2_new_core_num_first']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['new_output_pack_num_first']->value;?>
</td>
                                </tr>
								<tr>
                                <td>新EC2</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec1_new_memory_second']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec2_new_memory_second']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec1_new_speed_second']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec2_new_speed_second']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec1_new_core_num_second']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ec2_new_core_num_second']->value;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['new_output_pack_num_second']->value;?>
</td>
                                </tr>
                                <?php }?>
                        </table>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
					<?php if ($_smarty_tpl->tpl_vars['run_type']->value=="consistentdiff\n"){?>
						新版EC1内存图
					<?php }?> 
					<?php if ($_smarty_tpl->tpl_vars['run_type']->value=="newolddiff\n"){?>
						新旧EC1内存图
					<?php }?> 
					<?php if ($_smarty_tpl->tpl_vars['run_type']->value=="both\n"){?>
						新旧EC1内存图
					<?php }?> 

					</div>
					<div class="panel-body">
						<iframe src="<?php echo $_smarty_tpl->tpl_vars['mem1']->value;?>
" frameborder=0 width="100%" height=400></iframe>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
					<?php if ($_smarty_tpl->tpl_vars['run_type']->value=="consistentdiff\n"){?>
						新版EC2内存图
					<?php }?> 
					<?php if ($_smarty_tpl->tpl_vars['run_type']->value=="newolddiff\n"){?>
						新旧EC2内存图
					<?php }?> 
					<?php if ($_smarty_tpl->tpl_vars['run_type']->value=="both\n"){?>
						新旧EC2内存图
					<?php }?> 
					</div>
					<div class="panel-body">
						<iframe src="<?php echo $_smarty_tpl->tpl_vars['mem2']->value;?>
" width="100%" height=400 frameborder=0></iframe>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						结果分析
					</div>
					<table width="100%" class="table table-bordered table-striped">
						<tr>
							<th>Diff类型</th>
							<th>Diff Id</th>
							<th>详情</th>
					<?php if ($_smarty_tpl->tpl_vars['run_type']->value=="consistentdiff\n"){?>
						<tr>
							<td>一致性diff</td><td><?php echo $_smarty_tpl->tpl_vars['consistent_diff_id']->value;?>
</td><td><a href="index.php?r=diff/resultanalysis&diffid=<?php echo $_smarty_tpl->tpl_vars['consistent_diff_id']->value;?>
">查看详情</a></td>
						</tr>
					<?php }?>	
					<?php if ($_smarty_tpl->tpl_vars['run_type']->value=="newolddiff\n"){?>
						<tr>
							<td>新旧版本diff</td><td><?php echo $_smarty_tpl->tpl_vars['newold_diff_id']->value;?>
</td><td><a href="index.php?r=diff/resultanalysis&diffid=<?php echo $_smarty_tpl->tpl_vars['newold_diff_id']->value;?>
">查看详情</a></td>
						</tr>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['run_type']->value=="both\n"){?>
						<tr>
							<td>新旧版本diff</td><td><?php echo $_smarty_tpl->tpl_vars['newold_diff_id']->value;?>
</td><td><a href="index.php?r=diff/resultanalysis&diffid=<?php echo $_smarty_tpl->tpl_vars['newold_diff_id']->value;?>
">查看详情</a></td>
						</tr>
						<tr>
							<td>一致性diff</td><td><?php echo $_smarty_tpl->tpl_vars['consistent_diff_id']->value;?>
</td><td><a href="index.php?r=diff/resultanalysis&diffid=<?php echo $_smarty_tpl->tpl_vars['consistent_diff_id']->value;?>
">查看详情</a></td>
						</tr>
					<?php }?>
					</table>
				</div>
				<div class="panel panel-success">
					<div class="panel-heading">其他信息</div>
					<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:15px;">
						<?php if ($_smarty_tpl->tpl_vars['run_type']->value=="consistentdiff\n"){?>
							<tr>
								<td><b>输入包数量</b></td>
								<td><?php echo $_smarty_tpl->tpl_vars['input_pack_num']->value;?>
</td>
							</tr>
							<tr>
                                <td><b>主机名称</b></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['host_name']->value;?>
</td>
                            </tr>
							<tr>
                                <td><b>运行路径</b></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['run_path']->value;?>
</td>
                            </tr>
							<tr>
                                <td><b>新EC1输出包地址</b></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['new_ec_output_first']->value;?>
</td>
                            </tr>
                            <tr>    
                                <td><b>新EC2输出包地址</b></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['new_ec_output_second']->value;?>
</td>
                            </tr>   
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['run_type']->value=="newolddiff\n"){?>
							<tr>
                                <td><b>输入包数量</b></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['input_pack_num']->value;?>
</td>
                            </tr>
							<tr>
								<td><b>DIFF 类型</b></td>
								<td><?php echo $_smarty_tpl->tpl_vars['run_type']->value;?>
</td>
							</tr>
							<tr>
                                <td><b>主机名称</b></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['host_name']->value;?>
</td>
                            </tr>
                            <tr>
                                <td><b>运行路径</b></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['run_path']->value;?>
</td>
                            </tr>
                            <tr>
                                <td><b>旧EC输出包地址</b></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['old_ec_output_first']->value;?>
</td>
                            </tr>
                            <tr>
                                <td><b>新EC输出包地址</b></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['new_ec_output_first']->value;?>
</td>
                            </tr>
                     	 <?php }?>
                      	 <?php if ($_smarty_tpl->tpl_vars['run_type']->value=="both\n"){?>
							<tr>
                                <td><b>输入包数量</b></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['input_pack_num']->value;?>
</td>
                            </tr>
							<tr>
                                <td><b>主机名称</b></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['host_name']->value;?>
</td>
                            </tr>
                            <tr>
                                <td><b>运行路径</b></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['run_path']->value;?>
</td>
                            </tr>
                            <tr>
                                <td><b>旧EC输出包地址</b></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['old_ec_output_first']->value;?>
</td>
                            </tr>	
							<tr>
                                <td><b>新EC1输出包地址</b></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['new_ec_output_first']->value;?>
</td>
                            </tr>
                            <tr>
                                <td><b>新EC2输出包地址</b></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['new_ec_output_second']->value;?>
</td>
                            </tr>
						<?php }?>
					</table>
				</div>
			</div>
			<!--END RIGHT CONTENT-->
		</div>
	</div>
</div>
<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<script>
/*	var temp=$('#mem1').html();
	var str1=temp.replace("&lt;","\<");
	var str2=temp.replace("&gt;","\>");
	var str2=temp.replace("\n","<br>");	
	console.log(str2);
	mem1.innerhtml=str2;*/
</script>
<?php }} ?>