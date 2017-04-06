<?php /* Smarty version Smarty 3.1.4, created on 2016-12-20 14:47:42
         compiled from "/home/work/ec_test_service/src/views/tools/localDict1Api.tpl" */ ?>
<?php /*%%SmartyHeaderCode:157973139572182e61ca134-57948560%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9136ab51e5af8e17e9d224ae1daf028548c693cb' => 
    array (
      0 => '/home/work/ec_test_service/src/views/tools/localDict1Api.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157973139572182e61ca134-57948560',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_572182e62863d',
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_572182e62863d')) {function content_572182e62863d($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'tools'));?>

<div class="container">
	<div class="row">
		<div style="margin-top:20px;margin-left:-50px">
			<?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<?php }} ?>