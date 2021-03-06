<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
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
		<!--script src="/static/js/jquery.min.js"></script-->
		<script src="/static/js/jquery-1.10.2.min.js"></script>
		<script src="/static/js/bootstrap.min.js"></script>
		<link href="static/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!--script src="static/js/jquery.js"></script>
        <script src="static/js/bootstrap.js"></script>
        <script src="static/js/holder.js"></script-->

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
								<?php 
                                    if(Yii::app()->user->isGuest)
								        echo '<a href="javascript:;">欢迎&nbsp;Guest</a>';
								    else
								        echo '<a href="javascript:;">欢迎&nbsp;'.Yii::app()->user->name.'</a>';
							    ?>
                            </li>
							<li>
								<?php
                                    if(Yii::app()->user->isGuest)
								        echo '<a href="?r=auth/index">登录</a>';
								    else
								        echo '<a href="?r=auth/logout">退出</a>';
								?>
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
									<li class="dropdown {%if $current=="home"%}active{%/if%}">
										<a href="/">首页</a>
									</li>
		
									<li class="dropdown <?php if($current=='run') echo 'active';?>">
										<a href="/?r=run/index" class="dropdown-toggle" data-toggle="dropdown"></span>测试服务化<span class="caret"></a>
                                           <ul class="dropdown-menu" role="menu">
                                             <li><a href="/?r=run/index">EC自动化测试</a><li>
                                             <li><a href="/?r=dictionary/index">DC词典管理</a></li>
                                             <li><a href="/?r=drainage/index">数据引流</a><li>   
                                           </ul>
									</li>	
									<li class="dropdown {%if $current=="dict"%}active{%/if%}">
                                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">问题定位<span class="caret"></span></a>
                                         <ul class="dropdown-menu" role="menu">
                                         <li><a href="#">DC词典问题定位</a></li>
                                         <li><a href="#">DC词典效果反馈</a></li>
                                         </ul>
									</li>
									<li class="dropdown {%if $current=="performance"%}active{%/if%}">
									<a href="/?r=performance/index">性能绘图</a>
									</li>
									<li class="dropdown {%if $current=="tools"%}active{%/if%}">
										 <a href="/?r=tools/index">实用工具</a>
									</li>
								</ul>
							</div><!--end toggling-->
				
						</div>
					</div>
				</div><!--/header-->
				<!--=== End Header ===-->
				<div style="padding-bottom:100px;">
				<!--=== Content ===-->  
				<?php echo $content;?>	
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
							<a target="_blank"  href="baidu://message/?id=杨彦红_eileen">杨彦红</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<a target="_blank"  href="baidu://message/?id=syoya">蒋烨</a><br>
							Email: &nbsp;&nbsp;<a target="_blank"  href="mailto:psqa-spider@baidu.com" class="">psqa-spider@baidu.com</a>
							<br><a target="_blank" href="http://pop.baidu.com/?r=userlog/index&pid=80">用户访问情况统计</a>
						</p>
						<p>
							<a target="_blank" href="http://spimon.baidu.com" class="">spider监控平台</a>
							&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
							<a target="_blank" href="http://sitemap-qa.baidu.com" class="">站在平台监控平台</a>
							&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
							<a target="_blank" href="http://data-safe.baidu.com" class="">数据生效管理平台</a>
							&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
							<a target="_blank" href="http://dlc-qa.baidu.com" class="">死链检测平台</a>
							&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
							<a target="_blank" href="http://hao.baidu.com" class="">Hao页面分析平台</a>
							<!--a target="_blank" href="http://tservice.baidu.com" class="">WD QA测试服务化平台</a-->
						</p>
						<p class="copyright">© 2014 Baidu <a href="http://www.baidu.com/duty/" target="_blank" title="使用百度前必读">使用百度前必读</a>&nbsp;|&nbsp;京ICP证030173号</p>		
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<script type="text/javascript" SRC="static/js/leftMenu.js"></script>
