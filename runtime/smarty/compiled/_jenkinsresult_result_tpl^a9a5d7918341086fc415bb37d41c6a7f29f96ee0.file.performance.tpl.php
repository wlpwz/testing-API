<?php /* Smarty version Smarty 3.1.4, created on 2016-02-29 23:49:11
         compiled from "/home/work/ec_test_service/src/views/jenkinsresult/performance.tpl" */ ?>
<?php /*%%SmartyHeaderCode:214601801954216eacb2f1b1-92591380%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a9a5d7918341086fc415bb37d41c6a7f29f96ee0' => 
    array (
      0 => '/home/work/ec_test_service/src/views/jenkinsresult/performance.tpl',
      1 => 1450076151,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '214601801954216eacb2f1b1-92591380',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_54216eacbaf2a',
  'variables' => 
  array (
    'memory' => 0,
    'ec_type' => 0,
    'memoryftp1' => 0,
    'memoryftp3' => 0,
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
<?php if ($_valid && !is_callable('content_54216eacbaf2a')) {function content_54216eacbaf2a($_smarty_tpl) {?>			<!--RIGHT CONTENT-->
<?php if ($_smarty_tpl->tpl_vars['memory']->value==1){?>
	<?php if ($_smarty_tpl->tpl_vars['ec_type']->value==0){?>			
		<div id="memory">
                <div class="panel panel-default">
                    <div class="panel-heading">内存测试结果---新版EC1内存图</div>
                    <div class="panel-body">
                        <iframe src="<?php echo $_smarty_tpl->tpl_vars['memoryftp1']->value;?>
" width="100%" height=400></iframe>
                    </div>  
                </div>  
                <div class="panel panel-default">
                    <div class="panel-heading">内存测试结果---旧版EC1内存图</div>  
                    <div class="panel-body">
                          <iframe src="<?php echo $_smarty_tpl->tpl_vars['memoryftp3']->value;?>
" width="100%" height=400></iframe>
                    </div>  
                </div>  
                <div class="panel panel-default">
                    <div class="panel-heading">内存测试结果---新版EC2内存图</div>  
                    <div class="panel-body">
                        <iframe src="<?php echo $_smarty_tpl->tpl_vars['memoryftp2']->value;?>
" width="100%" height=400></iframe>
                    </div>  
                </div>  
            	<div class="panel panel-default"> 
                	<div class="panel-heading">内存测试结果---旧版EC2内存图</div>
                    <div class="panel-body">
                        <iframe src="<?php echo $_smarty_tpl->tpl_vars['memoryftp4']->value;?>
" width="100%" height=400></iframe>
                    </div>
				</div>
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
					<div class="panel panel-success" id="performance">
						<div class="panel-heading">包处理速度统计</div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:center;font-size:15px;">
							<tr>
                                <td>版本</td>
                                <td width="33.33%">新版（包/秒）</td>
                                <td width="33.33">旧版（包/秒）</td>
                            </tr>
                            <tr>
                                <td>EC1</td>
                                <td width="33.33%"><?php echo $_smarty_tpl->tpl_vars['speed1']->value;?>
包/秒</td>
                                <td width="33.33"><?php echo $_smarty_tpl->tpl_vars['speed3']->value;?>
包/秒</td>
                            </tr>
                            <tr>
                                <td>EC2</td>
                                <td width="33.33%"><?php echo $_smarty_tpl->tpl_vars['speed2']->value;?>
包/秒</td>
                                 <td width="33.33%"><?php echo $_smarty_tpl->tpl_vars['speed4']->value;?>
包/秒</td>
                            </tr>
						</table>
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
                         <td><iframe height=400 width=100% marginheight=0 frameborder=0  scrolling="no" src="http://tservi
ce.baidu.com/chart/apibar?data=新EC,<?php echo $_smarty_tpl->tpl_vars['speed1']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['speed2']->value;?>
;旧EC,<?php echo $_smarty_tpl->tpl_vars['speed3']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['speed4']->value;?>
;&label_x=新旧EC1包处理速度比对,新
旧EC1包处理速度比对&height=320&label_y_unit=包/秒"></iframe>
                    </td>
                    </tr>
                    </table>-->
                </div>
	<?php }?>
<?php }?>
			<!--			<iframe height=400 width=100% marginheight=0 frameborder=0  scrolling="no" src="http://tservice.baidu.com/chart/apibar?data=新版,<?php echo $_smarty_tpl->tpl_vars['speed1']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['speed2']->value;?>
;旧版,<?php echo $_smarty_tpl->tpl_vars['speed3']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['speed4']->value;?>
&label_x=新旧EC1包处理速度比对,新旧EC2包处>理速度比对&height=320&label_y_unit=包/秒"></iframe>
				--><br/>	
			<!--END RIGHT CONTENT-->
<?php }} ?>