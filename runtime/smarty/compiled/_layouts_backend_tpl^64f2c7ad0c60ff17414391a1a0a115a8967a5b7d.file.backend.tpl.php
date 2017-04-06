<?php /* Smarty version Smarty 3.1.4, created on 2014-03-29 09:39:58
         compiled from "/home/work/pop-b1/src/views/layouts/backend.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13086869425336246e767fa7-47748321%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64f2c7ad0c60ff17414391a1a0a115a8967a5b7d' => 
    array (
      0 => '/home/work/pop-b1/src/views/layouts/backend.tpl',
      1 => 1396055236,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13086869425336246e767fa7-47748321',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'this' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5336246e78a3f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5336246e78a3f')) {function content_5336246e78a3f($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'system'));?>

<!-- Content Part -->
      <!--=== Breadcrumbs ===-->
      <div class="margin-bottom-30"></div>
      <!--=== End Breadcrumbs ===-->

<div class="container">
      <!--=== Left navigation ===-->
      <div class="col-md-3">
				  <dl class="dl-group top-border">
              <dt class="dt-group-title">PIE平台风险监控</dt>   
              <dd class="dd-group-item"><a href="?r=backend/task">后台任务运行状况</a></dd>
          </dl>        	
			</div>
        <!--=== End Left navigation ===-->

				<!--=== Right content ===-->
				<div class="col-md-9">
						<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

				</div>
				<!--=== End Right content ===-->

</div>
<!-- End Content Part -->
<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<?php }} ?>