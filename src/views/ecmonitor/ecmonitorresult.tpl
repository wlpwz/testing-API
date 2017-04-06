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
					<li style="background-color:#F5F5F5"><div style="height:38px;padding-left:13px;padding-top:10px;font-weight:bolder;">EC监控任务{%$taskid%}详情：</div><li>
                   <li class="active"><a href="#summery" class="list-group-item ">EC内存图</a></li>
                </ul>
            </div>
			<!--END LEFT CONTENT-->
			<!--RIGHT CONTENT-->
			<div class="col-md-10">
				<div class="head_line">
   					<ul class="breadcrumb">
						<li><a href="index.php?r=ecTask/jenkinsmission">EC监控任务列表</a></li>
      					<li>EC监控任务详情</li> 
     		 			<li class="active">任务结果</li> 
   					</ul>   
				</div> 
				<div class="panel panel-default" id="ec1_memory" >
					<div class="panel-heading"><span>EC1内存</span></div>
					<iframe src="{%$ec1_result%}" width=100% height=500 id="ec1_result"></iframe>
				</div>
				<div class="panel panel-default" id="ec2_memory">
					<div class="panel-heading"><span>EC2内存</span></div>
					<iframe src="{%$ec2_result%}" width=100% height=500></iframe>
				</div>
			</div>
			<!--END RIGHT CONTENT-->
		</div>
	</div>
</div>
<script>
//iframe1 = document.getElementById("ec1_result");
//iframe1.setAttribute("src","{%$ec1_result%}");
//iframe1.setAttribute("src","sfsdf");
</script>
{%$this->endContent()%}
