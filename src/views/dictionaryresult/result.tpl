{%$this->beginContent('/layouts/main', ['current'=>'ecTask'])%}
<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="static/js/ZeroClipboard/ZeroClipboard.js"></script>
<script type="text/javascript">
</script>

<div class="container">
	<div class="row" >
		<div style="margin-top:20px;margin-left:-50px">
			<!--LEFT CONTENT-->
            <div class="col-md-2" id="myScrollspy" >
				<ul class="nav nav-tabs nav-stacked" data-spy="affix" data-offset-top="125" style="width:173px;">	
<li style="background-color:#F5F5F5;height:38px;padding-left:13px;padding-top:10px;font-weight:bolder;">离线任务{%$taskid%}详情：</li>
					<li class="active"><a href="#summery" class="list-group-item ">任务概况</a></li>
					{%if $newold==1%}	
					<li class=""><a href="#newolddiff" class="list-group-item ">新旧DIFF测试结果</a></li>
					{%/if%}
					{%if $memory==1%}
							<li class=""><a href="#memory" class="list-group-item ">内存测试结果</a></li>
					{%/if%}
					{%if $speed==1%}
						<li class=""><a href="#speed" class="list-group-item ">包处理速度统计</a></li>
					{%/if%}
				

            </ul>             <!-- <div class="list-group" data-spy="affix" data-offset-top="20">
					<B class="list-group-item " style="background-color:#F5F5F5">离线任务{%$taskid%}详情：</B>
                    <a href="#summery" class="list-group-item active">离线运行概况</a>
					{%if $newolddiff ==1 || newdiff==1 || olddiff==1%}

                    <a href="#diff" class="list-group-item ">DIFF测试结果</a>
					{%/if%}
					{%if $memory ==1 || $speed==1 %}
                    <a href="#performance" class="list-group-item ">性能测试结果</a>
					{%/if%}
                </div>-->
            </div>
			<!--END LEFT CONTENT-->
			<!--RIGHT CONTENT-->
			<div class="col-md-10">
				<div class="head_line">
   					<ul class="breadcrumb">
						<li><a href="index.php?r=dictionary/task">词典测试任务列表</a></li>
      					<li>词典测试任务详情</li> 
     		 			<li class="active">任务概况</li> 
   					</ul>   
				</div> 
				<div class="panel panel-default" id="summery">
					<div class="panel-heading">任务概况</div>
					<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:14px;">
						<tr>    
                            <td>测试功能点：</td>
							<td width="85%">
							{%if $newold==1%}
                            新旧版本DIFF  &nbsp;&nbsp;&nbsp;&nbsp;
							{%/if%}
							{%if $memory==1%}
								物理内存使用统计 &nbsp;&nbsp;&nbsp;&nbsp;
							{%/if%}
							{%if $speed==1%}
                                包处理速度统计 &nbsp;&nbsp;&nbsp;&nbsp;
							{%/if%}
							{%if $newold ==0 &&$memory ==0&&$speed ==0 %}
								获取输出包

							{%/if%}
							</td>
                        </tr>
						<tr><td>DC类型：</td>
							<td>{%if $dc_type==0%}中文{%/if%}
								{%if $dc_type==1%}国际化{%/if%}
								
							</td>
						</tr>
						<tr>
							<td>词典名称：</td>
							<td>{%$dictionary_name%}</td>
						</tr>	
						<tr>
							<td>词典来源：</td>
							<td>{%if $source_name==1%}ftp{%/if%}
								{%if $source_name==2%}hdfs{%/if%}
								{%if $source_name==3%}svn{%/if%}
							</td>
						</tr>
						<tr>
							<td>词典来源地址：</td>
							<td>{%$source_ftp%}</td>
						</tr>
						<tr>
							<td>新版DC执行环境：</td>
							<td width="85%"><input style="display:none" id="copy1" value="{%$newec%}"><a href="javascript:void(0);" id="btnCopy1" title="复制" onclick="toClipboard(this.id,'copy1')">{%$newec%}</a></td>
						</tr>	
						<tr>
                            <td>旧版DC执行环境：</td>
                            <td width="85%"><input style="display:none" id="copy2" value="{%$oldec%}"><a href="javascript:void(0);" id="btnCopy2" title="复制" onclick="toClipboard(this.id,'copy2')">{%$oldec%}</a></td>
                        </tr> 
						<tr>
							<td>运行结果地址：</td>
							<td width="85%"><input style="display:none" id="copy3" value="{%$dir%}"><a href="javascript:void(0);" id="btnCopy3" title="复制" onclick="toClipboard(this.id,'copy3')">{%$dir%}</a></td>
						</tr>
						<!--全为0情况	<tr>
                                <td>输入包地址：</td>
                                <td width="85%">{%$input_data%}</td>
                            </tr>
                            <tr>
                                <td>新EC输出包地址：</td>
                                <td width="80%">{%$output_data_new%}</td>
							</tr>
							<tr>
								<td>旧EC输出包地址：</td>
                                <td>
                                    {%$output_data_old%}
                                </td>
                            </tr>-->
					</table>
				</div>
					{%include file="diffresult.tpl"%}
					
				{%if $cov_result!=""%}
				<div class="panel panel-info" >
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
					<div id="performance">
						{%include file="performance.tpl"%}
					</div>
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
