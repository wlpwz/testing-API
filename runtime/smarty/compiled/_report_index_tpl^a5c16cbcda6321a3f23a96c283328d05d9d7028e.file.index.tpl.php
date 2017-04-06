<?php /* Smarty version Smarty 3.1.4, created on 2014-03-30 06:41:15
         compiled from "/home/work/pop-b1/src/views/report/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13235211405336ca53281e35-46583809%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a5c16cbcda6321a3f23a96c283328d05d9d7028e' => 
    array (
      0 => '/home/work/pop-b1/src/views/report/index.tpl',
      1 => 1396132872,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13235211405336ca53281e35-46583809',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5336ca532ffba',
  'variables' => 
  array (
    'pid' => 0,
    'report' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5336ca532ffba')) {function content_5336ca532ffba($_smarty_tpl) {?>
<!-- Right Content Part -->
						<div class="headline">
         			<ul class="breadcrumb">
                  <li><a href="?r=report/index&pid=<?php echo $_smarty_tpl->tpl_vars['pid']->value;?>
">
                            <h5><i class="fa fa-table"></i>平台综合运营报告</h5>
                    </a></li>
               <!--   <li><a href="?r=report/index&pid=<?php echo $_smarty_tpl->tpl_vars['pid']->value;?>
">-</a></li>
                  <li class="active">-</li>   -->
        			 </ul>   
    				</div> 					
                   <!--     <h5><i class="fa fa-table"></i>平台综合运营报告</h5>  -->
                    <div class="myReport">
                         <div id="finalScore"></div>
                         <p>1.页面性能评估</p>
                         <div id="uaq_report"></div>
                         <p>2.用户访问情况</p>
                         <div id="userlog_report"></div>
                         <p>3.产品指标情况</p>
                         <div id="product_report"></div>
                         <p>4.系统漏洞检测</p>
                          <div id="scan_report">暂无数据</div>
                    </div>
<div style="display:none;">
    <div id="uaq"><?php echo @htmlspecialchars($_smarty_tpl->tpl_vars['report']->value->uaq, ENT_QUOTES, 'UTF-8', true);?>
</div>
    <div id="product"><?php echo $_smarty_tpl->tpl_vars['report']->value->product;?>
</div>
    <div id="userlog"><?php echo $_smarty_tpl->tpl_vars['report']->value->userlog;?>
</div>
</div>
<script type="text/javascript" src="static/js/report_index.js"></script>
<!-- End Right Content Part -->



<?php }} ?>