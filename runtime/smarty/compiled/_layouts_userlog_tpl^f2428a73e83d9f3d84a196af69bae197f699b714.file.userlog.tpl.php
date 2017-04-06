<?php /* Smarty version Smarty 3.1.4, created on 2014-03-31 18:12:53
         compiled from "/home/work/project-ktv/src/views/layouts/userlog.tpl" */ ?>
<?php /*%%SmartyHeaderCode:205489051853393fa554af18-56498723%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f2428a73e83d9f3d84a196af69bae197f699b714' => 
    array (
      0 => '/home/work/project-ktv/src/views/layouts/userlog.tpl',
      1 => 1396258456,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '205489051853393fa554af18-56498723',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'this' => 0,
    'se' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53393fa55aa2d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53393fa55aa2d')) {function content_53393fa55aa2d($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'target'));?>

<!-- Content Part -->
      <!--=== Breadcrumbs ===-->
      <div class="margin-bottom-40">
       <!--   <div class="container">
                 <h1 class="pull-left">用户访问指标</h1>  
                  <ul class="pull-right breadcrumb">
                  <li><a href="?r=site/index">首页</a></li>
                  <li><a href="">运营指标监控</a></li>
                  <li class="active">用户访问指标</li>
               </ul>
          </div>   -->
      </div>
      <!--=== End Breadcrumbs ===-->

<div class="container">
      <!--=== Left navigation ===-->
      <div class="col-md-3">
					<dl class="dl-group top-border">
							<dt class="dt-group-title">平台报告</dt>	
							<dd class="dd-group-item"><a href="?r=report/index&pid=<?php echo Yii::app()->platform->sePid;?>
">平台综合运营报告</a></dd>
					</dl>
                    <dl class="dl-group">            
                            <dt class="dt-group-title">用户访问指标</dt>  
                            <dd class="dd-group-item"><a href="?r=userlog/index&pid=<?php echo Yii::app()->platform->sePid;?>
">PV/UV统计</a></dd>
                    </dl>   
                    <?php if (Yii::app()->platform->sePid==1){?>
					<dl class="dl-group">
							<dt class="dt-group-title">PIE平台数据指标</dt>  
							<dd class="dd-group-item"><a href="?r=target/index&pid=<?php echo Yii::app()->platform->sePid;?>
">模板统计</a></dd>
							<dd class="dd-group-item"><a href="?r=target/tasks&pid=<?php echo Yii::app()->platform->sePid;?>
">任务统计</a></dd>
					</dl>
                    <?php }else{ ?>
				  <dl class="dl-group">
                            <dt class="dt-group-title">产品数据指标</dt>   
                            <dd class="dd-group-item"><a href="?r=product/index&pid=<?php echo Yii::app()->platform->sePid;?>
">指标监控报表</a></dd>
            <!--  <dd class="dd-group-item"><a href="?r=product/list">配置管理</a></dd>
			  <dd class="dd-group-item"><a href="?r=product/report">报表管理</a></dd>  -->
                 </dl> 	
                <?php }?>
          <!--  <ul class="list-group sidebar-nav-v1">
								<li class="list-group-item active">
										<a href="javascript:;">用户访问指标</a>
								</li>
                <li class="list-group-item active">
                    <span class="badge badge-green">New</span>
                    <a href="?r=userlog/index">PV/UV统计</a>
                </li>
                <li class="list-group-item <?php if ($_smarty_tpl->tpl_vars['se']->value==2){?>active<?php }?>">
                    <a href="?r=userlog/config">监控配置</a>
                </li>
            </ul>  -->
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