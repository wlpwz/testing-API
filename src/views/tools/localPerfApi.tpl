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
				        <li class="active">性能API</li>
					</ul>
				</div>

					<div class="panel panel-default">
						<div class="panel-heading">性能离线API使用说明</div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:13px">
							<tr>
								<td>执行方法:用curl "http://pat.baidu.com/?r=performance/API&参数"</td>
							</tr>
							<tr>
								<td>执行实例：curl "http://pat.baidu.com/?r=performance/API&task_name=testtask&data_user=liuwenli&comment=testcomment&data_method=ps_method&data_path=ftp://cq01-testing-ps7228.cq01.baidu.com/home/spider/wangweiwei12/code/ps/spider/index-dispatcher/i18n_ec_frmwork.log&data_path_qps=ftp://cq01-testing-ps7231.cq01.baidu.com/home/spider/shy/Tools/out_ec2_16"</td>
							</tr>
							<tr>
								<td><font color="red" font-size="14px">*注：</font>此离线执行API可离线进行性能测试；</td>
							</tr>
						</table>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">输入参数说明：</div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:13px"> 
							<tr>
								<th>参数</th><th>含义</th><th>例子</th>
							</tr>
							<tr>
								<td>task_name</td>
								<td>任务名称</td>
								<td>提交任务的名称</td>
							</tr>
							<tr>
								<td>data_path</td>
								<td>mem&cpu性能指标地址</td>
								<td>填写mem&cpu性能指标的ftp地址（如果没有可省略）如：</br>ftp://cq01-testing-ps7228.cq01.baidu.com/home/spider/wangweiwei12/code/ps/spider/index-dispatcher/i18n_ec_frmwork.log</td>
							</tr>
							<tr>
								<td>data_path_qps</td>
								<td>qps性能指标地址</td>
								<td>填写qps性能指标的ftp地址（如果没有可省略）如：</br>ftp://cq01-testing-ps7231.cq01.baidu.com/home/spider/shy/Tools/out_ec2_16</td>
							</tr>
							<tr>    
                                <td>data_user</td>
                                <td>负责人</td>
                                <td>邮箱前缀</td>
                            </tr>       
							<tr>
								<td>data_method</td>
								<td>获取性能指标的方法</td>
								<td>ps_method或top_method</td>
							</tr>
							<tr>
                                <td>comment</td>
                                <td>备注</td>
                                <td></td>
                            </tr>
						</table>
					</div>
			</div>
		</div>
	</div>
</div>
{%$this->endContent()%}
