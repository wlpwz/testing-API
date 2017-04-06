<?php /* Smarty version Smarty 3.1.4, created on 2017-02-14 11:31:17
         compiled from "/home/work/ec_test_service/src/views/localresult/performance.tpl" */ ?>
<?php /*%%SmartyHeaderCode:140400732542161da3e9226-54706366%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8de5b65993971d6034594c314bee4579632df5d0' => 
    array (
      0 => '/home/work/ec_test_service/src/views/localresult/performance.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '140400732542161da3e9226-54706366',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_542161da4695e',
  'variables' => 
  array (
    'memory' => 0,
    'ec_type' => 0,
    'memoryftp1' => 0,
    'memoryftp3' => 0,
    'newec1_strategy' => 0,
    'oldec1_strategy' => 0,
    'memoryftp2' => 0,
    'memoryftp4' => 0,
    'speed' => 0,
    'speed1' => 0,
    'speed3' => 0,
    'speed2' => 0,
    'speed4' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542161da4695e')) {function content_542161da4695e($_smarty_tpl) {?><!--RIGHT CONTENT-->
				
	<?php if ($_smarty_tpl->tpl_vars['memory']->value==1){?>
		<?php if ($_smarty_tpl->tpl_vars['ec_type']->value==0){?>		
			<div id="memory">
				<div class="panel panel-default">
                    <div class="panel-heading">内存测试结果---新版EC1内存图</div>
					<div class="panel-body">
						<iframe frameborder=0 src="<?php echo $_smarty_tpl->tpl_vars['memoryftp1']->value;?>
" width="100%" height=400></iframe>
                    </div>
				</div>
				<div class="panel panel-default">
                    <div class="panel-heading">内存测试结果---旧版EC1内存图</div>
					<div class="panel-body">
					        <iframe frameborder=0  src="<?php echo $_smarty_tpl->tpl_vars['memoryftp3']->value;?>
" width="100%" height=400></iframe>
					</div> 
				</div>
				<?php if (($_smarty_tpl->tpl_vars['newec1_strategy']->value[0]==0)&&($_smarty_tpl->tpl_vars['oldec1_strategy']->value[0]==0)){?>
				<div class="panel panel-default">
                    <div class="panel-heading">内存测试结果---新版EC2内存图</div>
                    <div class="panel-body">
                        <iframe frameborder=0 src="<?php echo $_smarty_tpl->tpl_vars['memoryftp2']->value;?>
" width="100%" height=400></iframe>
                    </div>
				</div>
				<div class="panel panel-default"> 
					<div class="panel-heading">内存测试结果---旧版EC2内存图</div>  
                <div class="panel-body">
                        <iframe frameborder=0 src="<?php echo $_smarty_tpl->tpl_vars['memoryftp4']->value;?>
" width="100%" height=400></iframe>
                </div>    		
				<?php }?>
			</div>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['ec_type']->value==1){?>
			<div id="memory">
                <div class="panel panel-default">
                    <div class="panel-heading">内存测试结果---新版EC内存图</div>
                    <div class="panel-body">
                        <iframe frameborder=0 src="<?php echo $_smarty_tpl->tpl_vars['memoryftp1']->value;?>
" width="100%" height=400></iframe>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">内存测试结果---旧版EC内存图</div>  
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
								<td width="33.33%">新版（包/秒）</td>
								<td width="33.3">旧版（包/秒）</td>
                        	</tr>
							<tr>
                                <td>EC1</td>
                                <td width="33.33%"><?php echo $_smarty_tpl->tpl_vars['speed1']->value;?>
包/秒</td>
								<td width="33.33%"><?php echo $_smarty_tpl->tpl_vars['speed3']->value;?>
包/秒</td>
                            </tr>	
							<?php if (($_smarty_tpl->tpl_vars['newec1_strategy']->value[0]==0)&&($_smarty_tpl->tpl_vars['oldec1_strategy']->value[0]==0)){?>
							<tr>
                                <td>EC2</td>
                                <td width="33.33%"><?php echo $_smarty_tpl->tpl_vars['speed2']->value;?>
包/秒</td>
								 <td width="33.33%"><?php echo $_smarty_tpl->tpl_vars['speed4']->value;?>
包/秒</td>
                            </tr>
							<?php }?>
						</table>
					</div>
			<!--		<iframe height=400 width=100% marginheight=0 frameborder=0  scrolling="no" src="http://tservice.baidu.com/chart/apibar?data=新版,<?php echo $_smarty_tpl->tpl_vars['speed1']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['speed2']->value;?>
;旧版,<?php echo $_smarty_tpl->tpl_vars['speed3']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['speed4']->value;?>
&label_x=新旧EC1包处理速度比对,新旧EC2包处理速度比对&height=320&label_y_unit=包/秒"></iframe>
				--><!--	<table width="100%">
					<tr>
					<td><iframe height=400 width=100% marginheight=0 frameborder=0  scrolling="no" src="http://tservice.baidu.com/chart/apibar?data=新EC,<?php echo $_smarty_tpl->tpl_vars['speed1']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['speed2']->value;?>
;旧EC,<?php echo $_smarty_tpl->tpl_vars['speed3']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['speed4']->value;?>
;&label_x=新旧EC1包处理速度比对,新旧EC1包处理速度比对&height=320&label_y_unit=包/秒"></iframe>
					</td>
					<td>
					<iframe height=400 width=100% frameborder=0 marginWidth=0 marginHeight=0 border:0 none scrolling="no" src="http://tservice.baidu.com/chart/apibar?data=新EC2,<?php echo $_smarty_tpl->tpl_vars['speed2']->value;?>
;旧EC2,<?php echo $_smarty_tpl->tpl_vars['speed4']->value;?>
&label_x=新旧EC2包处理速度比对&height=320&label_y_unit=包/秒"></iframe>
					</td>
					</tr>
					</table>-->
				</div>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['ec_type']->value==1){?>
			<div id="speed">
                <div class="panel panel-success">
                    <div class="panel-heading">包处理速度统计</div>
                        <table width="100%" class="table table-bordered table-striped" style="text-align:center;font-size:
15px;">
                            <tr>
                                <td>新版EC</td>
                                <td width="83.33%"><?php echo $_smarty_tpl->tpl_vars['speed1']->value;?>
包/秒</td>
                            </tr>
                            <tr>
                                <td>旧版EC</td>
                                <td width="83.33%"><?php echo $_smarty_tpl->tpl_vars['speed3']->value;?>
包/秒</td>
                            </tr>
                        </table>
                    </div>
            <!--        <iframe height=400 width=100% marginheight=0 frameborder=0  scrolling="no" src="http://tservice.ba
idu.com/chart/apibar?data=新版,<?php echo $_smarty_tpl->tpl_vars['speed1']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['speed2']->value;?>
;旧版,<?php echo $_smarty_tpl->tpl_vars['speed3']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['speed4']->value;?>
&label_x=新旧EC1包处理速度比对,新旧EC2>
包处理速度比对&height=320&label_y_unit=包/秒"></iframe>
                --><!-- <table width="100%">
                    <tr>
						 <td><iframe height=400 width=100% marginheight=0 frameborder=0  scrolling="no" src="http://tservice.baidu.com/chart/apibar?data=新EC,<?php echo $_smarty_tpl->tpl_vars['speed1']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['speed2']->value;?>
;旧EC,<?php echo $_smarty_tpl->tpl_vars['speed3']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['speed4']->value;?>
;&label_x=新旧EC1包处理速度比对,新旧EC1包处理速度比对&height=320&label_y_unit=包/秒"></iframe>
                    </td>
                    </tr>
                    </table>-->
                </div>
		<?php }?>
	<?php }?>
			<!--END RIGHT CONTENT-->
<?php }} ?>