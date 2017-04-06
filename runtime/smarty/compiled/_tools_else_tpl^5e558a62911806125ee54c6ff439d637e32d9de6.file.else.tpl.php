<?php /* Smarty version Smarty 3.1.4, created on 2014-08-15 13:41:34
         compiled from "/home/work/ec_test_service/src/views/tools/else.tpl" */ ?>
<?php /*%%SmartyHeaderCode:170461193453ed9d8e606395-43968673%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e558a62911806125ee54c6ff439d637e32d9de6' => 
    array (
      0 => '/home/work/ec_test_service/src/views/tools/else.tpl',
      1 => 1408078386,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '170461193453ed9d8e606395-43968673',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53ed9d8e621d7',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ed9d8e621d7')) {function content_53ed9d8e621d7($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div style="float:right;">
 test
</div>

<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<?php }} ?>