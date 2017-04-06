<?php /* Smarty version Smarty 3.1.4, created on 2016-12-19 19:08:04
         compiled from "/home/work/ec_test_service/src/views/performance/detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14368337905735aea1be2367-35492704%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '31552fb8bd0097d4e8b32b8dd53e6a28703f1f42' => 
    array (
      0 => '/home/work/ec_test_service/src/views/performance/detail.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14368337905735aea1be2367-35492704',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5735aea1c6e7b',
  'variables' => 
  array (
    'task_name' => 0,
    'performances' => 0,
    'performance' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5735aea1c6e7b')) {function content_5735aea1c6e7b($_smarty_tpl) {?><script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">
</script>

<div class="container">
	<div class="row" >
		<div style="margin-top:20px;">
			<div class="col-md-10">
				<div class="head_line">
   					<ul class="breadcrumb">
						<li><a href="index.php?r=dictionary/task">词典测试任务列表</a></li>
      					<li>词典测试任务详情</li> 
     		 			<li class="active">任务概况</li> 
   					</ul>   
				</div> 
				<h4>任务名称:<?php echo $_smarty_tpl->tpl_vars['task_name']->value;?>
</h4>
				<div class="panel panel-default" id="summery">
				    <div class="panel-heading">性能概况</div>
					<div class="panel-body" style="overflow:auto;">
					<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:14px;">
					<tr>
                    <?php  $_smarty_tpl->tpl_vars['performance'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['performance']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['performances']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['performance']->key => $_smarty_tpl->tpl_vars['performance']->value){
$_smarty_tpl->tpl_vars['performance']->_loop = true;
?>
					    <th colspan="3" role="key-list" style="text-align:center;"><?php echo $_smarty_tpl->tpl_vars['performance']->key;?>
</th>
                    <?php } ?>
					</tr>
					<tr>
					<?php  $_smarty_tpl->tpl_vars['performance'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['performance']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['performances']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['performance']->key => $_smarty_tpl->tpl_vars['performance']->value){
$_smarty_tpl->tpl_vars['performance']->_loop = true;
?>
					    <?php  $_smarty_tpl->tpl_vars['summary'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['summary']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['performance']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['summary']->key => $_smarty_tpl->tpl_vars['summary']->value){
$_smarty_tpl->tpl_vars['summary']->_loop = true;
?>
						<td align="center"><?php echo $_smarty_tpl->tpl_vars['summary']->key;?>
</td>
                        <?php } ?>
                    <?php } ?>
					</tr>
					<tr>
					<?php  $_smarty_tpl->tpl_vars['performance'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['performance']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['performances']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['performance']->key => $_smarty_tpl->tpl_vars['performance']->value){
$_smarty_tpl->tpl_vars['performance']->_loop = true;
?>
					    <?php  $_smarty_tpl->tpl_vars['summary'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['summary']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['performance']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['summary']->key => $_smarty_tpl->tpl_vars['summary']->value){
$_smarty_tpl->tpl_vars['summary']->_loop = true;
?>
						<td align="center"><?php echo $_smarty_tpl->tpl_vars['summary']->value;?>
</td>
                        <?php } ?>
                    <?php } ?>
					</tr>
					</table>
					</div>
				</div>
					
				<div id="performance">
					<?php echo $_smarty_tpl->getSubTemplate ("performnacedetail.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

				</div>
			</div>
			<!--END RIGHT CONTENT-->
		</div>
	</div>
</div>

<?php }} ?>