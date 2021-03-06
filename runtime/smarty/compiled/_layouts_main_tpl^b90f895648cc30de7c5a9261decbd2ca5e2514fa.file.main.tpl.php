<?php /* Smarty version Smarty 3.1.4, created on 2015-03-26 11:13:22
         compiled from "/home/work/ec_test_service/src/views/layouts/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1000701344537e07508104e5-36228922%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b90f895648cc30de7c5a9261decbd2ca5e2514fa' => 
    array (
      0 => '/home/work/ec_test_service/src/views/layouts/main.tpl',
      1 => 1427339597,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1000701344537e07508104e5-36228922',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_537e0750881b8',
  'variables' => 
  array (
    'current' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_537e0750881b8')) {function content_537e0750881b8($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="zh-cn" style="height:100%">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="stylesheet" href="static/css/layout.css" type="text/css" charset="utf-8">  
		<link rel="stylesheet" href="static/css/header.css" type="text/css" charset="utf-8"> 
		<link rel="stylesheet" href="http://cdn.bootcss.com/highlight.js/7.3/styles/github.min.css"></link>
		<link rel="stylesheet" href="static/css/bootstrap.min.css"></link>
		<link rel="stylesheet" href="static/css/doc.css"></link>
		<link rel="stylesheet" href="static/css/mybase.css"></link>
		<script src="/static/js/jquery.min.js"></script>
		<script src="/static/js/bootstrap.min.js"></script>
		<link href="static/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<script src="static/js/jquery.js"></script>


		<title>PAT 测试服务化平台</title>
		<link rel="shortcut icon" type="image/x-icon" href="pic/pat.png">

		<!-- Custom styles for this template -->
		<link href="static/css/carousel.css" rel="stylesheet">
		<style type="text/css" id="holderjs-style"></style>
	</head>
	<body style="height:100%" data-spy="scroll" data-target="#myScrollspy">
		<div id="container" style="height:100%">
			<div id="page">
				<div class="top">
					<div class="container">
						<ul class="loginbar pull-right">
							<li class="devider">
								<?php if (Yii::app()->user->isGuest){?>
								<a href="javascript:;">欢迎&nbsp;Guest</a>
								<?php }else{ ?>
								<a href="javascript:;">欢迎&nbsp;<?php echo Yii::app()->user->name;?>
</a>
								<?php }?>
							</li>
                
							<li>
								<?php if (Yii::app()->user->isGuest){?>
								<a href="?r=auth/index">登录</a>
								<?php }else{ ?>
								<a href="?r=auth/logout">退出</a>
								<?php }?>
							</li>
						</ul>
					</div>
				</div><!--=== End Top ===-->
				<!--=== Header ===-->
				<div class="header">
					<div class="navbar navbar-default" role="navigation">
						<div class="container">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<table> 
                                    <tr>    
                                        <td><img src="pic/pat.png" style="height:50px"></td>
                                        <td><a class="navbar-brand" href="/"><b>PAT 测试服务化平台</b></a></td>
                                    </tr>   
                                </table>
								</div>
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse navbar-responsive-collapse navbar-right">
								<ul class="nav navbar-nav navbar-right">
									<li class="dropdown <?php if ($_smarty_tpl->tpl_vars['current']->value=="home"){?>active<?php }?>">
										<a href="/">首页</a>
									</li>
		
									<li class="dropdown <?php if ($_smarty_tpl->tpl_vars['current']->value=="run"){?>active<?php }?>">
										<a href="/?r=run/index">轻松运行</a>
									</li>	
							<!--		<li class="dropdown <?php if ($_smarty_tpl->tpl_vars['current']->value=="combined"){?>active<?php }?>">
										<a href="/?r=combined/index">联调一下</a>
									</li>-->
									<li class="dropdown <?php if ($_smarty_tpl->tpl_vars['current']->value=="diff"){?>active<?php }?>">
										<a href="/?r=diff/index">结果分析</a>
									</li>
									<li class="dropdown <?php if ($_smarty_tpl->tpl_vars['current']->value=="ecTask"){?>active<?php }?>">
										<a href="/?r=ecTask/diffmission">任务列表</a>
									</li>
									<li class="dropdown <?php if ($_smarty_tpl->tpl_vars['current']->value=="version"){?>active<?php }?>">
										<a href="/?r=version/index">版本管理</a>
									</li>
									<li class="dropdown <?php if ($_smarty_tpl->tpl_vars['current']->value=="tools"){?>active<?php }?>">
										 <a href="/?r=tools/index">实用工具</a>
									</li>
									<li class="dropdown <?php if ($_smarty_tpl->tpl_vars['current']->value=="dictionary"){?>active<?php }?>">
										 <a href="/?r=dictionary/index">词典测试</a>
									</li>
								<!--	<li class="dropdown <?php if ($_smarty_tpl->tpl_vars['current']->value=="abstract"){?>active<?php }?>">
										 <a href="/?r=abstract/index">了解EC</a>
									</li>-->
								</ul>
							</div><!--end toggling-->
				
						</div>
					</div>
				</div><!--/header-->
				<!--=== End Header ===-->
				<div style="padding-bottom:100px;">
				<!--=== Content ===-->  
				<?php echo $_smarty_tpl->tpl_vars['content']->value;?>
	
				<!--=== Content ===-->  
				</div>
			</div>
		</div>
		<!--=== Footer ===-->
		<div id="foot">
			<div class="footer">
				<div class="container">
					<div class="footer-wrapper">
						<p class="f-right">	 
							联系我们：
							<a target="_blank"  href="baidu://message/?id=bystrom">白杨</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<a target="_blank"  href="baidu://message/?id=杨彦红_eileen">杨彦红</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<a target="_blank"  href="baidu://message/?id=heimennan">黑梦楠</a><br>
							Email: &nbsp;&nbsp;<a target="_blank"  href="mailto:testing-spider@baidu.com" class="">testing-spider@baidu.com</a>
							<br><a target="_blank" href="http://pop.baidu.com/?r=userlog/index&pid=80">用户访问情况统计</a>
						</p>
						<p>
							<a target="_blank" href="http://kgts.baidu.com" class="">KGTS</a>
							&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
							<a target="_blank" href="http://kgva.baidu.com" class="">知识库评测平台</a>
							&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
							<a target="_blank" href="http://dhc.baidu.com" class="">数据体检中心</a>
							&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
							<a target="_blank" href="http://pop.baidu.com" class="">POP产品运营监控平台</a>
							&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
							<a target="_blank" href="http://hao.baidu.com" class="">Hao页面分析平台</a>
							&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
							<a target="_blank" href="http://tservice.baidu.com" class="">WD QA测试服务化平台</a>
						</p>
						<p class="copyright">© 2014 Baidu <a href="http://www.baidu.com/duty/" target="_blank" title="使用百度前必读">使用百度前必读</a>&nbsp;|&nbsp;京ICP证030173号</p>		
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php }} ?>