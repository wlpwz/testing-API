{%$this->beginContent('/layouts/main', ['current'=>'ecTask'])%}
<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="/scripts/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="static/js/ZeroClipboard/ZeroClipboard.js"></script>
<div class="container">
    <div class="row" data-spy="scroll" data-target="#myScrollspy">
		<div style="margin-top:20px;margin-left:-50px">
			<!--LEFT CONTENT-->
            <div class="col-md-2" id="myScrollspy">
				<ul class="nav nav-tabs nav-stacked" data-spy="affix" data-offset-top="125" style="width:173px;">
					<li style="background-color:#F5F5F5"><div style="height:38px;padding-left:13px;padding-top:10px;font-weight:bolder;">Jenkins任务{%$taskid%}详情：</div><li>
                   <li class="active"><a href="#summery" class="list-group-item ">任务概况</a></li>
					{%if $newolddiff ==1%}
                   <li class=""><a href="#newolddiff" class="list-group-item ">新旧DIFF测试结果</a></li>
					{%/if%}
					{%if $newdiff ==1%}
                   <li class=""><a href="#consistentdiff" class="list-group-item ">新版一致性测试结果</a></li>
					{%/if%}
					{%if $olddiff ==1%}
				   <li class=""><a href="#olddiff" class="list-group-item ">旧版一致性测试结果</a></li>
					{%/if%}
					{%if $memory ==1%}
                   <li class=""><a href="#memory" class="list-group-item ">内存测试结果</a></li>
					{%/if%}
					{%if $speed ==1%}
                   <li class=""><a href="#performance" class="list-group-item ">包处理速度统计</a></li>
					{%/if%}
                   <li class=""><a href="#cov" class="list-group-item ">覆盖率信息</a></li>
                </ul>
            </div>
			<!--END LEFT CONTENT-->
			<!--RIGHT CONTENT-->
			<div class="col-md-10">
				<div class="head_line">
   					<ul class="breadcrumb">
						<li><a href="index.php?r=ecTask/jenkinsmission">jenkins任务列表</a></li>
      					<li>Jenkins任务详情</li> 
     		 			<li class="active">任务概况</li> 
   					</ul>   
				</div> 
				<div class="panel panel-default" id="summery">
					<div class="panel-heading">任务概况</div>
					<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:14px;">
						<tr>    
                            <td>测试功能点：</td>
							<td width="85%">
							{%if $newolddiff==1%}
                            新旧版本DIFF  &nbsp;&nbsp;&nbsp;&nbsp;{%/if%}
							{%if $newdiff==1%}	新版一致性DIFF &nbsp;&nbsp;&nbsp;&nbsp;{%/if%}
							{%if $olddiff==1%}	旧版一致性DIFF &nbsp;&nbsp;&nbsp;&nbsp;{%/if%}
							{%if $memory==1%}	物理内存使用统计 &nbsp;&nbsp;&nbsp;&nbsp;{%/if%}
                             {%if $speed==1%}   包处理速度统计 &nbsp;&nbsp;&nbsp;&nbsp;{%/if%}
							</td>
                        </tr>	
						<tr>
							<td>EC类型</td>
							{%if $ec_type==0%}
								<td>中文</td>
							{%/if%}
							{%if $ec_type==1%}
								<td>国际化</td>
							{%/if%}
						</tr>
						<tr>
							<td>线程数</td>
							<td>{%$thread_num%}</td>
						</tr>
						<tr>
							<td>新版EC执行环境：</td>
							<td width="85%"><input style="display:none" id="copy1" value="{%$newec%}"><a href="javascript:void(0);" id="btnCopy1" title="复制" onclick="toClipboard(this.id,'copy1')">{%$newec%}</a></td>
						</tr>	
						<tr>
                            <td>旧版EC执行环境：</td>
                            <td width="85%"><input style="display:none" id="copy2" value="{%$oldec%}"><a href="javascript:void(0);" id="btnCopy2" title="复制" onclick="toClipboard(this.id,'copy2')">{%$oldec%}</a></td>
                        </tr> 
						<tr>
							<td>运行结果地址：</td>
							<td width="85%"><input style="display:none" id="copy3" value="{%$dir%}"><a href="javascript:void(0);" id="btnCopy3" title="复制" onclick="toClipboard(this.id,'copy3')">{%$dir%}</td>
						</tr>
					</table>
				</div>
					{%include file="diffresult.tpl"%}
					
					{%include file="performance.tpl"%}
				{%if $cov_result!=""%}
				<div class="panel panel-default" id="bigpack_ec1" >
					<div class="panel-heading"><span>EC1大包处理速度对比</span></div>
					<iframe src="{%$bigpack_ec1%}" width=100% height=400></iframe>
					<div>
					     <table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:14px;">
						 <th>ID</th><th>Url</th><th>old use time</th><th>new use time</th>
						{%$bigpack_ec1_list%}
						 </table>
					</div>
				</div>
				<div class="panel panel-default" id="bigpack_ec2">
					<div class="panel-heading"><span>EC2大包处理速度对比</span></div>
					<iframe src="{%$bigpack_ec2%}" width=100% height=400></iframe>
					<div>
					     <table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:14px;">
						 <th>ID</th><th>Url</th><th>old use time</th><th>new use time</th>
						{%$bigpack_ec2_list%}
						 </table>
					</div>
				</div>
				<div class="panel panel-info" id="cov">
				    <div class="panel-heading"><a class="accordion-toggle" value=false onclick="showCovFile(this)"><span style="cursor:pointer">覆盖率信息  <strong >&nu;</strong></span></a>
					</div>
						<table width="100%" class="table table-bordered table-striped" id="cov_table">
						{%$summery_result%}
						</table>
						<script>
							function showCovFile(node)
							{
								var flag = node.getAttribute("value");
								if (flag == "false")
								{
									document.getElementById("cov_table").innerHTML='{%$cov_result%}';
									node.setAttribute("value","true");
									node.innerHTML="<span style=\"cursor:pointer\">覆盖率信息 <strong>&Lambda;</strong></span>";
								}
								else
								{
									document.getElementById("cov_table").innerHTML="{%$summery_result%}";
									node.setAttribute("value","false");
									node.innerHTML="<span style=\"cursor:pointer\">覆盖率信息 <strong>&nu;</strong></span>";

								}
							}
						</script>
				</div>
				{%/if%}
				</div>
			</div>
			<!--END RIGHT CONTENT-->
		</div>
	</div>
</div>
<script>
    ZeroClipboard.setMoviePath("static/js/ZeroClipboard/ZeroClipboard.swf");
    function $(id) { return document.getElementById(id); }  
    function toClipboard(copy_id,input_id) {
        var clip = new ZeroClipboard.Client();
        clip.setHandCursor(true); 
        clip.setText($(input_id).value); 
        clip.addEventListener('complete', function (client) {
            alert("复制成功");   
        });  
        clip.glue(copy_id);  
    }
       /* ZeroClipboard.setMoviePath("static/js/ZeroClipboard/ZeroClipboard.swf");
    var clip = new ZeroClipboard.Client(); // 新建一个对象
        clip.setHandCursor(true); // 设置鼠标为手型
        clip.setText(document.getElementById("copy1").value);
        clip.glue("btnCopy"); //与复制按钮关联，这里的btnCopy是关联对象的id，必须和第3步中的html对象的id相同
        clip.setText(document.getElementById("copy1").value);
        clip.addEventListener( "complete", function(){  
            alert("本文链接复制成功！");   
        });*/

</script>
{%$this->endContent()%}
