<?php /* Smarty version Smarty 3.1.4, created on 2016-12-20 14:47:39
         compiled from "/home/work/ec_test_service/src/views/tools/head.tpl" */ ?>
<?php /*%%SmartyHeaderCode:85148819053ed92d0103b89-68877301%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0a29e86368310bd7939233ce450051828970bba' => 
    array (
      0 => '/home/work/ec_test_service/src/views/tools/head.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85148819053ed92d0103b89-68877301',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53ed92d011119',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ed92d011119')) {function content_53ed92d011119($_smarty_tpl) {?><!--
<div style="float: left;margin-left: 0px;margin-top: 20px;width: 15%;">
    <ul>
	<li><a href="?r=tools/index"style="font-size: 20px;" >内存统计</a></li>
    </ul>
    <ul>
	<li><a href="?r=tools/else" style="font-size: 20px;">待更新</a></li>
    </ul>
</div>-->
<!--    <div class="page-sidebar">
	    <ul class="page-sidebar-menu">
		    <li>    
				<div style="height:38px;padding-left:13px;padding-top:10px;font-weight:bolder;">
	                <i class="fa fa-wrench"></i>
		                <span class="title">实用工具</span> 
                </div>
			</li>   
            <li class="start active ">
				<a href="?r=tools/index"><span class="title">内存统计</span><span class="selected"></span></a>
	        </li>   
			<li>    
			    <a href="?r=tools/else"><span class="title">待更新</span></a>
			<li>    
																														</ul>
														
</div>-->
<!-----------------siderbar---->

<div class="col-md-2">
        <div class="list-group">
            <B class="list-group-item " style="background-color:#F5F5F5">实用工具</B>       
            <a href="?r=tools/index" class="list-group-item ">内存统计</a>
			<a href="?r=tools/localexec" class="list-group-item">EC离线执行API</a>
			<a href="?r=tools/dictapi" class="list-group-item">DC词典推送API</a>
            <a href="?r=tools/dict1api" class="list-group-item">attr_modify词典推送工具</a>
			<a href="?r=tools/perfapi" class="list-group-item">性能API</a>
			<a href="?r=tools/diffapi" class="list-group-item">性能diff API</a>
        </div>  
</div>  
<?php }} ?>