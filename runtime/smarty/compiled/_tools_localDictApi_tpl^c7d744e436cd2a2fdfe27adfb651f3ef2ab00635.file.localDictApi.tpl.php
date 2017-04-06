<?php /* Smarty version Smarty 3.1.4, created on 2016-12-20 14:47:41
         compiled from "/home/work/ec_test_service/src/views/tools/localDictApi.tpl" */ ?>
<?php /*%%SmartyHeaderCode:142516466555826ed006d601-88660228%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c7d744e436cd2a2fdfe27adfb651f3ef2ab00635' => 
    array (
      0 => '/home/work/ec_test_service/src/views/tools/localDictApi.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '142516466555826ed006d601-88660228',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_55826ed00c15d',
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55826ed00c15d')) {function content_55826ed00c15d($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'tools'));?>

<div class="container">
	<div class="row">
		<div style="margin-top:20px;margin-left:-50px">
			<?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

			<div class="col-md-10">

				<div class="head_line">
					<ul class="breadcrumb">
						<li><a href="/">首页</a></li>
						<li>实用工具</li>
				        <li class="active">DC词典API</li>
					</ul>
				</div>

					<div class="panel panel-default">
						<div class="panel-heading">DC词典离线API使用说明</div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:13px">
							<tr>
								<td>执行方法:用curl "http://pat.baidu.com/?r=dictionary/dctestAPI&参数"</td>
							</tr>
							<tr>
								<td>执行实例：curl "http://pat.baidu.com/?r=dictionary/dctestAPI&language=0&method=0&newold=0&memory=1&speed=1&head=yangyanhong&reason="推送原因"&source=1:ftp://cq01-testing-ps7219.cq01.baidu.com/home/spider/dc/conf/page_weight&dictionary_name=page_weight"</td>
							</tr>
							<tr>
							<td>目前支持白名单配送的词典:dup_param,pattern,model_func,blacklist2_url,redir,alias,global_whitelist</td>
							</tr>
							<tr>
								<td><font color="red" font-size="14px">*注：</font>离线执行API仅适用于<font color="red">例行词典推送,上线部署效果需要词典推送方关注线上效果</font>,如果想使用此API需联系<a target="_blank"  href="baidu://message/?id=杨彦红_eileen">杨彦红</a>设置词典白名单；</td>
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
								<td>head</td>
								<td>负责人</td>
								<td>邮箱前缀</td>
							</tr>
							<tr>
								<td>source</td>
								<td>词典地址</td>
								<td>使用ftp地址方法</br>1:ftp://cq01-testing-ps7219.cq01.baidu.com/home/spider/dc/conf/page_weight</br>
								ftp路径最后一个目录就是词典的目录不要多加目录
								</td>
							</tr>
							<tr>    
                                <td>language</td>
                                <td>执行环境目前只支持中文</td>
                                <td>0：中文&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1：国际化</td>
                            </tr>       
							<tr>
								<td>newold</td>
								<td>是否比较新旧版本DIFF</td>
								<td>0：否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1：是</td>
							</tr>
							<tr>
                                <td>method</td>
                                <td>diff方式,目前只支持平台内部的数据diff</td>
                                <td>0：平台自主diff&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1：用户提供数据diff</td>
                            </tr>
							<tr>
                                <td>memory</td>
                                <td>是否进行物理内存使用统计,</br>默认是进行内存使用统计分析</td>
                                <td>0：否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1：是</td>
                            </tr>
							<tr>
                                <td>speed</td>
                                <td>是否进行包处理速度统计,</br>默认是进行内存使用统计分析</td>
                                <td>0：否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1：是</td>
                            </tr>
							<tr>
							    <td>dictionary_name</td>
								<td>词典名字</td>
								<td>使用方法</br>dictionary_name=推送词典的名字必须和线上词典名字一样</td>
							</tr>
						</table>
					</div>
			</div>
		</div>
	</div>
</div>
<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<?php }} ?>