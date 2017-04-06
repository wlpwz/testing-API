<?php $map=['lostitem'=>'丢失项', 'newitem' => '新增项'];?>
<script type="text/javascript" charset="utf8" src="/static/js/jquery.min.js"></script>
<div class="container">

	<div class="row" data-spy="scroll" data-target="#myScrollspy">
		<div style="margin-top:20px;margin-left:-50px">
			<div class="col-md-2" id="myScrollspy">
				<div class="list-group">
					<B class="list-group-item " style="background-color:#F5F5F5">结果分析</B>
						<?php foreach($data as $dk => $dv){?>
							<a href="#<?php echo $dk;?>" class="list-group-item <?php if($dk==='lostitem') echo 'active';?>"><?php echo $map[$dk]?></a>
						<?php }?>
				</div>
			</div>
			<!-- end col-md-2  -->
			<div class="col-md-10">
				<form id='form1' <?php
					if(empty($data))
						echo "style=\"display:none\"";
					else
						echo "style=\"display:block\"";
					?>>
				<?php foreach($data as $dk => $dv){?>
				<div class="panel panel-info">	
    				<div class="panel-heading"><?php echo $map[$dk];?></div>
        			<table id=<?php echo $dk;?> class="show_table table table-bordered table-striped">
						<thead>
							<td width=15%>字段</td>
							<td width=10%>URL</td>
						</thead>
						
						<?php if(!empty($dv)){?>
						<tbody>
							<?php foreach($dv as $dd){?>
							<tr>
								<td><?php echo $dd[0];?></td>
								<td><?php echo $dd[1];?></td>
							</tr>
							<?php }?>
						</tbody>
						<?php }?>
					</table> 
				</div>
				<!-- end panel  -->
				<?php }?>
				</form>
			</div>
			<!-- end col-md-10  -->
		</div>
	</div>
</div>

<script language="javascript" src="/static/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
	var option = {
		"oLanguage" : {
		    "sInfoEmpty": "显示 0-0条记录，共 0 条数据",
		    "sInfo": "显示 _START_ - _END_条记录，共 _TOTAL_条数据",
		    "sSearch": "全文搜索:",
		    "sInfoFiltered": "(从 _MAX_ 条数据中过滤)",
		    "sProcessing" : "加载中...",
			"sLengthMenu": "每页显示 _MENU_ 条记录",
			"oPaginate": {
		    "sFirst": "第一页",
		    "sLast": "最后一页",
		    "sPrevious": "上一页",
		    "sNext": "下一页",
		    "sZeroRecords": "抱歉，没有找到数据"}},
		"sPaginationType": "full_numbers",
		"bProcessing": true,
		"bDestroy": true,
		"iDisplayLength": 10,
		"aaSorting": [[1, "desc"]]};

	$('a.list-group-item').bind('click', function(){
		$('a.list-group-item').removeClass('active');
		$(this).addClass('active');
	});
	//$('.show_table').dataTable(option);
});
</script>

