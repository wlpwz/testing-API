<div id="page">
		<!-- Wrapper -->
		<div class="wrapper">
			<!-- Left column/section -->
			<section class="column width4 first">
				<h5>提交问题:</h5><hr/>
				<form id="add_case" method="post" action="index.php?r=requirement/add2">
					<label class="required" for="desc">问题描述:</label></br>
					<textarea id="desc" class="medium full" name="description" required="required"></textarea><br/>
					<label class="required" for="case_day">发生日期:</label></br>
					<input type="text" class="half" id="case_day" name="case_day" required="required"/><br/>
					<label class="required" for="category">分类:</label></br>
					<input type="text" class="half" id="category" name="category" required="required"/><br/>
					<label class="required" for="owner">负责人:</label></br>
					<input type="text" class="half" id="owner" name="owner" required="required"/><br/>
					<label class="required" for="state">状态:</label></br>
					<select id="state" name="state">
						<option value="1">新建</option>
						<option value="2">跟进中</option>
					</select><br/><br/>
					<input id="submit" type="submit" class="btn btn-blue" style="width:100px;height:40px;" value="提交">
				</form>
				<br/>
			</section>
		</div>
</div>

<script type="text/javascript">
		$(document).ready(function(){
			/* setup navigation, content boxes, etc... */
			Administry.setup();

		});
</script> 
