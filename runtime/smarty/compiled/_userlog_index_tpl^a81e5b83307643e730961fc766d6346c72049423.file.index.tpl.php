<?php /* Smarty version Smarty 3.1.4, created on 2014-03-31 18:12:53
         compiled from "/home/work/project-ktv/src/views/userlog/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:41898845253393fa550e771-56875641%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a81e5b83307643e730961fc766d6346c72049423' => 
    array (
      0 => '/home/work/project-ktv/src/views/userlog/index.tpl',
      1 => 1396258456,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '41898845253393fa550e771-56875641',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'items' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53393fa5540b7',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53393fa5540b7')) {function content_53393fa5540b7($_smarty_tpl) {?><!-- Right Content Part -->
		<div class="headline">
		     <ul class="breadcrumb">
                  <li><a href="?r=userlog/index">用户访问指标</a></li>
									<li><a href="?r=userlog/index">PV/UV统计</a></li>
                  <li class="active">数据概况</li> 
         </ul>
		</div>
		<div class="col-md-10 index-box" style="padding-left:0px;">
				<div class="sel-label">过滤规则</div>
				<div class="col-md-3 inline" id="userlog_items"></div>
		</div>
		<div id="summary"></div>

		<!-- Show Line With Echart  --!>
		<div class="time-bar alert-info">
         <span class="time-range time-selected" time_range="daily">天级数据</span>|
				 <span class="time-range" time_range="weekly">周级数据</span>|
				 <span class="time-range" time_range="monthly">月级数据</span>
    </div>
		<div class="col-md-9">
          <span><input type="radio" name="data_type" value="pv" checked>浏览量PV(均)</span>
          <span class="mar5"><input type="radio" name="data_type" value="all_uv">访客量UV</span>
					<span class="mar5"><input type="radio" name="data_type" value="new_uv">新增访客量UV</span>
    </div>
		<div id="echart" style="width: 100%; height: 300px; border: 1px solid rgb(204, 204, 204); cursor: default;"></div>
		<!-- End Show Line With Echart  --!>

<div style="display:none;">
		<div id="items"><?php echo $_smarty_tpl->tpl_vars['items']->value;?>
</div>
</div>
<!-- End Right Content Part -->
<script src="static/echarts/src/asset/js/esl/esl.js"></script>
<script src="static/js/echarts_line.js"></script>
<script type="text/javascript" src="static/js/userlog_index.js"></script>
<?php }} ?>