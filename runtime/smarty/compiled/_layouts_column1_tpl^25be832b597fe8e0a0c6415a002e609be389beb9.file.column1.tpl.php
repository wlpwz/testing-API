<?php /* Smarty version Smarty 3.1.4, created on 2016-12-19 18:44:31
         compiled from "/home/work/ec_test_service/src/views/layouts/column1.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1400544233537e07507fe347-52568889%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '25be832b597fe8e0a0c6415a002e609be389beb9' => 
    array (
      0 => '/home/work/ec_test_service/src/views/layouts/column1.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1400544233537e07507fe347-52568889',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_537e075080d9f',
  'variables' => 
  array (
    'topic' => 0,
    'this' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_537e075080d9f')) {function content_537e075080d9f($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('topic'=>$_smarty_tpl->tpl_vars['topic']->value));?>

    <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<?php }} ?>