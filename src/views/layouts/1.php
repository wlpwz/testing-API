<!doctype html>
<html lang="zh-cn"><head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="stylesheet" href="http://cdn.bootcss.com/highlight.js/7.3/styles/github.min.css"></link>
	<link rel="stylesheet" href="static/css/bootstrap.min.css"></link>
	<link rel="stylesheet" href="static/css/doc.css"></link>
	<script src="static/js/jquery.js"></script>


    <title>EC TESTING</title>

    <!-- Bootstrap core CSS -->
    <link href="static/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="static/css/carousel.css" rel="stylesheet">
  <style type="text/css" id="holderjs-style"></style></head>
<head>
<body>
<div class="container bs-docs-container">
  <div class="row">
   <!-- <div class="col-md-3">
      <div class="bs-sidebar hidden-print affix" role="complementary">
        <ul class="nav bs-sidenav">
	      <li  id="compile" class=>
	        <a href="/?r=compile/index" onclick="changeNav(this)">编译</a>
	        <ul class="nav">
	          <li><a href="#" onclick="setActive(this)">任务提交</a></li>
	          <li><a href="#" onclick="setActive(this)">日志输出</a></li>
	          <li><a href="#" onclick="setActive(this)">结果分析</a></li>
	        </ul>
	      </li>
	      <li id="run">
	        <a href="/?r=run/index" onclick="changeNav(this)">执行</a>
	        <ul class="nav">
	          <li><a href="#dropdowns-example" onclick="setActive(this)">案例</a></li>
	          <li><a href="#dropdowns-alignment" onclick="setActive(this)">对齐选项</a></li>
	          <li><a href="#dropdowns-headers" onclick="setActive(this)">标题</a></li>
	          <li><a href="#dropdowns-disabled" onclick="setActive(this)">禁用的菜单项</a></li>
	        </ul>
	      </li>
		  <li  id="diff">
		    <a href="/?r=diff/index">效果分析</a>
		    <ul class="nav">
			  <li><a href="/">分析结果</a></li>
		    </ul>
		  </li>
		  <li id="version">
			<a href="/?r=version/index" onclick="changeNav(this)">版本管理</a>
			<ul class="nav">
			  <li><a href="#">查看</a></li>
			</ul>
		  </li>
	  </div>        
    </div>-->
    <div class="col-md-12">
      <div class="inner">
    <!--=== Content ===-->  
	<?php echo $content; ?>
    <!--=== Content ===-->  
      </div>
    </div>
  </div>
</div>
<div>
</div>
<script>
/*	var module="{%$topic['topic']%}";
	var liArray = document.getElementsByTagName("li");
	for (i = 0 ;i < liArray.length; ++i)
	{
		liArray[i].setAttribute("class","");
	}
	if (module == "")
	{
		document.getElementById(module).setAttribute("class","active");
	}*/
/*	function setActive(element)
	{
		var child = element.parentNode.parentNode.firstElementChild;
		while (child)
		{
			child.setAttribute("class","");
			child = child.nextElementSibling;
		}
		element.parentNode.setAttribute("class", "active");
	}*/
	function changeNav(element)
	{
	/*	var child = element.parentNode.firstElementChild;
		while (child)
		{
			child.setAttribute("class","");
			child = child.nextElementSibling;
		}*/
		element.parentNode.setAttribute("class","active");
	}
</script>
<!--
 Bootstrap core JS file
  注意：此文件跟随官网最新版本更新，随时会有改变。…
-->
    <script src="static/js/jquery.js"></script>
<script src="static/js/bootstrap.js"></script>
<!--
 Hi，如果你要在自己的网站上引入bootstrap JS文件的话，请使用当前最新版本v3.0.3的…
-->
<script src="http://cdn.bootcss.com/holder/2.0/holder.min.js"></script>
<script src="http://cdn.bootcss.com/highlight.js/7.3/highlight.min.js"></script>
<script src="../docs-assets/js/application.js"></script>
<!--
 Analytics
=======================================…
-->
</body>
</html>
