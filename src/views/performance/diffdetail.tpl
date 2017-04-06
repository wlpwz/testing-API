<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">
</script>

<div class="container">
	<div class="row" >
		<div style="margin-top:20px;">
			<div class="col-md-10">
				<div class="head_line">
   					<ul class="breadcrumb">
						<li><a href="index.php?r=performance/task">性能测试结果列表</a></li>
      					<li>测试任务性能diff详情</li> 
     		 			<li class="active">性能diff</li> 
   					</ul>   
				</div> 
				<h4>任务名称:{%$task_name%}</h4>
				<div class="panel panel-default" id="summery">
				    <div class="panel-heading">性能diff</div>
					<div class="panel-body" style="overflow:auto;">
					<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:14px;">
					<tr>
                    {%foreach $performances as $performance%}
					    <th colspan="3" role="key-list" style="text-align:center;">{%$performance@key%}</th>
                    {%/foreach%}
					</tr>
					<tr>
					{%foreach $performances as $performance%}
					    {%foreach $performance as $summary%}
						<td align="center">{%$summary@key%}</td>
                        {%/foreach%}
                    {%/foreach%}
					</tr>
					<tr>
					{%foreach $performances as $performance%}
					    {%foreach $performance as $summary%}
						<td align="center">{%$summary@value%}</td>
                        {%/foreach%}
                    {%/foreach%}
					</tr>
					</table>
					</div>
				</div>
					
				<div id="performance">
					{%include file="diffchart.tpl"%}
				</div>
			</div>
			<!--END RIGHT CONTENT-->
		</div>
	</div>
</div>

