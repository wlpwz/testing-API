<!--<link rel="stylesheet" type="text/css" href="/static/plugins/dataTable/css/dataTables.bootstrap.css">-->
<?php
    $this->beginContent('/layouts/main',['current'=>'ecTask']);
	    ?>
<div class="container">
	<div class="row">
		<div style="margin-top:20px;margin-left:-50px">
			<div class="col-md-2">
				<div class="list-group">
					<B class="list-group-item " style="background-color:#F5F5F5;">任务列表</B>
            		<a href="index.php?r=ecTask/runmission" class="list-group-item ">在线运行任务</a>
            		<a href="index.php?r=ecTask/localmission" class="list-group-item ">离线运行任务</a>
                	<!--<a href="#" class="list-group-item ">离线联调任务</a>-->
                	<a href="index.php?r=ecTask/jenkinsmission" class="list-group-item ">jenkins任务</a>
					<a href="#" class="list-group-item active">EC监控</a>
					<a href="index.php?r=ecTask/diffmission" class="list-group-item ">效果分析任务</a>
            	</div>	
			</div>
			<div class="col-md-10">
				<div class="head_line">
                    <ul class="breadcrumb">
                        <li><a href="/">首页</a></li>
                        <li>任务列表</li>
                        <li class="active">EC监控任务列表</li>
                    </ul>
                </div>
				<table id="local_task" class="table table-bordered table-striped" width="100%" style="text-align:left;font-size:14px;" >
					<thead> 
                    	<tr style="word-break:break-all;">    
        	                <th width="10%">任务ID</th>
							<th width="15%">用户</th>
                            <th width="20%">时间</th>
					<!--		<th width="15%">任务描述</th>-->
                            <th width="25%">描述</th> 
                         <!--   <th  width="50%">运行命令</th> -->
                            <th width="20%">运行结果</th>
                    	</tr>
                	</thead>
					<tbody>
						<?php
							foreach ($result as $run)
							{
								echo "<tr>";
								echo "<td>".$run['task_id']."</td>";
								echo "<td>".$run['user']."</td>";
								//echo "<td>".$run['des']."</td>";
                                echo "<td>".$run['time']."</td>";
								echo "<td>".$run['description']."</td>";
								echo "<td><a href=\"index.php?r=ecmonitor/ecmonitorresult&id=".$run['task_id']."\""."</a>结果</td>";
								/*
								echo "<td>";
								$str =	explode(";",$run['CMD']);
								for($i=0;$i<count($str);$i++)
								{
									echo $str[$i];
									echo "</br>";
								}
								echo "</td>";*/
					//		echo "<td><a href=\"index.php?r=diff/resultanalysis&diffid=".$run['diff_task_id']."\">详情</a></td>";
					//		echo "<td>"."</td>";                        
							echo "</tr>";
					//		$count=$count+1;
						}
						
					?>						
				</tbody>
			</table>				
		</div>
	</div>
</div>
</div>
<script type="text/javascript" charset="utf8" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="/static/plugins/dataTable/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="/static/plugins/dataTable/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
(function(){
$('#local_task').DataTable({"iDisplayLength": 10,
							"lengthChange": false,
							"aaSorting": [[ 0, "desc"]],
							"bScrollCollapse": true,
							"bSort": true,
							"bJQueryUI": true,
							//"bPaginate": true,
															 
						});
/* 
var baseUrl = window.location.href;
$('.del-item').bind('click', function()
{
	if(confirm("数据删除后将不可恢复，请确认是否继续。")) 
	{
		var id = $(this).attr("eid");
		var url = "/feaIntro/evalDelItem?id=" + id;
		
		$.get(url, function(ajaxObj)
		{
			var obj = eval("[" + ajaxObj + "]");
			var data = obj[0];

			if(data.status == 1)
			{
				alert("删除成功"); 
				window.location.href = baseUrl;
			}else{
				alert("删除失败，请稍后重试！"); 
			}
		});
	}
});

*/    
})();
</script>
<?php
    $this->endContent();
	    ?>
