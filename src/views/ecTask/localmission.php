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
            		<a href="#" class="list-group-item active">离线运行任务</a>
                <!--	<a href="#" class="list-group-item ">离线联调任务</a>-->
                	<a href="index.php?r=ecTask/jenkinsmission" class="list-group-item ">jenkins任务</a>
                	<a href="index.php?r=ecTask/ecmonitor" class="list-group-item ">EC监控任务</a>
					<a href="index.php?r=ecTask/diffmission" class="list-group-item ">效果分析任务</a>
            	</div>	
			</div>
			<div class="col-md-10">
				<div class="head_line">
                    <ul class="breadcrumb">
                        <li><a href="/">首页</a></li>
                        <li>任务列表</li>
                        <li class="active">离线运行任务列表</li>
                    </ul>
                </div>
				<table id="local_task" class="table table-bordered table-striped" width="100%" style="text-align:left;font-size:14px;" >
					<thead> 
                    	<tr style="word-break:break-all;">    
        	                <th width="10%" style="text-align:left">任务ID</th> 
							<th width="15%" style="text-align:left">时间</th>
							<th width="12%" style="text-align:left">用户</th>
							<th width="12%" style="text-align:left">任务描述</th>
                            <th width="15%" style="text-align:left">任务状态</th> 
                           <!-- <th  width="50%">运行命令</th> -->
                            <th width="20%" style="text-align:left">运行结果</th>
							<th width="20%" style="text-align:left">运行日志</th>
                    	</tr>
                	</thead>
					<tbody>
						<?php
							foreach ($result as $run)
							{
								echo "<tr>";
								echo "<td>".$run['TASK_ID']."</td>";
								echo "<td>".$run['TIME']."</td>";
								echo "<td>".$run['USER']."</td>";
								echo "<td>".$run['des']."</td>";
                                echo "<td>".$run['STATUS']."</td>";
							/*	echo "<td>";
								$str =	explode(";",$run['CMD']);
								for($i=0;$i<count($str);$i++)
								{
									echo $str[$i];
									echo "</br>";
								}
								echo "</td>";*/
								
								if($run['STATUS'] == "done")
								{	echo "<td>
											<a href='index.php?r=localresult/result&taskid=".$run['TASK_ID']."&resultftp=".$run['RUN_RESULT']."'>详情</a></td>";
								//	echo "<td>
								//		     <a href='index.php?r=localresult/showlocallog&taskid=".$run['TASK_ID']."'>日志</a></td>";
										
								}
								else
								{	
									echo "<td></td>";
								
									/*echo "<td>
										<a href='index.php?r=localresult/intimelog&taskid=".$run['TASK_ID']."&resultftp=".$run['RUN_RESULT']."'>非实时日志</a></td>"*/
								}
								 echo "<td><a href='index.php?r=localresult/showlocallog&taskid=".$run['TASK_ID']."'>日志</a></td>";
								//echo '<td><a  href="#" onclick="downloadlog('.$run['TASK_ID'].');">任务日志</a>&nbsp<a>模块日志</a></td>';
								//echo '<td><a  href="http://cp01-testing-ps6076.cp01.baidu.com:8901/platform_common/'.$run['TASK_ID'].'.log">任务日志</a>&nbsp</td>';
        				//		echo "<td><a href=\"index.php?r=diff/resultanalysis&diffid=".$run['diff_task_id']."\">详情</a></td>";
						//		echo "<td>"."</td>";       
							/*	echo "<td>
									<a href='index.php?r=localresult/showlocallog&taskid=".$run['TASK_ID']."'>日志</a></td>";
								echo "</tr>";*/
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
	function downloadlog(taskid)
	{
		console.log(taskid);
		window.open("http://cp01-testing-ps6076.cp01.baidu.com:8901/platform_common/"+taskid+".log","newwindow", "height=100, width=400, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, status=no");
	//	window.open ("ftp://cp01-testing-ps6076.cp01.baidu.com:/home/work/ec_test_service/script/enviroment/log/platform_common/"+taskid+".log", "newwindow", "height=100, width=400, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, status=no") 
	}
</script>
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
<?php $this->endContent(); ?>
