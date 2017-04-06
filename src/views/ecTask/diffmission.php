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
					<a href="index.php?r=ecTask/jenkinsmission" class="list-group-item">jenkins任务</a>
					<a href="index.php?r=ecTask/ecmonitormission" class="list-group-item">EC监控任务</a>
					<a href="#" class="list-group-item active">效果分析任务</a>

				</div>  
			</div>
			<div class="col-md-10">
				<div class="head_line">
                    <ul class="breadcrumb">
                        <li><a href="/">首页</a></li>
                        <li>任务列表</li>
                        <li class="active">效果分析任务列表</li>
                    </ul>
                </div>
				<table id="run_task" class="table table-bordered table-striped" width="100%"  style="text-align:left;font-size:14px;">
					<thead> 
                    	<tr style="word-break:break-all;">    
        	                <th>任务号</th> 
                            <th>用户</th> 
                            <th>提交时间</th> 
                            <th>任务状态</th> 
                           <!-- <th>Log_path</th>
							<th>Host Name</th>
 							<th>Mission Description</th>
                          	<th>New Version</th>
							<th>Old Version</th>
							<th>Ec Type</th>
 							<th>New Input_path</th>
							<th>Old Input_num</th> -->
							<th width="20%">结果详情</th>
                           <!-- <th>操作</th> -->
                    	</tr>
                	</thead>
					<tbody>
						<?php
							$count=1;
							foreach ($result as $run)
							{
								echo "<tr>";
								echo "<td>".$run['diff_task_id']."</td>";
								echo "<td>".$run['user']."</td>";
								echo "<td>".$run['time']."</td>";
                                echo "<td>".$run['status']."</td>";
								//echo "<td>".$run['log_path']."</td>";
                               // echo "<td>".$run['host_name']."</td>";
							///	echo "<td>".$run['mission_description']."</td>";
                              //  echo "<td>".$run['new_version']."</td>";
                               // echo "<td>".$run['old_version']."</td>";
                               // echo "<td>".$run['ec_type']."</td>";
                               // echo "<td>".$run['new_input_path']."</td>";
                               // echo "<td>".$run['old_input_path']."</td>";
        						echo "<td><a href=\"index.php?r=diff/resultanalysis&diffid=".$run['diff_task_id']."\">详情</a></td>";
								//echo "<td>"."</td>";                        
								echo "</tr>";
								$count=$count+1;
							}
							
						?>						
					</tbody>
				</table>				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" charset="utf8" src="/static/plugins/dataTable/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="/static/plugins/dataTable/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
(function(){
    $('#run_task').DataTable({"iDisplayLength": 10,
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
