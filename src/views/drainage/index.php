<!--script src="/static/js/jquery.min.js"></script-->
<!--script src="/static/js/bootstrap.min.js"></script-->
<link rel="stylesheet" type="text/css" href="/static/plugins/dataTable/css/dataTables.bootstrap.css">
<style type="text/css"> 
#input_info table > tr > td:last-child {width : 90%}
select.num {margin-left:10px;width:90px;height:20px;}
select.text {margin-left:10px;width:150px;height:20px;}
</style>
<div class="container">
	<div class="row">
			<div class="col-md-10">
                <div class="head_line">
                    <ul class="breadcrumb">
                        <li>数据引流</li> 
                        <li class="active">引流任务申请</li> 
                    </ul>   
                </div> 
				<div class="panel panel-default">
					<div class="panel-heading">引流任务申请</div>
					<table id="input_info" class="table table-bordered" style="text-align:left;font-size:14px;">
						<tr>
							<td>引流时长</td>
							<td> 
								<select name="hour" id="drainage_hour" class="num">
									<?php
										for($i=0;$i<=24;$i++) {
											echo "<option value=\"$i\">$i</option>";
										}
									?>
                                </select>	
								<font>小时&nbsp;</font>
								<select name="minute" id="drainage_minute" class="num">
									<?php
										for($i=0;$i<60;$i++) {
											echo "<option value=\"$i\">$i</option>";
										}
									?>
                                </select>	
								<font>分钟&nbsp;</font>
							</td>
						</tr>
						<tr>
							<td>引流类型</td>
							<td> 
								<select name="type" id="drainage_type" class="text">
									<?php
										$tchs = parse_ini_file(CONFIG.'/drainage.ini', true)['type_channels'];
										foreach($tchs as $type => $chn) {
												echo "<option value=\"$type\">$type</option>";
										}
									?>
                                </select>	
								<i class="fa fa-question-circle" title="注：目前支持环上 cs->ec->dc->tf->lbdc->receiver tf->lcdc->linkcache 模块的引流"></i>
                                <!--code class="string" title="String">引流线上 2% 的流量</code-->
                                <code class="string" title="String">建议使用mimo接受引流数据，而不是nc</code>
							</td>
						</tr>
						<tr>
							<td>引流目标地址</td>
							<td> 
								<input type="text" id="drainage_dest" style="width:600px;height:20px;margin-left:10px;border: darkseagreen;border-bottom:2px solid #a9c6c9;">
							</td>
						</tr>
						<tr>
							<td>引流目标端口</td>
							<td> 
								<input type="text" id="drainage_port" style="width:600px;height:20px;margin-left:10px;border: darkseagreen;border-bottom:2px solid #a9c6c9;">
                                <!--code class="string" title="String">ftp路径最后一个目录就是词典的目录不要多加目录</code-->
							</td>
						</tr>
						<tr>
							<td style="color:red">提醒:右侧引流通道已中断</td>
							<?php
							echo "<td style='color:red'>".$break."</td>"
							?>
						</tr>
								<!--input type="radio" name="method" value="1">
								<div class="col-md-6" id="input_items">
										<div class="col-item">
											<span class="input-icon">
                                            	<input type="text" name="input_key" value="page_weight">
                                            </span>
											<span class="input-icon input-icon-right">
                                                <input type="text" name="input_value" value="*">
                                            </span>
                                                 <a href="javascript:;" class="add_input"><i class="fa fa-plus"></i></a>
                                         </div>
								</div-->
					</table>
					<div class="panel-footer">
						<button type="button" class="btn btn-primary" style="color: black;background-color: rgba(255, 255, 240, 0.05);margin-left: 200px;margin-top: 2px;" id="submit_task">提交任务</button>
						<button type="button" class="btn btn-primary" style="color: black;background-color: rgba(255, 255, 240, 0.05);margin-left: 50px;margin-top: 2px;" id="cancel_input">重新填写</button>
					</div>
				</div> 
				<!--div class="panel panel-default">
					<div class="panel-heading">引流任务展示</div-->
					<table id="result_info" class="table table-bordered table-striped table-hover" style="text-align:left;font-size:12px;">
						<thead>
						<tr style="word-break:break-all;background-color:#d9edf7">
							<th>ID</th>
							<th>申请人</th>
							<th>引流类型</th>
							<th>引流目标地址</th>
							<th>引流目标端口</th>
							<th>引流开始时间</th>
							<th>引流时长</th>
							<th>引流结束时间</th>
							<th>操作</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$cur_user = Yii::app()->user->name;
							$admins = parse_ini_file(CONFIG.'/drainage.ini', true)['role']['admin'];
							$is_admin = in_array($cur_user,	$admins);
							foreach($info as $item) {
								echo "<tr>";
								echo "<td>".$item['id']."</td>";
								echo "<td>".$item['applicant']."</td>";
								echo "<td>".$item['dtype']."</td>";
								echo "<td>".$item['destination']."</td>";
								echo "<td>".$item['port']."</td>";
								echo "<td>".$item['start_t']."</td>";
								$hour = $item['dur_hour'];
								echo "<td>";
								if( $hour > 0 ) {
									echo $hour."小时";
								}
								echo $item['dur_minute']."分钟</td>";
								echo "<td>".$item['end_t']."</td>";
								echo "<td>";
								if(strtotime($item['end_t']) < time()) {
									echo "stopped";
								}
								else {
									echo "<button ";
									if($cur_user != $item['applicant'] && ! $is_admin) {
										echo "disabled=\"disabled\" ";
									}
									echo "type=\"button\">stop</button>";
								}
								echo "</td>";
								echo "</tr>";
							}
						?>
						</tbody>
					</table>
					<!--/div>
				</div-->
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" charset="utf8" src="/static/plugins/dataTable/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="/static/plugins/dataTable/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" SRC="static/js/drainage.js"></script>
<script type="text/javascript">
(function(){
	$('#result_info').DataTable({
		"bSort":true,
		"aaSorting":[[8, "asc"], [5, "desc"], [0, "asc"]],
		"bJQueryUI": true,
	});
})();
</script>
