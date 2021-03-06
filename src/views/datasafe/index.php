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
            <li class="active"><a id="btn-jike-video" href="http://cq01-testing-ps7109.vm.baidu.com:8911/?r=datasafe/index">统一回灌接口问题追查</a></li>
            <li><a href="http://cq01-testing-ps7109.vm.baidu.com:8911/?r=datasafe/bogus">统一回灌数据状态查询</a></li>
            <li><a href="#">统一回灌LB|BL查询</a></li>
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
<h4>统一回灌接口问题查询</h4>
 <div class="panel panel-default">
	<div class="panel-heading">条件输入</div>
<table class="table table-bordered" style="text-align:left;font-size:14px">
<body>
	<tr> 
         <td style="width:90%">
			&nbsp;<input type="radio" name="ecrunposition" id= "ecrunposition0" value="default" checked  onclick="ecruncheck(this.value)"  onchange="changeValue();">
            <font>linkbase回灌状态</font>
			&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="ecrunposition" id="ecrunposition1" value="outside" onclick="ecruncheck(this.value)"  onchange="changeValue();">
            <font>linkbase、baling回灌比例</font>
			<br/>
			<br/>
			<table rules=none id="table_machine_url" style="width:800px;display:'true';font-size:14px; color:#333333">
				<body>
					<tr>
						<td>数据名称</td>
						<td style="width:80%;">
							<input id='url' type="text" style="width: 80%;height:30px;margin-left:-80px;border-bottom:2px solid #a9c6c9;"  placeholder='dedup-mine-del-nmg_1435100414'><code>支持模糊查询，只显示最近10条</code>
						</td>
					</tr>
				</body>
			</table>
			<table rules=none id="table_machine_file" style="width:800px;display:none;font-size:14px; color:#333333">
				<body>
					<tr>
						<td>数据名称</td>
						<td style="width:80%;">
							<input id='path' type="text" style="width: 80%;height:30px;margin-left:-80px;border-bottom:2px solid #a9c6c9;"  placeholder='dedup-mine-del-nmg_1435100414'><code>支持模糊查询,只显示最近10条</code>
						</td>
					</tr>
				</body>
			</table>
		</td>	
	</tr>
</body>
</table>
<h4 class="text-success"><button type="button" class="btn btn-primary" style="color: black;background-color: rgba(255, 255, 240, 0.05);margin-left: 300px;margin-top: 20px;" id="subtn">查询</button></h4>
</div>
<strong id="lbstateh" style="color:#b34e22;font-size:12px;display:'true'">说明：如果结果返回状态和页面不一致，以这里为准。平台每75分钟调一次接口进行刷库。<font color="337ab7">联系我们：<a target="_blank"  href="baidu://message/?id=杨彦红_eileen">杨彦红</a>&nbsp;&nbsp;<a target="_blank"  href="baidu://message/?id=Mayting_2">周美婷</a></strong>
<strong id="lbblh" style="color:#b34e22;font-size:12px;display:none">说明： 把<font color="337ab7">"接口命令"</font>在浏览器中打开，在页面中用<font color="337ab7">“搜索关键词”</font>进行搜索，然后找到对应的</br>
"linkbase_effect","bailing_effect","linkbase_sum","bailing_sum"字段。</br>
BL回灌比例是bailing_effect/bailing_sum, LB回灌比例是linkbase_effect/baliing/sum</br><font color="337ab7">联系我们：<a target="_blank"  href="baidu://message/?id=Mayting_2">周美婷</a>&nbsp;&nbsp;<a target="_blank"  href="baidu://message/?id=杨彦红_eileen">杨彦红</a></strong>
<table id="lbstate" class="table table-bordered table-striped table-hover" width="100%" style="display:'ture';text-align:left;font-size:12px;"> 
                <thead> 
                <tr style="background-color:#d9edf7">
                    <th width="10%">数据名称</th>
                    <th width="5%">data_id</th> 
                    <th width="10%">数据更新时间</th> 
                    <th width="10%">接口返回值</th> 
                    <th width="30%">回灌状态</th> 
                </tr>   
                </thead>
                <tbody style="font-size:12px">
                <?php
                  if(isset($safe_data)) {
                    foreach($safe_data as $item) {
                      if(trim($item['data_id']) == "") { continue; }
                      echo "<tr>";
                      echo "<td>" . $item["data_version_id"] . "</td>";
                      echo "<td>" . $item["data_id"] . "</td>";
                      echo "<td>" . $item["data_version_time"] . "</td>";
                      echo "<td>" . $item["status"] . "</td>";
                      echo "<td>status:-1 流程还没有执行到统一回灌</br>status:0预处理，表示调用回灌命令成功</br>
                            status:1saver-inc排序</br>
                            stauts:2数据生效即数据回灌linkbase的操作</br>
                            每个状态对应的result:doing进行中，fail失败，success成功</td>";
                     /* echo "<td>" . "<a href = '?r=system/showerror&uid=" . $item["ui
d"] . "&sid=" . $item["sid"]."' target = '_blank'>详情</a>"."</td>";*/
                      echo "</tr>";
                    }
                  }
                ?>
                </tbody>
                </table>
<table id="lbbl" class="table table-bordered table-striped table-hover" width="100%" style="display:none;text-align:left;font-size:12px;"> 
                <thead> 
                <tr style="background-color:#d9edf7">
                    <th width="15%x">数据名称</th>
                    <th width="5%">data_id</th> 
                    <th width="10%">数据更新时间</th> 
                    <th width="15%">接口关键词</th> 
                    <th width="15%">回灌命令</th> 
                    <th width="40%">接口命令</th> 
                    <!--th width="10%">操作</th--> 
                </tr>   
                </thead>
                <tbody style="font-size:12px">
                <?php
                  if(isset($safe_data2)) {
                    foreach($safe_data2 as $item) {
                      if(trim($item[data_version_id]) == "") { continue; }
                      echo "<tr>";
                      echo "<td>" . $item["data_version_id"] . "</td>";
                      echo "<td>" . $item["data_id"] . "</td>";
                      echo "<td>" . $item["data_version_time"] . "</td>";
                      echo "<td>" . $item["data_version_key"] . "</td>";
                      echo "<td>" . $item["data_onset_vars"] . "</td>";
                      echo "<td>" . $item["data_cmd"] . "</td>";
                      echo "</tr>";
                    }
                  }
                ?>
                </tbody>
                </table>
</div>
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
$(document).ready(function(){ 
    var flag = getCookie('select');
    if(flag == "flag2"){
        document.getElementById("ecrunposition1").checked=true;
        changeValue();
        clearCookie("select");
    }else{
        document.getElementById("ecrunposition0").checked=true;
        changeValue();
        clearCookie("select");
    }
});
function changeValue(){
    var check0 = document.getElementById("ecrunposition0").checked;
    var check1 = document.getElementById("ecrunposition1").checked;

    if(check1)
    {
        document.getElementById('table_machine_url').style.display='none';
        document.getElementById('table_machine_file').style.display='';
        document.getElementById('lbstateh').style.display='none';
        document.getElementById('lbstate').style.display='none';
        document.getElementById('lbblh').style.display='';
        document.getElementById('lbbl').style.display='';
    }
    if(check0)
    {
        document.getElementById('table_machine_file').style.display='none';
        document.getElementById('table_machine_url').style.display='';
        document.getElementById('lbstateh').style.display='';
        document.getElementById('lbstate').style.display='';
        document.getElementById('lbblh').style.display='none';
        document.getElementById('lbbl').style.display='none';
    }
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
    var check0 = document.getElementById("ecrunposition0").checked;
    var check1 = document.getElementById("ecrunposition1").checked;
    if(check0)
    {
        var data_version_id = $('#url').val();
        window.location.href="index.php?r=datasafe/submit&data_version_id=" + data_version_id + "&flag=1";
        setCookie("select","flag1",1800);       
    }else if(check1)
    {
            var data_version_id = document.getElementById("path").value;
            window.location.href="index.php?r=datasafe/submit&data_version_id=" + data_version_id + "&flag=2";
            setCookie("select","flag2",1800);       
    }
    
});
</script>
