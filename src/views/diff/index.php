<?php
        $this->beginContent('/layouts/main',['current'=>'diff']);
?>
<div style="margin-left:15%; margin-right:15%">
<div style="margin-top:20px">
<!--<ul class="nav nav-pills" style="margin-top:20px">
  <li class="active"><a href="#">EC产出地址提交</a></li>
  <li><a href="?r=diff/resultanalysis">结果分析</a></li>
</ul>-->
<div class="head_line">
                    <ul class="breadcrumb">
                        <li><a href="/">首页</a></li>
                        <li class="active">结果分析</li> 
                    </ul>   
</div> 
<div class="panel panel-default">
<div class="panel-heading">第一步，填写任务描述和EC版本</div>
<table class="table table-bordered" style="text-align:left;font-size:14px;">
<tr>
	<td>任务描述</td>
	<td style="width:80%">
		<input type="text" id="mission_description" placeholder="任务描述(任务名称)" style="width: 600px;height:30px;margin-left:20px;border: darkseagreen;border-bottom:2px solid #a9c6c9;">
	</td>
</tr>
<tr>
    <td align="centre">新EC版本</td>
    <td style="width:80%">
        <input type="text" id="new_ver" placeholder='新EC版本' style="width: 600px;height:30px;margin-left:20px;border: darkseagreen;border-bottom:2px solid #a9c6c9;">
    </td>
</tr>
<tr>
    <td>旧EC版本</td>
    <td style="width:90%">
        <input type="text" id="old_ver" placeholder="旧EC版本" style="width: 600px;height:30px;margin-left:20px;border: darkseagreen;border-bottom:2px solid #a9c6c9;">
    </td>
</tr>
<tr>
    <td>类型</td>
    <td style="width:90%">
    	<table rules=none style="width: 100%;font-size:14px;">
			<tr>
				<td width=50%>
				&nbsp;&nbsp;	<input type="radio" name="ectype" value="chineseec" checked onclick="radiocheck(this.value)"><font>中文EC</font>
				</td>
				<td>
					<input type="radio" name="ectype" value="internationalec" onclick="radiocheck(this.value)"><font>国际化EC</font>
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>
</div>
<div class="panel panel-default">
<div class="panel-heading">第二步，给出需要分析的新旧EC输出包地址</div>
<table  class="table table-bordered" style="text-align:left;font-size:14px;">
	<tr>
		<td>新EC输出包FTP地址:</td>
		<td width="84%">
			 <input type="text" id="new_ftp" placeholder="ftp://" style="width: 600px;height:30px;margin-left:20px;border: darkseagreen;border-bottom:2px solid #a9c6c9;">
		</td>
	</tr>
	<tr>
        <td>旧EC输出包FTP地址:</td>
        <td>
             <input type="text" id="old_ftp" placeholder="ftp://" style="width: 600px;height:30px;margin-left:20px;border: darkseagreen;border-bottom:2px solid #a9c6c9;">
        </td>
    </tr>
</table>
</div>
<h4 class="text-success"><button type="button" class="btn btn-primary" style="color: black;background-color: rgba(255, 255, 240, 0.05);margin-left:43%;margin-top: 20px;" id="subtn" onclick="Submit_Form(0)">提交任务</button></h4>
<script type="text/javascript" SRC="static/js/diffindex.js"></script>
</div>
</div>
<?php $this->endContent(); ?>
