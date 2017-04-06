<?php /* Smarty version Smarty 3.1.4, created on 2016-12-27 12:01:33
         compiled from "/home/work/ec_test_service/src/views/requirement/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1006482263554c9125e62fc8-93719299%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '14e0717a1a0895b4b548c00df16b069943f470e1' => 
    array (
      0 => '/home/work/ec_test_service/src/views/requirement/list.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1006482263554c9125e62fc8-93719299',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_554c912626f10',
  'variables' => 
  array (
    'keyword' => 0,
    'list' => 0,
    'item' => 0,
    'categoryList' => 0,
    'bgColorList' => 0,
    'stateList' => 0,
    'count' => 0,
    'page' => 0,
    'pagesize' => 0,
    'offset' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_554c912626f10')) {function content_554c912626f10($_smarty_tpl) {?><!--<script type="text/javascript" src="static/js/c2c_item_list.js" charset="utf-8"></script>-->
<!DOCTYPE html>
<html>
<head>
   <meta name="baidu-site-verification" content="KjBF2DaOFs" />
    <meta name="baidu-site-verification" content="6fe46ef19124bf1cc8731cd245615644"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>DATA-SAFE需求管理</title>
    <link rel="shortcut icon" href="static/css/sitemap/images/favicon.png"> 
    <!--add for waterfall view-->
    <link rel="stylesheet" href="static/css/sitemap/reset.css" type="text/css" charset="utf-8"> 
    <link rel="stylesheet" href="static/css/sitemap/global.css" type="text/css" charset="utf-8"> 
    <link rel="stylesheet" href="static/css/sitemap/home.css" type="text/css" charset="utf-8">
   <link rel="stylesheet" href="static/lib/dialog/dialog.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="static/lib/My97DatePicker/skin/WdatePicker.css" type="text/css" charset="utf-8"> 
    <link rel="stylesheet" href="static/css/sitemap/style.css" type="text/css" />
    <link rel="stylesheet" href="static/css/sitemap/jquery.visualize.css" type="text/css">
    <!-- Your Custom Stylesheet --> 
    <link rel="stylesheet" href="static/css/sitemap/custom.css" type="text/css" />
    <link rel="stylesheet" href="static/css/sitemap/sc-sitemap.css" type="text/css" />

    <link rel="stylesheet" href="static/css/sitemap/nav_left.css" type="text/css" charset="utf-8"/>
    
    <link rel="stylesheet" href="static/css/sitemap/bootstrapSwitch.css" type="text/css"/>
<!--    <script language="javascript" src="static/js/jquery-1.7.2.min.js"></script> -->
    <script language="javascript" src="static/lib/Base.js"></script>
    <script language="javascript" src="static/lib/underscore.js"></script>
<!--    <script language="javascript" src="static/lib/backbone.js"></script>  -->
    <script language="javascript" src="static/lib/dialog/dialog.js"></script>

  <!--swfobject - needed only if you require <video> tag support for older browsers -->
  <!--script type="text/javascript" SRC="static/js/sitemap/swfobject.js"></script-->
  <!-- jQuery with plugins -->
  <script type="text/javascript" SRC="static/js/sitemap/jquery-1.5.2.min.js"></script>
    <script type="text/javascript" src="static/js/sitemap/bootstrapSwitch.js" defer></script>
  <!--script type="text/javascript" SRC="static/js/sitemap/jquery.ui.tabs.min.js"></script-->
  <!-- jQuery tooltips -->
  <script type="text/javascript" SRC="static/js/sitemap/jquery.tipTip.min.js"></script>
  <!-- Superfish navigation -->
  <script type="text/javascript" SRC="static/js/sitemap/jquery.superfish.min.js"></script>
  <script type="text/javascript" SRC="static/js/sitemap/jquery.supersubs.min.js"></script>
  <!-- jQuery form validation -->
  <script type="text/javascript" SRC="static/js/sitemap/jquery.validate_pack.js"></script>
  <!-- jQuery popup box -->
  <script type="text/javascript" SRC="static/js/sitemap/jquery.nyroModal.pack.js"></script>
  <!-- jQuery graph plugins -->
  <script type="text/javascript" SRC="static/js/sitemap/jquery.visualize.js"></script>
  <!--[if IE]><script type="text/javascript" src="js/flot/excanvas.min.js"></script><![endif]-->
  <script type="text/javascript" SRC="static/js/sitemap/flot/jquery.flot.min.js"></script>
  <script type="text/javascript" SRC="static/js/sitemap/flot/jquery.flot.selection.min.js"></script>
  <!-- jQuery data tables -->
  <script type="text/javascript" SRC="static/js/sitemap/jquery.dataTables.js"></script>
  <script type="text/javascript" SRC="static/js/sitemap/jquery.dataTables.min.js"></script>
  <!-- form validator class -->
<!--  <script type="text/javascript" SRC="static/js/formValidatorClass.js"></script>     -->                                                                       
  <script type="text/javascript" SRC="static/js/sitemap/page.js"></script>
<!--    <script language="javascript" src="static/js/jquery-1.7.2.min.js"></script>--> 
</head>


<body>
<div class="wrapper">

	<section class="column full first">
		<br/>
        <H3 align="center">DATA-SAFE需求管理</H2>
        <br/>
		<div class="controls-row">
				 <div class="mr10" style="display:inline;">
							<input class="span2" id="keyword" type="text" value="<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
">
				 </div>
				 <button class="btn btn-primary" type="button" id="search_btn">查询</button>
				&nbsp;&nbsp;
				 <button class="btn btn-info" type="button" id="new_requirement">新建需求</button>
		</div>

		<table id="select_sitemap" class="table table-bordered table-striped table-hover valignM" style="width:1000px;">
		 <thead>
				<tr class="info">
					<th width="5%">ID</th>
					<th width="10%">需求名称</th>
					<th width="20%">需求描述或MRD</th>
					<th width="8%">分类</th>
					<th width="10%">申请人</th>
					<th width="10%">申请时间</th>
					<th width="5%">状态</th>
					<th width="10%">更新人</th>
					<th width="10%">更新时间</th>
					<th width="5%">操作</th>
          <th width="7%">发送邮件</th>
				</tr>
			</thead>
			<tbody>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
				<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value->file;?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['categoryList']->value[$_smarty_tpl->tpl_vars['item']->value->category];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value->proposer;?>
</td>
						<td><?php echo date("Y-m-d",$_smarty_tpl->tpl_vars['item']->value->create_time);?>
</td>
						<td style="background-color:<?php echo $_smarty_tpl->tpl_vars['bgColorList']->value[$_smarty_tpl->tpl_vars['item']->value->state];?>
"><font color='white'><?php echo $_smarty_tpl->tpl_vars['stateList']->value[$_smarty_tpl->tpl_vars['item']->value->state];?>
</font></td>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value->update_user;?>
</td>
						<td><?php echo date("Y-m-d",$_smarty_tpl->tpl_vars['item']->value->update_time);?>
</td>
						<td>
						<?php if (in_array(Yii::app()->user->name,array("yangyanhong","zhoumeiting","haolifei","tangxing","huyuanyuan01","chenping01","lishuo02"))){?>
							<button class="btn btn-mini btn-primary reset_btn_gray editor" type="button" item_id="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">编辑</button>
						<?php }?>
						</td>
             <td> 
            <?php if (in_array(Yii::app()->user->name,array("yangyanhong","zhoumeiting","haolifei","tangxing","huyuanyuan01","lishuo02"))){?>
              <button class=" btn-primary" type="button" item_id="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
" onclick="javascript:window.location.href='?r=requirement/email&name=<?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
&proposer=<?php echo $_smarty_tpl->tpl_vars['item']->value->proposer;?>
&state=<?php echo $_smarty_tpl->tpl_vars['item']->value->state;?>
&updater=<?php echo $_smarty_tpl->tpl_vars['item']->value->update_user;?>
'">发送</button>
            <?php }?>
            </td>
				</tr>
			<?php } ?>
			</tbody>
	</table>
	<div class="pagination pagination-right" id="slidePage"></div>
	
	</section>
	<div class="no-display" id="count"><?php echo $_smarty_tpl->tpl_vars['count']->value;?>
</div>
	<div class="no-display" id="pagenum"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</div>
	<div class="no-display" id="pagesize"><?php echo $_smarty_tpl->tpl_vars['pagesize']->value;?>
</div>
	<div class="no-display" id="offset"><?php echo $_smarty_tpl->tpl_vars['offset']->value;?>
</div>
	
</div>
</body>
</html>
<script type="text/javascript" src="static/js/sitemap/requirement_list.js" charset="utf-8"></script>
<script type="text/javascript">
  $('#select_sitemap').dataTable({'bAutoWidth':false, 'aaSorting':[[0,'desc']]});
	$(document).ready(function(){
		$('#new_requirement').click(function() {
			window.location.href="?r=requirement/add";
		});
	});
</script>
<?php }} ?>