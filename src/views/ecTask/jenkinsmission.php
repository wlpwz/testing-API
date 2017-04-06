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
                	<a href="#" class="list-group-item active ">jenkins任务</a>
					<a href="index.php?r=ecTask/diffmission" class="list-group-item ">效果分析任务</a>
            	</div>	
			</div>
			<div class="col-md-10">
				<div class="head_line">
                    <ul class="breadcrumb">
                        <li><a href="/">首页</a></li>
                        <li>任务列表</li>
                        <li class="active">jenkins任务列表</li>
                    </ul>
                </div>
				<table id="local_task" class="table table-bordered table-striped" width="100%" style="text-align:left;font-size:14px;" >
					<thead> 
                    	<tr style="word-break:break-all;">    
        	                <th width="10%">任务ID</th> 
                            <th width="15%">时间</th>
					<!--		<th width="15%">任务描述</th>-->
                            <th width="15%">任务状态</th> 
                         <!--   <th  width="50%">运行命令</th> -->
                            <th width="20%">运行结果</th>
							<th width="20%">运行日志</th>
                    	</tr>
                	</thead>
					<tbody>
						<?php
							foreach ($result as $run)
							{
								echo "<tr>";
								echo "<td>".$run['TASK_ID']."</td>";
								echo "<td>".$run['TIME']."</td>";
								//echo "<td>".$run['des']."</td>";
                                echo "<td>".$run['STATUS']."</td>";
								/*
								echo "<td>";
								$str =	explode(";",$run['CMD']);
								for($i=0;$i<count($str);$i++)
								{
									echo $str[$i];
									echo "</br>";
								}
								echo "</td>";*/
								if($run['STATUS'] == "done")
								{
                                	echo "<td>
											<a href='index.php?r=jenkinsresult/result&taskid=".$run['TASK_ID']."&resultftp=".$run['RUN_RESULT']."'>详情</a></td>";
								//	echo "<td>
								//		<a href='index.php?r=jenkinsresult/showjenkinslog&taskid=".$run['TASK_ID']."&resultftp=".$run['RUN_RESULT']."'>日志</a></td>";
								}
								else
								{
									echo "<td></td>";
								}
								echo '<td><a href="index.php?r=jenkinsresult/showjenkinslog&taskid='.$run['TASK_ID'].'&resultftp='.$run['RUN_RESULT'].'">日志</a></td>';
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
})();
</script>
<?php
    $this->endContent();
	    ?>
