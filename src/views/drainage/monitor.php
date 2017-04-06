<link rel="stylesheet" type="text/css" href="/static/plugins/dataTable/css/dataTables.bootstrap.css">
<div class="container">
	<div class="row">
		<div class="col-md-10">
			<div class="head_line">
				<ul class="breadcrumb">
					<!--li><i class="fa fa-home" style="font-size:18px"></i> &nbsp;<a href="/">首页</a></li-->
					<li>数据引流</li> 
					<li class="active">引流任务监控</li> 
				</ul> 
				<div class="box box-info">
					<li>联系我们：<a target="_blank"  href="baidu://message/?id=杨彦红_eileen">杨彦红</a> &nbsp;&nbsp;&nbsp;&nbsp; <a target="_blank"  href="baidu://message/?id=灰天熊">熊振</a></li>
				</div>    
			</div> 
			<div class="panel-footer">
				<button type="button" class="btn btn-primary" style="color: black;background-color: rgba(255, 255, 240, 0.05);margin-left: 20px;margin-top: 2px;" onclick="javascript:window.location.reload()">刷新</button>
			</div>
			<table id="task_monitor" class="table table-bordered table-striped table-hover" width="100%" style="text-align:left;font-size:12px;" > 
				<thead>
				<tr style="word-break:break-all;background-color:#d9edf7">
					<th>ID</th>
					<th>PID</th>
					<th>申请人</th>
					<th>引流类型</th>
					<th>引流目标地址</th>
					<th>引流目标端口</th>
					<th>引流开始时间</th>
					<th>引流时长</th>
					<th>引流结束时间</th>
					<th>FIFO</th>
					<th>Sent</th>
					<th>操作</th>
				</tr>
				</thead>
				<tbody style="font-size:12px">
				<?php
					foreach($info as $item) {
						echo "<tr>";
						$id = $item['id'];
						echo "<td>".$id."</td>";
						echo "<td>".$item['pid']."</td>";
						$name = $item['applicant'];
						echo "<td>".$name."</td>";
						$dtype = $item['dtype'];
						echo "<td>".$dtype."</td>";
						$dest = $item['destination'];
						echo "<td>".$dest."</td>";
						$port = $item['port'];
						echo "<td>".$port."</td>";
						$start_t = $item['start_t'];
						echo "<td>".$start_t."</td>";
						$hour = $item['dur_hour'];
						echo "<td>";
						if( $hour > 0 ) {
							echo $hour."小时";
						}
						echo $item['dur_minute']."分钟</td>";
						echo "<td>".$item['end_t']."</td>";
						$fifos = $item['fifos'];
						echo "<td><select id='select_fifo'>";
						foreach($fifos as $fifo) {
							echo "<option value='$fifo'>$fifo</opiton>";
						}
						echo "</select></td>";
						$sents = $item['sents'];
						echo "<td><select>";
						foreach($sents as $sent) {
							echo "<option value='$sent'>$sent</opiton>";
						}
						echo "</select></td>";
						echo "<td>";
						echo "<button class='btn-primary' type='button' onclick=\"javascript:window.location.href='?r=drainage/mail&id=$id&applicant=$name&dtype=$dtype&dest=$dest&port=$port&start=$start_t&fifo='+$('#select_fifo option:selected').val()\">邮件通知</button>";
						echo "</td>";
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
	$('#task_monitor').DataTable({
		"bSort":true,
		"bJQueryUI": true,
		"aaSorting":[[9, "desc"], [10, "desc"], [0, "asc"]],
		"bScrollCollapse": true,
		"aoColumnDefs": [
			{
				sDefaultContent: '',
				aTargets: [ '_all' ]
			}
		],                                 
	});
})();
</script>

