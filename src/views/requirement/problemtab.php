<link href="static/echarts/src/asset/css/bootstrap-responsive.css" rel="stylesheet"/>
<div id="page">
		<!-- Wrapper -->
		<div class="wrapper">
			<!-- Left column/section -->
      <ul class="nav nav-tabs">
        <li class="active"><a href="?r=requirement/problemtab">问题列表</a></li>
        <li><a href="?r=requirement/problempic" >图表分析</a></li>
      </ul>
			<section class="column width4 first">
				<br/>
				<input id="add_case" class="btn btn-blue big" value="提交新case"/>
			</section>
			<section class="column full first">
				<table class="table table-bordered table-striped table-hover" id="case_list">
					<thead class="info">
						<th width="40">ID</th>
						<th width="240">问题描述</th>
						<th width="80">发生日期</th>
						<th width="80">分类</th>
						<th width="80">负责人</th>
						<th width="80">状态</th>
						<th>结论</th>
						<th width="60">操作</th>
					</thead>
					<tbody>
						<?php
							$stateList = array(1=>"新建", 2=>"跟进中", 3=>"已解决");
							foreach($caseList as $case) {
								echo "<tr>";
								echo "<td>" . $case->id . "</td>";
								echo "<td>" . str_replace("\r\n", "<br/>", substr($case->description, 0, 240)) . "</td>";
								echo "<td>" . $case->case_day . "</td>";
								echo "<td>" . $case->category. "</td>";
								echo "<td>" . $case->owner . "</td>";
								echo "<td>" . $stateList[$case->state] . "</td>";
								echo "<td>" . str_replace("\r\n", "<br/>", $case->conclusion) . "</td>";
								echo "<td><a href='index.php?r=requirement/modify&id=" . $case->id . "'>编辑</a></td>";
								echo "</tr>";
							}
						?>
					</tbody>
				</table>
			</section>
		</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		/* setup navigation, content boxes, etc... */
		Administry.setup();
		$('#case_list').dataTable({'bAutoWidth':false, 'aaSorting':[[0,'desc']]});

		$('#add_case').click(function() {
			window.location.href="index.php?r=requirement/add2";
		});

	});
</script>
