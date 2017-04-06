<div class="wrapper">
	<section class="column full first">
		<h3>csedp回灌量监控</h3>
		<br/>
		<div class="controls-row">
			<div class="mr10" style="display:inline;">
				<input class="span2" id="keyword" type="text" value="">
			</div>
			<button class="btn btn-primary" type="button" id="search_btn">查询</button>
		</div>
		<div>
			<table class="table table-bordered table-striped table-hover valignM" id="site_search">
				<thead>
					<tr class="info">
						<th>bug创建时间</th>
						<th>标题</th>
						<th>处理状态</th>
						<th>bug解决时间</th>
						<th>问题来源</th>
						<th>icafe链接</th>
						<th>现象</th>
						<th>症状</th>
						<th>根因</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					{%foreach $bugs as $item%}
						<tr class=\"gradeA\">
							<td>{%$item['createdTime']%}</td>
							<td>{%$item['title']%}</td>
							<td style="background-color:{%if $item['status']=="待处理"%}red{%elseif $item['status']=="处理中"%}blue{%else%}#05ff0d{%/if%}">{%$item['status']%}</td>
							<td>{%$item['resolveTime']%}</td>
							<td>{%$item['src_from']%}</td>
							<td><a href="{%$item['icafe_url']%}" target=blank>详情</a></td>
							<td>{%$item['phenomenon']%}</td>
							<td>{%$item['symptom']%}</td>
							<td>{%$item['cause']%}</td>
							<td><button class="btn btn-mini btn-primary reset_btn_gray editor" type="button" item_id={%$item['sequence']%}>编辑</button></td>
						</tr>
					{%/foreach%}
				</tbody>
			</table>
		</div>
		<div class="pagination pagination-right" id="slidePage"></div>
	</section>
</div>
<div class="no-display" id="count">{%$count%}</div>
<div class="no-display" id="pagenum">{%$page%}</div>
<div class="no-display" id="pagesize">{%$pagesize%}</div>
<div class="no-display" id="offset">{%$offset%}</div>
<div class="no-display" id="orderflag">{%$seq%}</div>
<script type="text/javascript" src="static/js/bugs.js" charset="utf-8"></script>

