<?php /* Smarty version Smarty 3.1.4, created on 2016-12-20 14:47:39
         compiled from "/home/work/ec_test_service/src/views/tools/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:126623448353ed92cfb20182-57727954%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ceefbf44b0f1dfc979fc0cd84a57ea268f43adb3' => 
    array (
      0 => '/home/work/ec_test_service/src/views/tools/index.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '126623448353ed92cfb20182-57727954',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53ed92d00fc3b',
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ed92d00fc3b')) {function content_53ed92d00fc3b($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'tools'));?>

<div class="container">
	<div class="row">
		<div style="margin-top:20px;margin-left:-50px">
			 <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

             <div class="col-md-10">
				<div class="head_line">
                    <ul class="breadcrumb">
                        <li><a href="/">首页</a></li>
                        <li>实用工具</li> 
                        <li class="active">内存统计</li> 
                    </ul>   
                </div>  
				<div class="panel panel-default" >
					<div class="panel-heading">STEP1：生成内存记录</div>
					<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:15px">
						<tr>
							<td>下载脚本：wget ftp://cp01-testing-ps6076.cp01.baidu.com:/home/work/ec_test_service/script/memory_record.sh</td>
						</tr>
						<tr>
							<td>执行方法：nohup sh ./memory_record.sh -p process_name -o outputfile &</td>
						</tr>
					</table>
				</div>
				<div class="panel panel-default" >
						
					
						<div class="panel-heading">输入参数说明：</div>
						
							<table class="table table-bordered table-striped" style="text-align:left;font-size:15px">
								<thead>
									<tr >    
										<th>参数</th> 
								        <th>含义</th> 
										<th>例子</th> 
									</tr>
									<tr>
										<td>process_name</td>
										<td>需要监控的进程名称（对应top结果页的COMMAND列）</td>
      									<td>i18n_ec_frmwork</td>
									</tr>
									<tr >
									      <td>outputfile</td>
    									  <td>内存历史记录文件地址</td>
    						  				<td>/home/spider/recordfile</td>
    								</tr>
								</thead>
							</table>
				</div>
				<div class="panel panel-default" >
					<div class="panel-heading">STEP2：进行内存统计</div>
                    <table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:15px">
						<tr>
        					<td><input  id="memory_ftp" placeholder="输入内存记录文件FTP地址:ftp://cp01-testing-ps7091.cp01.baidu.com:/home/spider/ec2.3.0.94/logss" style="width: 800px;"/> <span style="color:red;">* </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        					<input  type="submit" id="submit" value="开始统计" onclick="show_memory_detail()"/></td>
    					</tr> 
					</table>
				</div>	
			</div>

<!--<h5 class="text-success">结果展示</h5>
<table class="table table-hover">
<tbody>
    <tr>
        <td><span style="color:red;">* </span>最大物理内存</td>
        <td><input id = maxmemory value = "NULL" style='width: 500px;border-left:0px;border-top:0px;border-right:0px;border-bottom:1px; border-bottom-color:Black'/> </td>
    </tr>
    <tr>
        <td><span style="color:red;">* </span>最小物理内存</td>
        <td><input id = minmemory value = "NULL" style='width: 500px;border-left:0px;border-top:0px;border-right:0px;border-bottom:1px; border-bottom-color:Black'/></td>
    </tr>-->
<!--
    <tr>
        <td><span style="color:red;">* </span>平均物理内存</td>
        <td><input id = averagememory value = "NULL" style='width: 500px;border-left:0px;border-top:0px;border-right:0px;border-bottom:1px; border-bottom-color:Black'/></td>
    </tr>-->
<!--</tbody>
</table>

<div  class="row-fluid">
    <iframe id=tu frameborder=0 scrolling=no width="100%" height=500 src=" http://tservice.baidu.com/chart/apiline?data=processname,1,2,3,4,5,4,3&label_x=a,b,c,d,e,f,g&height=500"></iframe>
</div>
</div>
-->
		</div>
	</div>
</div>
<script type="text/javascript">
    function show_memory_detail(){
        var memory_ftp = $('#memory_ftp').val();
        window.location.href="index.php?r=tools/memorystatic&memory_ftp=" + memory_ftp;
    }
</script>

<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<?php }} ?>