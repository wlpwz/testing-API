{%$this->beginContent('/layouts/main', ['current'=>'tools'])%}
<div class="container">
	<div class="row">
		<div style="margin-top:20px;margin-left:-50px">
			{%include file="head.tpl"%}
			<div class="col-md-10">

				<div class="head_line">
					<ul class="breadcrumb">
						<li><a href="/">首页</a></li>
						<li>实用工具</li>
				        <li class="active">性能diff API</li>
					</ul>
				</div>

					<div class="panel panel-default">
						<div class="panel-heading">性能diff离线API使用说明</div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:13px">
							<tr>
								<td>执行方法:用curl "http://pat.baidu.com/?r=performance/diffAPI&参数"</td>
							</tr>
							<tr>
								<td>执行实例：curl "http://pat.baidu.com/?r=performance/diffAPI&task1_id=150&task2_id=152"</td>
							</tr>
							<tr>
								<td><font color="red" font-size="14px">*注：</font>此离线执行API可离线进行性能测试；</td>
							</tr>
						</table>
					</div>
			</div>
		</div>
	</div>
</div>
{%$this->endContent()%}
