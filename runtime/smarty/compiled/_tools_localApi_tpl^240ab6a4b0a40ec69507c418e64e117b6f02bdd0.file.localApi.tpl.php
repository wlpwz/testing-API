<?php /* Smarty version Smarty 3.1.4, created on 2016-12-20 14:47:46
         compiled from "/home/work/ec_test_service/src/views/tools/localApi.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14009566445445c9abe0d4e2-70238017%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '240ab6a4b0a40ec69507c418e64e117b6f02bdd0' => 
    array (
      0 => '/home/work/ec_test_service/src/views/tools/localApi.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14009566445445c9abe0d4e2-70238017',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5445c9abe604a',
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5445c9abe604a')) {function content_5445c9abe604a($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'tools'));?>

<div class="container">
	<div class="row">
		<div style="margin-top:20px;margin-left:-50px">
			<?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

			<div class="col-md-10">

				<div class="head_line">
					<ul class="breadcrumb">
						<li><a href="/">首页</a></li>
						<li>实用工具</li>
						<li class="active">离线执行API</li>
					</ul>
				</div>

					<div class="panel panel-default">
						<div class="panel-heading">使用说明：</div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:15px">
							<tr>
								<td>执行方法：curl -d "new_code="$new_code"&old_code="$old_code"&thread_num="$thread_num"&ec_type=1&new_old_diff=0&new_diff=0&old_diff=0&memory=0<br>&speed=0&covfile="$covfile_path http://pat.baidu.com:8900/?r=run/jekensrunAPI</td>
							</tr>
							<tr>
								<td>执行实例：curl -d "new_code="ftp://cq01-testing-ps7121.vm.baidu.com:/home/work/liupan/test_liupan/test/env.tar.gz"&old_code="ftp://cq01-testing-ps7121.vm.baidu.com:/home/work/liupan/test_liupan/test/env.tar.gz"&thread_num=12&ec_type=1&new_old_diff=0&new_diff=0&old_diff=0&memory=<br/>0&speed=0&covfile=ftp://cq01-testing-ps7121.vm.baidu.com:/home/work/liupan/test_liupan/test/test.cov" http://pat.baidu.com:8900/?r=run/jekensrunAPI</td>
							</tr>
							<tr>
								<td><font color="red" font-size="14px">*注：</font>离线执行API仅适用于Jenkins离线执行方法；</td>
							</tr>
						</table>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">输入参数说明：</div>
						<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:15px"> 
							<tr>
								<th>参数</th><th>含义</th><th>例子</th>
							</tr>
							<tr>
								<td>new_code、old_code</td>
								<td>代码FTP地址</td>
								<td>见执行方法</td>
							</tr>
							<tr>
								<td>thread_num</td>
								<td>线程数</td>
								<td>填入数据应为整数</td>
							</tr>
							<tr>    
                                <td>ec_type</td>
                                <td>EC类型</td>
                                <td>0：中文&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1：国际化</td>
                            </tr>       
							<tr>
								<td>new_old_diff</td>
								<td>是否比较新旧版本DIFF</td>
								<td>0：否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1：是</td>
							</tr>
							<tr>
                                <td>new_diff</td>
                                <td>是否比较新版一致性DIFF</td>
                                <td>0：否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1：是</td>
                            </tr>
							<tr>
                                <td>old_diff</td>
                                <td>是否比较旧版一致性DIFF</td>
                                <td>0：否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1：是</td>
                            </tr>
							<tr>
                                <td>memory</td>
                                <td>是否进行物理内存使用统计</td>
                                <td>0：否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1：是</td>
                            </tr>
							<tr>
                                <td>speed</td>
                                <td>是否进行包处理速度统计</td>
                                <td>0：否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1：是</td>
                            </tr>
							<tr>
                                <td>covfile</td>
                                <td>统计覆盖率，覆盖率文件地址</td>
                                <td>见执行方法处</td>
                            </tr>
						</table>
					</div>
			</div>
		</div>
	</div>
</div>
<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<?php }} ?>