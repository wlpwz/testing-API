<div class="wrapper">
	<section class="column full first">
		<div class="controls-row">
            <h3>监控项管理</h3>
		    <div class="box box-info">
			    <li>对监控case进行配置管理，包括增加、删除、修改。</li>
		    </div>
            <button class="btn btn-info" type="button" id="new_requirement">新建配置</button>
        </div>
		<div>
			<table class="table table-bordered table-striped table-hover valignM" id="case_set_table">
				<thead>
					<tr class="info">
						<th width="5%">id</th>
						<th>case名称</th>
						<th>case描述</th>
						<th>报警配置</th>
						<th>url</th>
                        <th>当前状态</th>
                        <th>上次检查时间</th>
                        <th width="12%">操作</th>
					</tr>
				</thead>
				<tbody>
					{%foreach $caseset as $item%}
						<tr>
							<td>{%$item['id']%}</td>
							<td>{%$item['case_name']%}</td>
							<td>{%$item['descript']%}</td>
                            <td>{%$item['monitor_case']%}</td>
							<td><a href="{%$item['url']%}" target="_blank">{%$item['url']%}</a></td>
                            {%if $item['status'] == "danger"%}
                                <td style="color:red;font-weight:bold">异常</td>
                            {%else%}
                                <td style="color:green;font-weight:bold">正常</td>
                            {%/if%}
                            {%if $item['last_check_time'] == "0"%}
                                <td>未生效</td>
                            {%else%}
                                <td>{%$item['last_check_time']|date_format:"%Y-%m-%d %H:%M:%S"%}</td>
                            {%/if%}
							<td>
                                <button class="btn btn-mini btn-primary reset_btn_gray editor" type="button" item_id="{%$item['id']%}">编辑</button>
                                &nbsp;
                                <button class="btn-mini btn-danger remove" type="button" item_id="{%$item['id']%}">删除</button>
							</td>
						</tr>
					{%/foreach%}
				</tbody>
			</table>
		</div>
	</section>
</div>
<script type="text/javascript" src="static/js/caseset.js" charset="utf-8"></script>
<script>
$('#case_set_table').dataTable({'bAutoWidth':false, 'aaSorting':[[5,'asc']]});
$(document).ready(function() {
    $('#new_requirement').click(function() {
        window.location.href="?r=requirement/addcaseset";
    });
});
</script>
