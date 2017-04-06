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
		<link rel="stylesheet" type="text/css" href="/static/plugins/dataTable/css/dataTables.bootstrap.css">
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
            <li><a id="btn-jike-video" href="http://cq01-testing-ps7109.vm.baidu.com:8911/?r=datasafe/index">统一回灌接口问题追查</a></li>
            <li class="active"><a href="http://cq01-testing-ps7109.vm.baidu.com:8911/?r=datasafe/tools">统一回灌数据状态查询</a></li>
            <li><a href="#" onclick="_hmt.push(['_trackEvent', 'navbar', 'click', 'jquery'])">统一回灌LB|BL查询</a></li>
            <li><a href="http://cq01-testing-ps7109.vm.baidu.com:8911/?r=datasafe/tools">工具</a></li>
            <li><a href="http://cq01-testing-ps7109.vm.baidu.com:8911/?r=requirement/list" target="_blank" onclick="_hmt.push(['_trackEvent', 'navbar', 'click', 'jquery'])">需求管理</a></li>
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
<div class="col-md-10">
<script type="text/javascript" src="static/js/run.js"></script>
<script type="text/javascript" src="static/js/bootstrap.js"></script>
<!--blockquote class="babel-callout babel-callout-warning"-->
<!--/blockquote-->
<h4>数据状态查询</h4>
 <div class="panel panel-default">
	<div class="panel-heading">条件输入</div></br>
     &nbsp;&nbsp;<font>数据名称 </font> &nbsp;
     <input id='dataname' type="text" style="width: 600px;height:30px;border-bottom:2px solid #a9c6c9;" placeholder='提交数据的名称'></br></br>
     <!--font>最近</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <input type="text" name="number" id="data_number"  style="width: 50px;height:30px;border-bottom:2px solid #a9c6c9;" placeholder='3'><font>次更新的数据</font></br></br-->
<h4 class="text-success"><button type="button" class="btn btn-primary" style="color: black;background-color: rgba(255, 255, 240, 0.05);margin-left: 300px;margin-top: 20px;" id="subtn">查询</button></h4>
    </div>
	<a href="#" class="btn btn-info btn-lg disabled" role="button">步骤1:用户提交数据</a>
	<a href="#" class="btn btn-primary btn-lg disabled" role="button">步骤2:数据审核</a>
	<a href="#" class="btn btn-warning btn-lg disabled" role="button">步骤3:数据校验</a>
	<a href="#" class="btn btn-danger btn-lg disabled" role="button">步骤4:执行生效命令</a>
	<a href="#" class="btn btn-success btn-lg disabled" role="button">步骤5:生效成功</a>
	</br></br>
    <h3>数据最新处理状态</h3>	
	<table id="lbstate" class="table table-bordered table-striped table-hover" width="100%" style="display:'ture';text-align:left;font-size:12px;"> 
                <thead> 
                <tr style="background-color:#d9edf7">
                    <th width="20%">数据名称</th>
                    <th width="10%">数据id</th>
                    <th width="15%">最近更新时间</th>
                    <th width="10%">回灌方式</th>
                    <th width="10%">环境</th>
                    <th width="30%">处理状态</th>
                </tr>   
                </thead>
                <tbody style="font-size:12px">
				<?php
				    if(isset($result_status)){
						foreach($result_status as $item) {
							if(trim($item['data_id']) == "") { continue; }
							 echo "<tr>";
							 echo "<td>" . $item["conf_name"] . "</td>";
							 echo "<td>" . $item["data_id"] . "</td>";
							 echo "<td>" . $item["conf_lasted_update_time"] . "</td>";
							 $type="";
							 switch($item['onset_type']){
								 case 1:
									 $type = "Noahdt推送｜mis回灌";
									 break;
								 case 2:
									 $type = "Noahdt发布";
									 break;
								 case 3:
									 $type = "统一回灌";
								 case 4:
									 $type = "Hdfs发布";
									 break;
								 case 6:
									 $type = "linkcache回灌";
							 }
							 echo "<td>" . $type . "</td>";
							 $env="";
							 switch($item['conf_env']){
								 case 1:
									 $env = "中文";
									 break;
								 case 2:
									 $env = "国际化";
									 break;
								 case 5:
									 $env = '中文img';
									 break;
								 default:
									 $env = "火星环境吗";
							 }
							 echo "<td>" . $env . "</td>";
							 $status="";
							 switch($item['status']){
								 case 1:
									 $status = "审核进行中";
									 break;
								 case 2:
									 $status = "审核完成";
									 break;
								 case 3:
									 $status = "检验block请联系‘李智’处理";
									 break;
								 case 4:
									 $status = "检验－数据更新中";
									 break;
								 case 5:
									 $status = "校验－数据更新失败";
									 break;
								 case 6:
									 $status = "检验－正在校验";
									 break;
								 case 7:
									 $status = "检验－校验失败，检验过程捕获异常。请联系负责人‘李智’处理";
									 break;
								 case 8:
									 $status = "检验－校验未通过，用户需要发起强制生效或者放弃该批次数据";
									 break;
								 case 9:
									 $status = "数据校验通过，正在执行生效命令";
									 break;
								 case 10:
									 $status = "数据校验通过，执行生效命令失败";
									 break;
								 case 11:
									 $status = "数据检验通过，执行生效命令成功";
									 break;
								 case 12:
									 $status = "统一回灌预处理进行中";
									 break;
								 case 13:
									 $status = "统一回灌预处理成功";
									 break;
								 case 14:
									 $status = "统一回灌预处理失败";
									 break;
								 case 15:
									 $status = "统一回灌排序进行中";
									 break;
								 case 16:
									 $status = "统一回灌排序失败";
									 break;
								 case 17:
									 $status = "统一回灌merge进行中";
									 break;
								 case 18:
									 $status = "统一回灌成功";
									 break;
								 default:
									 $status = "状态未知";

							 }
							 echo "<td>" . $status . "</td>";
							 echo "</tr>";
						}
					}
				?>
                </tbody>
                </table>
    <h3>数据校验状态详情</h3>	
	<table id="check_state" class="table table-bordered table-striped table-hover" style="display:'ture';text-align:left;font-size:12px;"> 
                <thead> 
                <tr style="background-color:#d9edf7">
                    <th width="20%">数据名称</th>
                    <th width="7%">数据id</th>
                    <th width="10%">校验完成时间</th>
                    <th width="10%">检验状态</th>
                    <th width="10%">未通过原因</th>
                    <th width="7%">是否发布</th>
                    <th width="20%">操作</th>
                </tr>   
                </thead>
                <tbody style="font-size:12px">
				<?php
				    if(isset($check_status)){
						foreach($check_status as $item) {
							if(trim($item['data_id']) == "") { continue; }
							 echo "<tr>";
							 echo "<td>" . $item["conf_name"] . "</td>";
							 echo "<td>" . $item["data_id"] . "</td>";
							 echo "<td>" . $item["data_version_time"] . "</td>";
							 $status="";
							 switch($item['data_status']){
								 case 1:
									 $status = "检验－数据更新中";
									 $result = "";
									 break;
								 case 2:
									 $status = "校验－数据更新失败";
									 $result = "请检查数据文件是否存在";
									 break;
								 case 3:
									 $status = "检验－正在校验";
									 $result = "";
									 break;
								 case 4:
									 $status = "检验－校验失败，检验过程捕获异常";
									 $result = "请联系负责人<a target='_blank'  href='baidu://message/?id=lizhi_xjtu'>李智</a>处理";
									 break;
								 case 5:
									 $status = "检验－校验未通过";
									 $name = Yii::app()->user->name;
									 $result = "在<a target='_blank' href='http://data-safe.baidu.com/user_menu?uid=$name@baidu.com'>个人中心</a>发起强制生效或者放弃该批次数据";
									 break;
								 case 6:
									 $status = "数据校验通过，正在执行生效命令";
									 $result = "";
									 break;
								 case 7:
									 $status = "数据校验通过，执行生效命令失败";
									 $result = "请联系负责人<a target='_blank'  href='baidu://message/?id=lizhi_xjtu'>李智</a>处理";
									 break;
								 case 8:
									 $status = "数据检验通过，执行生效命令成功";
									 $result = "";
									 break;
								 default:
									 $result = "";
									 $status = "状态未知";

							 }
							 echo "<td>" . $status . "</td>";
							 echo "<td>" . $item["data_callback_valid_msg"] . "</td>";
							 $send="";
							 switch($item["data_tobogus"]){
								 case 0:
									 $send = "否";
									 break;
								 case 1:
									 $send = "是";
									 break;
							 }
							 echo "<td>" . $send . "</td>";
							 echo "<td>" . $result . "</td>";
							 echo "</tr>";
						}
					}
				?>
                </tbody>
                </table>
    <h3>数据回灌状态详情</h3>	
	<table id="bogus_state" class="table table-bordered table-striped table-hover" style="display:'ture';text-align:left;font-size:12px;"> 
                <thead> 
                <tr style="background-color:#d9edf7">
                    <th width="10%">数据名称</th>
                    <th width="10%">数据id</th>
                    <th width="10%">回灌命令</th>
                    <th width="10%">回灌数量</th>
                    <th width="10%">回灌状态</th>
                    <th width="5%">LB回灌比例</th>
                    <th width="5%">BL回灌比例</th>
                    <th width="20%">操作</th>
                </tr>   
                </thead>
                <tbody style="font-size:12px">
				<?php
				    if(isset($bogus_status)){
						foreach($bogus_status as $item) {
							if(trim($item['data_id']) == "") { continue; }
							 echo "<tr>";
							 echo "<td>" . $item["conf_name"] . "</td>";
							 echo "<td>" . $item["data_id"] . "</td>";
							 echo "<td>" . $item["onset_vars"] . "</td>";
							 echo "<td>" . $item["data_lines"] . "</td>";
							 $status ="";
							 $bogus ="";
							 switch($item['data_lb_status']){
								 case 1:
									 $status = "统一回灌预处理中";
									 $bogus = "";
									 break;
								 case 2:
									 $status = "统一回灌预处理成功";
									 $bogus = "";
									 break;
								 case 3:
									 $status = "统一回灌预处理失败";
									 $bogus = "请联系负责人<a target='_blank'  href='baidu://message/?id=Mayting_2010'>周美婷</a>处理";
									 break;
								 case 4:
									 $status = "统一回灌排序进行中";
									 $bogus = "";
									 break;
								 case 5:
									 $status = "统一回灌排序成功";
									 $bogus = "";
									 break;
								 case 6:
									 $status = "统一回灌排序失败";
									 $bogus = "请联系负责人<a target='_blank'  href='baidu://message/?id=Mayting_2010'>周美婷</a>处理";
									 break;
								 case 7:
									 $status = "统一回灌merge进行中";
									 $bogus = "";
									 break;
								 case 8:
									 $status = "统一回灌成功";
									 $bogus = "";
									 break;
								 default:
									 $bogus = "";
									 $status = "状态未知";

							 }
							 echo "<td>" . $status . "</td>";
							 echo "<td>" . $item["data_bogus_lb_status"] . "</td>";
							 echo "<td>" . $item["data_bogus_bl_status"] . "</td>";
							 echo "<td>" . $bogus . "</td>";
								 
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
<script type="text/javascript" charset="utf8" src="/static/plugins/dataTable/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="/static/plugins/dataTable/js/dataTables.bootstrap.js"></script>
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
$(document).ready(function() {
		$('#lbstate').dataTable( {
		"order": [[ 0, "desc" ],[1,"desc"]]
		} );
		$('#check_state').dataTable( {
		"order": [[ 0, "desc" ],[1,"desc"]]
		} );
		$('#bogus_state').dataTable( {
		"order": [[ 0, "desc" ],[1,"desc"]]
		} );
} );
</script>
