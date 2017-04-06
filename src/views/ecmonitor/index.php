
<?php
    $this->beginContent('/layouts/main',['current'=>'run']);
?>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/bootstrap.min.js"></script>
<div class="container">
	<div class="row">
		<div style="margin-top:20px;margin-left:-50px">
			<div class="col-md-2">
				<div class="list-group">
					<B class="list-group-item " style="background-color:#F5F5F5;">轻松运行</B>
						<a href="#" class="list-group-item active">EC内存监控</a>
				</div>
			</div>
			<div class="col-md-10">
				<div class="head_line">
                    <ul class="breadcrumb">
                        <li><a href="/">首页</a></li>
                        <li class="active">EC监控</li> 
                    </ul>   
                </div> 	
<script type="text/javascript" src="static/js/run.js"></script>
<script type="text/javascript" src="static/js/bootstrap.js"></script>
 <div class="panel panel-default">
 <div class="panel-heading">EC1监控</div>
<table class="table table-bordered" style="text-align:left;font-size:14px;">
<body>
	<tr>
		<td>任务描述</td>
		<td style="width:90%;">
			<input typle="text" id="des" style="width: 500px;height:30px;margin-left:0px;border: darkseagreen;border-bottom:2px solid #a9c6c9;" placeholder="输入任务描述，更方便识别任务哦~">				
		</td>
	</tr>
	<tr>
		<td>监控机器名：</td>
		<td><input type="text" id="ec1_hostname" placeholder="work@cp01-testing-ps6076.cp01.baidu.com" style="width: 500px;height:30px;margin-left:0px;border: darkseagreen;border-bottom:2px solid #a9c6c9;"></td>
	</tr>
	<tr>
		<td>监控机器密码：</td>
		<td><input type="text" id="ec1_password" placeholder="ps-tesitng!!!" style="width: 200px;height:30px;margin-left:0px;border: darkseagreen;border-bottom:2px solid #a9c6c9;"></td>
	</tr>
	<tr>
		<td>监控进程PID</td>
		<td><input type="text" id="ec1_pid" placeholder="2931" style="width: 200px;height:30px;margin-left:0px;border: darkseagreen;border-bottom:2px solid #a9c6c9;"></td>
	</tr>
</body>
</table>
</div>
<div class="panel panel-default">
	<div class="panel-heading">EC2监控</div>
<table class="table table-bordered" style="text-align:left;font-size:14px;">
	<body>
	<tr>
		<td>监控机器名：</td>
		<td><input type="text" id="ec2_hostname" placeholder="work@cp01-testing-ps6076.cp01.baidu.com" style="width: 500px;height:30px;margin-left:0px;border: darkseagreen;border-bottom:2px solid #a9c6c9;"></td>
	</tr>
	<tr>
		<td>监控机器密码：</td>
		<td><input type="text" id="ec2_password" placeholder="ps-tesitng!!!" style="width: 200px;height:30px;margin-left:0px;border: darkseagreen;border-bottom:2px solid #a9c6c9;"></td>
	</tr>
	<tr>
		<td>监控进程PID</td>
		<td><input type="text" id="ec2_pid" placeholder="2931" style="width: 200px;height:30px;margin-left:0px;border: darkseagreen;border-bottom:2px solid #a9c6c9;"></td>
	</tr>
</body>
</table>
</div>
<h4 class="text-success"><button type="button" class="btn btn-primary" style="color: black;background-color: rgba(255, 255, 240, 0.05);margin-left: 500px;margin-top: 20px;" id="subtn" onclick="monitor_submit()">提交</button></h4>
</div>
</div>
</div>
</div>
<script>
	function monitor_submit()
	{
		var ec1_password = document.getElementById("ec1_password").value;
		var ec1_hostname = document.getElementById("ec1_hostname").value;
		var ec1_pid = document.getElementById("ec1_pid").value;
		var ec2_password = document.getElementById("ec2_password").value;
		var ec2_hostname = document.getElementById("ec2_hostname").value;
		var ec2_pid = document.getElementById("ec2_pid").value;
		var description = document.getElementById("des").value;
		var fd = new FormData();
		fd.append("ec1_password", ec1_password);
		fd.append("ec1_hostname", ec1_hostname);
		fd.append("ec1_pid", ec1_pid);
		fd.append("ec2_hostname", ec2_hostname);
		fd.append("ec2_password", ec2_password);
		fd.append("ec2_pid", ec2_pid);
		fd.append("description", description);
		var xhr = new XMLHttpRequest(); 
		xhr.addEventListener("load", markComplete,false);
		xhr.open("POST", "?r=ecmonitor/submit");
		xhr.send(fd);
		alert("任务提交成功");   
	}
	function markComplete(evt)
	{
//		alert(evt.target.responseText);
	}

</script>
<?php $this->endContent(); ?>
