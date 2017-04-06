<?php /* Smarty version Smarty 3.1.4, created on 2014-05-22 21:21:50
         compiled from "/home/work/project-ktv/src/views/layouts/column1.tpl" */ ?>
<?php /*%%SmartyHeaderCode:151435707653393fa338ad05-96718110%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3db2931dd0915904cd875c5640f1f6fa37ca5dbb' => 
    array (
      0 => '/home/work/project-ktv/src/views/layouts/column1.tpl',
      1 => 1400763177,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '151435707653393fa338ad05-96718110',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53393fa33a36e',
  'variables' => 
  array (
    'topic' => 0,
    'this' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53393fa33a36e')) {function content_53393fa33a36e($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('topic'=>$_smarty_tpl->tpl_vars['topic']->value));?>

    <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<?php }} ?>