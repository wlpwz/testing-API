<!--script src="/static/js/jquery.min.js"></script-->
<!--script src="/static/js/bootstrap.min.js"></script-->
<div class="container">
	<div class="row">
			<div class="col-md-10">
                <div class="head_line">
                    <ul class="breadcrumb">
                        <li>性能平台</li> 
                        <li class="active">任务性能比较页面</li> 
                    </ul>   
                </div>
				<div class="panel panel-default">
					<div class="panel-heading">任务性能比较</div></br>
						<form action="?r=performance/diffsubmit" method="post">
							<font>&nbsp&nbsp&nbsp新版本任务的id号</font>
							<input type="text" name="task1_id" placeholder="task1_id"></br></br>
							<font>&nbsp&nbsp&nbsp旧版本任务的id号</font>
							<input type="text" name="task2_id" placeholder="task2_id"></br></br>
							<font>&nbsp&nbsp&nbsp</font>
							<input type="submit" value="任务提交">
						</form>	
				</div>
				
			</div>
	</div>
</div>



