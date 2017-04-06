<?php /* Smarty version Smarty 3.1.4, created on 2014-08-15 13:41:34
         compiled from "/home/work/ec_test_service/src/views/tools/head.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24053213353ed9d8e624ed6-91903624%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0a29e86368310bd7939233ce450051828970bba' => 
    array (
      0 => '/home/work/ec_test_service/src/views/tools/head.tpl',
      1 => 1408078386,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24053213353ed9d8e624ed6-91903624',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53ed9d8e631d9',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ed9d8e631d9')) {function content_53ed9d8e631d9($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'tools'));?>

<div style="float: left;margin-left: 0px;margin-top: 20px;width: 15%;">
    <ul>
	<li><a href="?r=tools/index"style="font-size: 20px;" >内存统计</a></li>
    </ul>
    <ul>
	<li><a href="?r=tools/else" style="font-size: 20px;">待更新</a></li>
    </ul>
</div>
<?php }} ?>