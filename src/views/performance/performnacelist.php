<link rel="stylesheet" type="text/css" href="/static/plugins/dataTable/css/dataTables.bootstrap.css">
<div class="container">
	<div class="row">
			<div class="col-md-10">
				<div class="head_line">
                    <ul class="breadcrumb">
                        <!--li><i class="fa fa-home" style="font-size:18px"></i> &nbsp;<a href="/">首页</a></li-->
                        <li>性能平台</li> 
                        <li class="active">性能平台结果页面</li> 
                    </ul> 
					<div class="box box-info">
						<li>联系我们：<a target="_blank"  href="baidu://message/?id=杨彦红_eileen">杨彦红</a></li>
						<li>只显示近一个月的数据，其他数据请输入任务名称或者负责人名称进行查询</li>
					</div>    
                </div> 
				<form action="?r=performance/task" method="post">
					<input type="text" name="find_str">
					<input type="submit" value="查询">
				</form>
				<table id="local_task" class="table table-bordered table-striped table-hover" width="100%" style="text-align:left;font-size:12px;" > 
				<thead>
				<tr style="word-break:break-all;background-color:#d9edf7">
					<th width="5%">任务ID</th>
					<th width="9%">任务名称</th>
					<th width="9%">提交时间</th>
					<th width="6%">负责人</th>
					<th width="19%">备注</th>
					<th width="7%">性能指标</th>
					<th width="5%">diff(old)</th>
				</tr>
				</thead>
				<tbody style="font-size:12px">
					<?php
						foreach ($result as $task)
                            {       
                                echo "<tr>"; 
								$task_id = $task['performance_main']['task_id'];
								$result_flag = $task['result_flag'];
                                echo "<td id='task_id' value=$task_id>$task_id</td>";
                                echo "<tf>";
                                $task_name=$task['performance_main']['task_name'];
                                echo "<td id='task_name' value=$task_name>$task_name</td>";
                                echo "<tf>";
						        echo "<td>".$task['time']."</td>";
                                echo "<td>".$task['performance_main']['data_user']."</td>";
								echo "<td>".$task['performance_main']['comment']."</td>";
								if ($result_flag == 1){
									echo "<td align='center'><a href='/?r=performance/detail&taskid=$task_id'target='_blank'>查看</a></td>";
								}else{
									echo "<td align='center'> <span id='result_bottom_2_left' style='display:block;'> <img src='images/waiting_small.png'  id='        bottom_logo' height='25px'></span></td>";
								}
								echo "<td align='center'> <form action='?r=performance/diffsubmit' method='post' target='_blank'><input type='hidden' name='task1_id' value='".$task_id."'>"." <input type='text' name='task2_id' style='width:40px;border:none;background-color:transparent;'></form></td>";
								echo "</tr>";
							}
					?>

				</tbody>
				</table>
			</div>
	</div>
</div>
<script type="text/javascript" charset="utf8" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="/static/plugins/dataTable/js/jquery.dataTables.js"></script>
<script type="text/javascript" SRC="static/js/dictionarylist.js"></script>
<script type="text/javascript" charset="utf8" src="/static/plugins/dataTable/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
(function(){
$('#local_task').DataTable({"iDisplayLength": 20,
                            "lengthChange": true,
                            "aaSorting": [[ 0, "desc"]],
                            "bScrollCollapse": true,
                            "bSort": true,
                            "bJQueryUI": true,
                            //"bPaginate": true,
                            "aoColumnDefs": [
								{
 									sDefaultContent: '',
 									aTargets: [ '_all' ]
  								}
							],                                 
                        });
})();
</script>

