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
        <link href="static/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <script src="/static/js/jquery-1.11.1.min.js"></script>
        <script src="/static/js/bootstrap.min.js"></script>
        <!--script src="static/js/jquery.js"></script>
        <script src="static/js/bootstrap.js"></script>
        <script src="static/js/holder.js"></script-->

        <title>DATASAFE问题定位</title>
        <link rel="shortcut icon" type="image/x-icon" href="pic/pat.png">

        <!-- Custom styles for this template -->
        <link href="static/css/carousel.css" rel="stylesheet">
        <style type="text/css" id="holderjs-style"></style>
    </head>
<body class="home-template">
<div class="navbar navbar-inverse navbar-fixed-top">
   <div class="container">
        <div class="navbar-header">
          <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand hidden-sm" href="http://data-safe.baidu.com/" target="_blank">DataSafe</a>
        </div>
        <div class="navbar-collapse collapse" role="navigation">
          <ul class="nav navbar-nav">
            <!--li><a id="btn-jike-video" href="http://cq01-testing-ps7109.vm.baidu.com:8911/?r=datasafe/index">统一回灌接口问题追查</a></li>
            <li><a href="http://cq01-testing-ps7109.vm.baidu.com:8911/?r=datasafe/tools">统一回灌数据状态查询</a></li>
            <li><a href="#">统一回灌LB|BL查询</a></li-->
            <li class="active"><a href="http://pat.baidu.com/?r=datasafe/tools">工具</a></li>
            <li><a href="http://pat.baidu.com/?r=requirement/list" target="_blank" onclick="_hmt.push(['_trackEvent', 'navbar', 'click', 'jquery'])">需求管理</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right hidden-sm">
            <li><a href="/about/" onclick="_hmt.push(['_trackEvent', 'navbar', 'click', 'about'])">关于</a></li>
          </ul>
        </div>
   </div>
</div>
<div class="jumbotron masthead"></div>
<div class="container projects">
<div class="row">
<div class="col-md-2">
    <dl class="dl-group top-border">
        <dt class="dt-group-title">常用工具</dt>
        <dd class="dd-group-item"><a href="?r=datasafe/tools">路径检查工具</a></dd>
        <dd class="dd-group-item"><a href="?r=datasafe/toolsbogus">回灌命令检查工具</a></dd>
    </dl>
</div>
<div class="col-md-10">
<script type="text/javascript" src="static/js/run.js"></script>
<script type="text/javascript" src="static/js/bootstrap.js"></script>
<!--blockquote class="babel-callout babel-callout-warning"-->
<!--/blockquote-->
<h4>统一回灌命令检查工具</h4>
 <div class="panel panel-default">
	<div class="panel-heading">条件输入</div></br>
     <!--input type="radio" name="ecrunposition" id= "ecrunposition0" value="default" checked/-->
     &nbsp;&nbsp;<font>统一回灌命令 </font> &nbsp;
     <input id='url_0' type="text" style="width: 600px;height:30px;border-bottom:2px solid #a9c6c9;" placeholder='请输入回灌命令，如果有-e请一起输入'>
<h4 class="text-success"><button type="button" class="btn btn-primary" style="color: black;background-color: rgba(255, 255, 240, 0.05);margin-left: 300px;margin-top: 20px;" id="subtn">查询</button></h4>
    </div>
    <table id="lbstate" class="table table-bordered table-striped table-hover" width="100%" style="display:'ture';text-align:left;font-size:12px;"> 
                <thead> 
                <tr style="background-color:#d9edf7">
                    <th width="60%">命令</th>
                    <th width="40%">检查结果</th>
                </tr>   
                </thead>
                <tbody style="font-size:12px">
                <?php
                  if(isset($bogus_result)) {
                    foreach($bogus_result as $item) {
                      echo "<tr>";
                      echo "<td>" . $item["bogus_vars"] . "</td>";
                      echo "<td>" . $item["result"] . "</td>";
                      echo "</tr>";
                  }
                }
                ?>
                </tbody>
                </table>
</div><!--panel end-->
</div><!--col10 end-->
</div>
</div>
</div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
$('#subtn').click(function() {
    var bogus_vars=document.getElementById("url_0").value;
    if(bogus_vars==""){ alert ("请输入校验内容");return}  
    window.location.href="index.php?r=datasafe/submit2&bogus_vars=" + bogus_vars;
});
});
</script>
