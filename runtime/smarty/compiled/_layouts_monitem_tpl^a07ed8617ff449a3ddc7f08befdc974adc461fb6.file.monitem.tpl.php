<?php /* Smarty version Smarty 3.1.4, created on 2014-03-30 13:58:55
         compiled from "/home/work/pop-b1/src/views/layouts/monitem.tpl" */ ?>
<?php /*%%SmartyHeaderCode:997590389533624726d9984-73913331%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a07ed8617ff449a3ddc7f08befdc974adc461fb6' => 
    array (
      0 => '/home/work/pop-b1/src/views/layouts/monitem.tpl',
      1 => 1396159130,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '997590389533624726d9984-73913331',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_533624726fc83',
  'variables' => 
  array (
    'this' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_533624726fc83')) {function content_533624726fc83($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'monitem'));?>

<!-- Content Part -->
      <!--=== Breadcrumbs ===-->
      <div class="margin-bottom-30"></div>
      <!--=== End Breadcrumbs ===-->

<div class="container">
      <!--=== Left navigation ===-->
      <div class="col-md-3">
		  <dl class="dl-group top-border">
              <dt class="dt-group-title">监控项管理</dt>   
              <dd class="dd-group-item"><a href="?r=monitem/list">平台监控项</a></dd>
              <dd class="dd-group-item"><a href="?r=userlog/config&pid=<?php echo Yii::app()->platform->sePid;?>
">PV/UV监控配置管理</a></dd>
          </dl>    
          <dl class="dl-group top-border">
              <dt class="dt-group-title">产品数据指标管理</dt>   
              <dd class="dd-group-item"><a href="?r=product/list&pid=<?php echo Yii::app()->platform->sePid;?>
">指标监控项管理</a></dd>
              <dd class="dd-group-item"><a href="?r=product/report&pid=<?php echo Yii::app()->platform->sePid;?>
">指标报表管理</a></dd>
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