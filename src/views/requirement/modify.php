<div id="page">
		<!-- Wrapper -->
		<div class="wrapper">
			<!-- Left column/section -->
			<section class="column width4 first">
				<h5>更新问题:</h5><hr/>
				<form id="modify_case" method="post" action="index.php?r=requirement/modify2&id=<?php echo $case->id; ?>">
					<label class="required" for="desc">问题描述:</label><br>
					<textarea id="desc" class="medium full" name="description" required="required" disabled="disabled"><?php echo $case->description; ?></textarea><br/>
					<label class="required" for="day">发生日期:</label><br>
					<input type="text" class="half" id="day" name="case_day" required="required" value="<?php echo $case->case_day; ?>"/><br/>
					<label class="required" for="category">分类:</label><br>
					<input type="text" class="half" id="category" name="category" required="required" value="<?php echo $case->category; ?>"><br>
					<small>已有分类:<font color="blue">
						<?php
							foreach($categoryList as $c) {
								echo "{$c->category} | ";
							}
						?>
					</font></small><br><br>
					<label class="required" for="owner">负责人:</label><br>
					<input type="text" class="half" id="owner" name="owner" required="required" value="<?php echo $case->owner; ?>"/><br/>
					<label class="required" for="state">状态:</label><br>
					<select id="state" name="state">
						<?php
							$stateList = array(1=>"新建", 2=>"跟进中", 3=>"已解决");
							for($i = 1; $i <=3; $i++) {
								if($case->state == $i) {
									echo "<option selected='true' value='$i'>" . $stateList[$i] . "</option>";
								} else {
									echo "<option value='$i'>" . $stateList[$i] . "</option>";
								}
							}
						?>
					</select><br>
					<label class="required" for="conclusion">问题结论:</label><br>
					<textarea id="conclusion" class="medium full" name="conclusion" required="required"><?php echo $case->conclusion; ?></textarea><br><br>
					<input id="submit" type="submit" class="btn btn-green" style="width:100px;height:40px;" value="更新">
				</form>
				<br>
			</section>
		</div>
</div>

<script type="text/javascript">
		$(document).ready(function(){
			/* setup navigation, content boxes, etc... */
			Administry.setup();

		});
</script> 
