<?php
    $this->beginContent('/layouts/main',['current'=>'ecTask']);
?>
<!--<link rel="stylesheet" type="text/css" href="/static/plugins/dataTable/css/dataTables.bootstrap.css">-->
<div class="container">
	<div class="row">
		<div style="margin-top:20px;margin-left:-50px">
			<div class="col-md-2">
				<div class="list-group">
					<B class="list-group-item " style="background-color:#F5F5F5">在线运行日志</B>
            		<a href="?r=run/showLog&task_id=<?php echo "$task_id"?>" class="list-group-item ">日志</a>
            		<a href="#" class="list-group-item active">ERR</a>
              
             
			
            	</div>	
			</div>
			<div class="col-md-10">
				<div class="head_line">
                    <ul class="breadcrumb">
                        <li><a href="/">首页</a></li>
                        <li><a href="?r=ecTask/runmission">在线运行任务列表</a></li>
                        <li class="active">在线运行ERR日志</li>
                    </ul>
                </div>
					<pre style="background-color:white">
						<?php
							$str=explode("\n",$err);
							$len=count($str)-1;							
							for($i=0;$i<$len;$i=$i+1)
							{
								echo "<p>".$str[$i]."</p>";
							}
						?>
					</pre>
				 </table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" charset="utf8" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="/static/plugins/dataTable/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="/static/plugins/dataTable/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
/*(function(){
    $('#run_log').DataTable({"iDisplayLength": 20,
								"lengthChange": false,
								"bScrollCollapse": true,
								"bSort": false,
								"bJQueryUI": true,
								"bPaginate": true,
																 
							});*/
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
<?php $this->endContent(); ?>~                              
