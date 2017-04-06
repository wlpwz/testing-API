<?php /* Smarty version Smarty 3.1.4, created on 2014-09-23 19:47:28
         compiled from "/home/work/ec_test_service/src/views/localresult/performance.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15989702075417c0bb0f6e78-85211121%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8de5b65993971d6034594c314bee4579632df5d0' => 
    array (
      0 => '/home/work/ec_test_service/src/views/localresult/performance.tpl',
      1 => 1411472843,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15989702075417c0bb0f6e78-85211121',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5417c0bb13135',
  'variables' => 
  array (
    'this' => 0,
    'taskid' => 0,
    'resultftp' => 0,
    'memory' => 0,
    'newdiff' => 0,
    'newolddiff' => 0,
    'olddiff' => 0,
    'memoryftp1' => 0,
    'memoryftp3' => 0,
    'memoryftp2' => 0,
    'speed' => 0,
    'speed1' => 0,
    'speed2' => 0,
    'speed3' => 0,
    'speed4' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5417c0bb13135')) {function content_5417c0bb13135($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'ecTask'));?>

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
					
					<a href="index.php?r=localresult/result&taskid=<?php echo $_smarty_tpl->tpl_vars['taskid']->value;?>
&resultftp=<?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
" class="list-group-item ">DIFF测试结果</a>
                    <a href="#" class="list-group-item active">性能测试结果</a>
                </div>
            </div>
			<!--END LEFT CONTENT-->
			<!--RIGHT CONTENT-->
			<div class="col-md-10">
				<div class="head_line">
   					<ul class="breadcrumb">
						<li><a href="index.php?r=ecTask/localmission">离线运行任务列表</a></li>
      					<li>离线任务详情</li> 
     		 			<li class="active">性能测试结果</li> 
   					</ul>   
				</div>
				
			<?php if ($_smarty_tpl->tpl_vars['memory']->value==1){?>
				<div class="panel panel-default">
                    <div class="panel-heading">
                    <?php if ($_smarty_tpl->tpl_vars['newdiff']->value==1){?>
                        新版EC1内存图
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['newolddiff']->value==1){?>
                        新旧EC1内存图
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['olddiff']->value==1){?>
                        旧版EC1内存图
                    <?php }?> 

                    </div>  
                    <div class="panel-body">
                        <iframe src="http://cp01-testing-ps6076.cp01.baidu.com:8900/index.php?r=tools/memorystatic&memory_ftp=<?php echo $_smarty_tpl->tpl_vars['memoryftp1']->value;?>
" width="100%" height=400></iframe>
                    </div>  
                </div> 
			<div class="panel panel-default"> 
				<div class="panel-heading">
                    <?php if ($_smarty_tpl->tpl_vars['newdiff']->value==1){?>
                        新版EC2内存图
                    <?php }?> 
                    <?php if ($_smarty_tpl->tpl_vars['newolddiff']->value==1){?>
                        新旧EC2内存图
                    <?php }?> 
                    <?php if ($_smarty_tpl->tpl_vars['olddiff']->value==1){?>
                        旧版EC2内存图
                    <?php }?> 

                    </div>  
                    <div class="panel-body">
                        <iframe src="http://cp01-testing-ps6076.cp01.baidu.com:8900/index.php?r=tools/memorystatic&memory_ftp=<?php echo $_smarty_tpl->tpl_vars['memoryftp3']->value;?>
" width="100%" height=400></iframe>
                    </div>  
                </div>  		
			<!--		<div class="panel panel-info">
				<div class="panel-heading">物理内存使用统计</div>
						<table width="100%" class="panel-body table" style="text-align:center">
							<tr>
								<td>new.ec1内存统计概况</td>
								<td width="80%" ><a href="http://cp01-testing-ps6076.cp01.baidu.com:8900/index.php?r=tools/memorystatic&memory_ftp=<?php echo $_smarty_tpl->tpl_vars['memoryftp1']->value;?>
">点击查看内存统计图表</a></td>
							</tr>
							<tr>
								<td>new.ec2内存统计概况</td>
								<td width="80%"><a href="http://cp01-testing-ps6076.cp01.baidu.com:8900/index.php?r=tools/memorystatic&memory_ftp=<?php echo $_smarty_tpl->tpl_vars['memoryftp2']->value;?>
">点击查看内存统计图表</a></td>
							</tr>
							<tr>
                    	        <td>old.ec1内存统计概况</td>
                        	    <td width="80%"><a href="http://cp01-testing-ps6076.cp01.baidu.com:8900/index.php?r=tools/memorystatic&memory_ftp=<?php echo $_smarty_tpl->tpl_vars['memoryftp3']->value;?>
">点击查看内存统计图表</a></td>
                   	     	</tr>
							<tr>
                        	    <td>old.ec2内存统计概况</td>
                        	    <td width="80%"><a href="http://cp01-testing-ps6076.cp01.baidu.com:8900/index.php?r=tools/memorystatic&memory_ftp=<?php echo $_smarty_tpl->tpl_vars['memoryftp3']->value;?>
">点击查看内存统计图表</a></td>
                        	</tr>
						
						</table>
					
					</div>-->
				<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['speed']->value==1){?>
					<div class="panel panel-success">
						<div class="panel-heading">包处理速度统计</div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:center;font-size:15px;">
							<tr>
                            	<td>new.ec1包处理速度</td>
								<td width="50%"><?php echo $_smarty_tpl->tpl_vars['speed1']->value;?>
包/秒</td>
                        	</tr>
							<tr>
                                <td>new.ec2包处理速度</td>
                                <td width="50%"><?php echo $_smarty_tpl->tpl_vars['speed2']->value;?>
包/秒</td>
                            </tr>	
							<tr>
                                <td>old.ec1包处理速度</td>
                                <td width="50%"><?php echo $_smarty_tpl->tpl_vars['speed3']->value;?>
包/秒</td>
                            </tr>
							<tr>
                                <td>old.ec2包处理速度</td>
                                <td width="50%"><?php echo $_smarty_tpl->tpl_vars['speed4']->value;?>
包/秒</td>
                            </tr>

						</table>
					</div>
					<table width="100%">
					<tr>
					<td><iframe height=400 width=100% marginheight=0 frameborder=0  scrolling="no" src="http://tservice.baidu.com/chart/apibar?data=新EC1,<?php echo $_smarty_tpl->tpl_vars['speed1']->value;?>
;旧EC1,<?php echo $_smarty_tpl->tpl_vars['speed3']->value;?>
&label_x=新旧EC1包处理速度比对&height=320&label_y_unit=包/秒"></iframe>
					</td>
					<td>
					<iframe height=400 width=100% frameborder=0 marginWidth=0 marginHeight=0 border:0 none scrolling="no" src="http://tservice.baidu.com/chart/apibar?data=新EC2,<?php echo $_smarty_tpl->tpl_vars['speed2']->value;?>
;旧EC2,<?php echo $_smarty_tpl->tpl_vars['speed4']->value;?>
&label_x=新旧EC2包处理速度比对&height=320&label_y_unit=包/秒"></iframe>
					</td>
					</tr>
					</table>
				<?php }?>
			</div>
			<!--END RIGHT CONTENT-->
		</div>
	</div>
</div>
<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<?php }} ?>