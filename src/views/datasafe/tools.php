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
            <li><a href="#" onclick="_hmt.push(['_trackEvent', 'navbar', 'click', 'jquery'])">统一回灌LB|BL查询</a></li-->
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
<h4>数据路径检查工具</h4>
 <div class="panel panel-default">
	<div class="panel-heading">条件输入</div></br>
    &nbsp;&nbsp;
    <code>说明：如果需要schema格式检查，请勾选对应链接的schema检查，并输入schema文件的列数从1开始计</code></br>
     <!--input type="radio" name="ecrunposition" id= "ecrunposition0" value="default" checked/-->
     &nbsp;&nbsp;<font>ftp地址 </font> &nbsp;
     <input id='url_0' type="text" style="width: 600px;height:30px;border-bottom:2px solid #a9c6c9;" placeholder='ftp路径需要加上ftp://'>
     <input type="checkbox" name="ftp_schema" id="schema_0" value="default">
     <font>schema检查</font>
     <input type="text" name="ftp_number" id="ftp_number"  style="width: 50px;height:30px;"><font>文件列数</font></br></br>
     &nbsp;&nbsp;<font>hdfs地址</font>
     <input id='url_1' type="text" style="width: 600px;height:30px;border-bottom:2px solid #a9c6c9;" placeholder='请输入hdfs路径'>
     <input type="checkbox" name="hdfs_schema" id="schema_1" value="default"><font>schema检查</font>
     <input type="text" name="hdfs_number" id="hdfs_number"  style="width: 50px;height:30px"><font>文件列数</font></br></br>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <font>hdfs用户名</font> <input type="text" name="hdfs_name" id="hdfs_user"  style="width: 100px;height:30px;border-bottom:2px solid #a9c6c9;">
     <font>hdfs密码</font><input type="text" name="hdfs_pass" id="hdfs_pass"  style="width: 100px;height:30px;border-bottom:2px solid #a9c6c9;">
<h4 class="text-success"><button type="button" class="btn btn-primary" style="color: black;background-color: rgba(255, 255, 240, 0.05);margin-left: 300px;margin-top: 20px;" id="subtn">查询</button></h4>
    </div>
    <table id="lbstate" class="table table-bordered table-striped table-hover" width="100%" style="display:'ture';text-align:left;font-size:12px;"> 
                <thead> 
                <tr style="background-color:#d9edf7">
                    <th width="60%">校验地址</th>
                    <th width="40%">检查结果</th>
                </tr>   
                </thead>
                <tbody style="font-size:12px">
                <?php
                  if(isset($check_result)) {
                    foreach($check_result as $item) {
                      echo "<tr>";
                      echo "<td>" . $item["path"] . "</td>";
                      echo "<td>" . $item["check_path"] . "</td>";
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
function setCookie(name, value, seconds) {  
 seconds = seconds || 0;   //seconds有值就直接赋值，没有为0，这个根php不一样。  
 var expires = "";  
 if (seconds != 0 ) {      //设置cookie生存时间  
 var date = new Date();  
 date.setTime(date.getTime()+(seconds*1000));  
 expires = "; expires="+date.toGMTString();  
 }  
 document.cookie = name+"="+escape(value)+expires+"; path=/";   //转码并赋值  
}  
function getCookie(name) {  
 var nameEQ = name + "=";  
 var ca = document.cookie.split(';');    //把cookie分割成组  
 for(var i=0;i < ca.length;i++) {  
 var c = ca[i];                      //取得字符串  
 while (c.charAt(0)==' ') {          //判断一下字符串有没有前导空格  
 c = c.substring(1,c.length);      //有的话，从第二位开始取  
 }  
 if (c.indexOf(nameEQ) == 0) {       //如果含有我们要的name  
 return unescape(c.substring(nameEQ.length,c.length));    //解码并截取我们要值  
 }  
 }  
 return false;  
}  
  
//清除cookie  
function clearCookie(name) {  
 setCookie(name, "", -1);  
}  
function setCookie(name, value, seconds) {  
 seconds = seconds || 0;   //seconds有值就直接赋值，没有为0，这个根php不一样。  
 var expires = "";  
 if (seconds != 0 ) {      //设置cookie生存时间  
 var date = new Date();  
 date.setTime(date.getTime()+(seconds*1000));  
 expires = "; expires="+date.toGMTString();  
 }  
 document.cookie = name+"="+escape(value)+expires+"; path=/";   //转码并赋值  
}  
function getCookie(name) {  
 var nameEQ = name + "=";  
 var ca = document.cookie.split(';');    //把cookie分割成组  
 for(var i=0;i < ca.length;i++) {  
 var c = ca[i];                      //取得字符串  
 while (c.charAt(0)==' ') {          //判断一下字符串有没有前导空格  
 c = c.substring(1,c.length);      //有的话，从第二位开始取  
 }  
 if (c.indexOf(nameEQ) == 0) {       //如果含有我们要的name  
 return unescape(c.substring(nameEQ.length,c.length));    //解码并截取我们要值  
 }  
 }  
 return false;  
}  
  
//清除cookie  
function clearCookie(name) {  
 setCookie(name, "", -1);  
}  
$('#subtn').click(function() {
    var check0 = document.getElementById("schema_0").checked;
    var ftp_number = $("#ftp_number").val();
    var check1 = document.getElementById("schema_1").checked;
    var hdfs_number = $("#hdfs_number").val();
    var flag1=0;
    var flag2=0;
    var ftp_url=document.getElementById("url_0").value;
    var hdfs_user=document.getElementById("hdfs_user").value;
    var hdfs_pass=document.getElementById("hdfs_pass").value;
    var hdfs_url=document.getElementById("url_1").value;
    if(check0)
    {
        if(ftp_number==""){ alert ("请输入文件列数");return}  
        flag1=1;
    }
    if(check1)
    {
        if(hdfs_number==""){ alert ("请输入文件列数");return}  
        flag2=1;
    }
    window.location.href="index.php?r=datasafe/submit1&flag1=" + flag1+ "&flag2=" +flag2+"&ftp_url="+ftp_url+"&hdfs_url="+hdfs_url+"&ftp_number="+ftp_number+"&hdfs_number="+hdfs_number+"&hdfs_user="+hdfs_user+"&hdfs_pass="+hdfs_pass;
    
});
</script>
