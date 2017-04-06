<!--<link rel="stylesheet" type="text/css" href="/static/plugins/dataTable/css/dataTables.bootstrap.css">-->
<div class="container">
	<div class="row">
		<div style="margin-top:20px;margin-left:-50px">
			<div class="col-md-2">
				<div class="list-group">
					<B class="list-group-item " style="background-color:#33cc99">任务列表</B>
            		<a href="#" class="list-group-item active">在线运行任务</a>
            		<a href="index.php?r=ecTask/localmission" class="list-group-item ">离线运行任务</a>
                	<a href="#" class="list-group-item ">离线联调任务</a>
                	<a href="index.php?r=ecTask/jenkinsmission" class="list-group-item ">jenkins任务</a>
					<a href="index.php?r=ecTask/diffmission" class="list-group-item ">效果分析任务</a>
            	</div>	
			</div>
			<div class="col-md-10">
				<div class="head_line">
                    <ul class="breadcrumb">
                        <li><a href="/">首页</a></li>
                        <li>任务列表</li>
                        <li class="active">在线运行任务列表</li>
                    </ul>
                </div>
				<table id="run_task" class="table table-bordered table-striped table-hover valignM" width="100%" style="font-size:11px;table-layout:fixed;">
					<thead> 
                    	<tr style="background-color:#00cc99;word-break:break-all;">    
        	                <th width="7%">RUN_ID</th> 
                            <th width="10%">时间</th> 
                            <th width="10%">用户</th> 
                            <th width="10%">DIFF_ID</th> 
                          	<th width="10%">任务状态</th>
                            <th width="10%">运行结果</th> 
							<th width="10%">运行日志</th>
                    	</tr>
                	</thead>
					<tbody>
						<?php
							$count=1;
							foreach ($result as $run)
							{
								echo "<tr>";
								echo "<td>".$run['run_task_id']."</td>";
								echo "<td>".$run['time']."</td>";
								echo "<td>".$run['user']."</td>";
                             //   echo "<td>".$run['related_run_id']."</td>";
								echo "<td>".$run['diff_id']."</td>";
                            //    echo "<td>".$run['log_path']."</td>";
								echo "<td>".$run['status']."</td>";
                               // echo "<td>".$run['ec_type']."</td>";
                               // echo "<td>".$run['bin_output_new']."</td>";
                               // echo "<td>".$run['bin_output_old']."</td>";
                               // echo "<td>".$run['conf_new']."</td>";
                               // echo "<td>".$run['conf_old']."</td>";
							//	echo "<td>".$run['input_path']."</td>";
                            //    echo "<td>".$run['input_num']."</td>";
        						echo "<td><a href='?r=run/runresult&task_id=".$run['run_task_id']."'>详情</a></td>";							  echo "<td><a href='?r=run/showLog&task_id=".$run['run_task_id']."'>日志</a></td>";
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
<script type="text/javascript" charset="utf8" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="/static/plugins/dataTable/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="/static/plugins/dataTable/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
(function(){
    $('#run_task').DataTable({"iDisplayLength": 10,
								"lengthChange": false,
								"bScrollCollapse": true,
								"bSort": true,
								"bJQueryUI": true,
								"bPaginate": true,
																 
							});
	$('#run_task').DataTable({"iDisplayLength": 10,
								"lengthChange": false,
								"bScrollCollapse": true,
								"bSort": true,
								"bJQueryUI": true,
								"bPaginate": true,
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
