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
				        <li class="active">attr_modify词典推送工具</li>
					</ul>
				</div>

					<div class="panel panel-default">
						<div class="panel-heading"><i class="fa fa-star">attr_modify词典修改说明</i></div>
						<p>请点击右侧链接查看:<a href="http://wiki.baidu.com/pages/viewpage.action?pageId=186826575">attr_modify词典使用说明</a></p>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading"><i class="fa fa-star">attr_modify词典API推送步骤</i></div>
						<ul class="list_unstyled">
						<li>下载词典推送工具:ftp://cp01-qa-spider004.cp01.baidu.com/home/work/ec_test_service/script/dc_dict/pushdict.tar.gz</li>
							<ol>
							<li>执行download.sh:下载词典</li>
							<li>cd attr_modify目录修改词典</li>
							<li>执行upload.sh :词典校验机制通过后自动推送词典</li>
							  <ul><li>执行方式：sh upload.sh user reason</li><li>user:词典推送负责人(需要申请)</li><li>reason:词典修改原因</li></ul>
							</ol>
						</ul>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading"><i class="fa fa-star">attr_modify词典API推送准入申请</i></div>
						<p>需要增加用户和推送机器准入,准入机器必须安装ftp服务。联系<a target="_blank"  href="baidu://message/?id=杨彦红_eileen">杨彦红</a>设置词典白名单。</br>
						<strong>平台页面推送不需要申请：<a href="http://pat.baidu.com/?r=dictionary/index">平台页面推送</a></strong>
						</p>
					</div>
			</div>
		</div>
	</div>
</div>
{%$this->endContent()%}
