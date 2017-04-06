<div class="wrapper">
	<section class="column full first">
		<div class="controls-row">
            <h3>报警配置管理</h3>
		    <div class="box box-info">
			    <li>对报警的配置项进行管理，包括增加、删除、修改等操作。</li>
		    </div>
            <button class="btn btn-info" type="button" id="new_requirement">新建配置</button>
        </div>
		<div>
			<table class="table table-bordered table-striped table-hover valignM" id="warnconfig_set_table">
				<thead>
					<tr class="info">
						<th>id</th>
						<th>报警配置</th>
						<th>配置说明</th>
						<th>邮件列表</th>
						<th>短信列表</th>
                        <th width="12%">操作</th>
					</tr>
				</thead>
				<tbody>
					{%foreach $warnconfigset as $item%}
						<tr>
							<td>{%$item['id']%}</td>
							<td>{%$item['monitor_case']%}</td>
							<td>{%$item['descript']%}</td>
                            <td>{%$item['msg_list']%}</td>
							<td>{%$item['gmsg_list']%}</td>
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
<script type="text/javascript" src="static/js/warnconfigset.js" charset="utf-8"></script>
<script>
$('#warnconfig_set_table').dataTable({'bAutoWidth':false, 'aaSorting':[[0,'desc']]});
$(document).ready(function() {
    $('#new_requirement').click(function() {
        window.location.href="?r=requirement/addwarnconfigset";
    });
});
</script>
