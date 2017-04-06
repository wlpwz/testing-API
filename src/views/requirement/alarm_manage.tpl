<div class="wrapper"
	<section class="column full first">
		<h3>报警管理</h3>
		<div class="box box-info">
			<li>支持对监控项的启动和停止</li>
		</div>
		<div>
			<table class="table table-bordered table-striped table-hover valignM" id="alaram_table">
				<thead>
					<tr class="info">
						<th>监控项</th>
						<th>监控项名称</th>
						<th>监控说明</th>
						<th>短信通知</th>
						<th>邮件通知</th>
					</tr>
				</thead>
				<tbody>
					{%foreach $res as $item%}
						<tr>
							<td>{%$item['monitor_case']%}</td>
							<td>{%$item['name']%}</td>
							<td>{%$item['descript']%}</td>
							<td>
								<div id="msg_alarm_{%$item['id']%}" class="switch switch-mini has-switch">
									<input type="checkbox" {%if $item['msg_op'] eq 1 %}checked{%/if%}/>
								</div>
							</td>
							<td>
								<div id="email_alarm_{%$item['id']%}" class="switch switch-mini has-switch">
									<input type="checkbox" {%if $item['email_op'] eq 1%}checked{%/if%}/>
								</div>
							</td>
						</tr>
					{%/foreach%}
				</tbody>
			</table>
		</div>
	</section>
</div>
<script src="static/js/alarm_manage.js"></script>
