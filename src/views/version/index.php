<!--<link rel="stylesheet" type="text/css" href="/static/plugins/dataTable/css/dataTables.bootstrap.css">-->
<?php
    $this->beginContent('/layouts/main',['current'=>'version']);
?>
<div class="container">
<div class="row">
<div style="margin-top:20px;margin-left:-50px">

	<div class="col-md-2">
		<div class="list-group">
			<B class="list-group-item " style="background-color:#F5F5F5">版本管理</B>		
			<a href="#" class="list-group-item active">版本列表</a>
			<a href="index.php?r=version/add" class="list-group-item">增加版本项</a>
		</div>	
	</div>

	<div class="col-md-10">
		<div class="head_line">
                    <ul class="breadcrumb">
                        <li><a href="/">首页</a></li>
                        <li>版本管理</li>
                        <li class="active">版本列表</li>
                    </ul>
                </div>
		<table id="run_task" class="table table-bordered table-striped table-hover valignM" width="100%" style="font-size:14px;text-align:center">
			<thead> 
				<tr >    
					<th style="text-align:center">序号</th> 
					<th style="text-align:center">EC 版本号</th> 
					<th style="text-align:center">EC 类型</th> 
					<th style="text-align:center">Ecc 版本号</th> 
					<th style="text-align:center">Framework 版本号</th> 
					<th style="text-align:center">Pagevalue 版本号</th> 
		<!--			<th style="text-align:center">Is Splited</th>-->
					<th style="text-align:center">操作</th> 
				</tr>
			</thead>
			<tbody>
				<?php
							$count=1;
							foreach ($result as $run)
							{
								echo "<tr>";
								echo "<td>".$run['id']."</td>";
								echo "<td>".$run['version']."</td>";
								echo "<td>".$run['language']."</td>";
                                echo "<td>".$run['ecc_version']."</td>";
								echo "<td>".$run['framework_version']."</td>";
                                echo "<td>".$run['pagevalue_version']."</td>";
								
								echo '<td><a href="?r=version/modify&id='.$run['id'].'" title="编辑"><i class="fa fa-edit"></i></a> | <a cid='.$run['id'].' class="del-item" href="javascript:;" title="删除"><i class="fa fa-trash-o fa-lg"></i></a>
                                                                      </td>';
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
