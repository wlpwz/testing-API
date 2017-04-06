<?php /* Smarty version Smarty 3.1.4, created on 2016-12-20 14:47:42
         compiled from "/home/work/ec_test_service/src/views/tools/localDiffApi.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16145049915840e38bd15c48-36891202%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '66d9617eae092063f1b6fcad691f07724f2e992b' => 
    array (
      0 => '/home/work/ec_test_service/src/views/tools/localDiffApi.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16145049915840e38bd15c48-36891202',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5840e38bd486b',
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5840e38bd486b')) {function content_5840e38bd486b($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'tools'));?>

<div class="container">
	<div class="row">
		<div style="margin-top:20px;margin-left:-50px">
			<?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<?php }} ?>