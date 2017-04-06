<!--<link rel="stylesheet" type="text/css" href="/static/plugins/dataTable/css/dataTables.bootstrap.css">-->
<?php
    $this->beginContent('/layouts/main',['current'=>'dictionary']);
?>
<div class="container">
<div class="row">
<div style="margin-top:20px;margin-left:-50px">

	<div class="col-md-2">
       <?php include 'right.php';?>
	</div>

	<div class="col-md-10">
		<div class="head_line">
                    <ul class="breadcrumb">
                        <li><a href="/">首页</a></li>
                        <li><a href="?r=dictionary/index">词典测试</a></li>
                        <li class="active">中文词典</li>
                        <li class="active">Model_func词典</li>
                    </ul>
                </div>
		<table id="run_task" class="table table-bordered table-striped table-hover valignM" width="100%" style="font-size:12px;text-align:center">
			<thead> 
				<tr >    
					<th style="text-align:center">任务号</th> 
					<th style="text-align:center">文件名称</th> 
					<th style="text-align:center">上线时间</th> 
					<th style="text-align:center">部署路径</th>
					<th style="text-align:center">描述</th> 
					<th style="text-align:center">词典地址</th> 
					<th style="text-align:center">sandbox_noahid</th> 
					<th style="text-align:center">online_noahid</th> 
				</tr>
			</thead>
			<tbody>
				<?php
							$count=1;
							foreach ($result as $run)
							{
								echo "<tr>";
								echo "<td>".$run['task_id']."</td>";
								echo "<td>".$run['name']."</td>";
								echo "<td>".$run['time']."</td>";
								echo "<td>".$run['path']."</td>";
                                echo "<td>".$run['distribute']."</td>";
								echo "<td>".$run['ftp']."</td>";
								echo "<td>".$run['noah_id']."</td>";
								echo "<td>".$run['noah_id_online']."</td>";
								
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
    
    
    $('.del-item').bind('click', function()
    {
        if(confirm("数据删除后将不可恢复，请确认是否继续?")) 
        {
            var id = $(this).attr("cid");
            var url = "?r=version/delete&id="+id;
            
            $.get(url, function(ajaxObj)
            {
                var obj = eval("[" + ajaxObj + "]");
                var data = obj[0];

                if(data.status == 1)
                {
                    alert("删除成功"); 
                    window.location.reload();
                }else{
                    alert("删除失败，请稍后重试！"); 
                }
            });
        }
    });

	    
})();
</script>
<?php $this->endContent(); ?>
