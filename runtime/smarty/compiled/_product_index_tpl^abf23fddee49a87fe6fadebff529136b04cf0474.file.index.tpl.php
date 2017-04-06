<?php /* Smarty version Smarty 3.1.4, created on 2014-03-29 09:42:41
         compiled from "/home/work/pop-b1/src/views/product/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53129293753362511bdd251-04697182%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'abf23fddee49a87fe6fadebff529136b04cf0474' => 
    array (
      0 => '/home/work/pop-b1/src/views/product/index.tpl',
      1 => 1396055236,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53129293753362511bdd251-04697182',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'reports' => 0,
    'cid' => 0,
    'items' => 0,
    'describe' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53362511c2c34',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53362511c2c34')) {function content_53362511c2c34($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/work/pop-b1/src/vendors/Smarty/plugins/function.html_options.php';
?><!-- Right Content Part -->
   <div class="headline">
              <ul class="breadcrumb">
                  <li><a href="?r=product/index&id=<?php echo $_smarty_tpl->tpl_vars['config']->value->id;?>
">产品数据指标</a></li>
                  <li><a href="?r=product/index&id=<?php echo $_smarty_tpl->tpl_vars['config']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['config']->value->report_name;?>
</a></li>
                  <li class="active">监控数据</li>
               </ul>
    </div>

		<div id="summary">
				     <div class="col-md-10 index-box" style="padding-left:0px;">
        		<div class="sel-label">报表名称</div>
        					<div class="col-md-4 inline">
            					<select name="config_id" class="form-control" style="margin-bottom:5px;">
            						<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['reports']->value,'selected'=>$_smarty_tpl->tpl_vars['cid']->value),$_smarty_tpl);?>

            					</select>
        					</div>  
    				 </div>  

						 <div class="headline"><h5><i class="fa fa-table"></i>数据概况</h5></div>
						 <div id="summary_table">
						 </div>
		</div>

		<!-- Show Line With Echart  --!>
		<div class="headline"><h5><i class="fa fa-signal"></i>变化趋势</h5></div>
		<div class="time-bar alert-info">
        <span class="time-range time-selected" time_range="daily">天级数据</span>|
				<span class="time-range" time_range="weekly">周级数据</span>|
				<span class="time-range" time_range="monthly">月级数据</span>
    </div>  
		<div id="echart" style="width: 100%; height: 300px; border: 1px solid rgb(204, 204, 204); cursor: default;"></div>
		<!-- End Show Line With Echart  --!>

<div style="display:none;">
		<div id="items"><?php echo $_smarty_tpl->tpl_vars['items']->value;?>
</div>
		<div id="describe"><?php echo $_smarty_tpl->tpl_vars['describe']->value;?>
</div>
</div>
<!-- End Right Content Part -->
<script src="static/echarts/src/asset/js/esl/esl.js"></script>
<script src="static/js/echarts_line.js"></script>
<script type="text/javascript" src="static/js/product_index.js"></script>
<?php }} ?>