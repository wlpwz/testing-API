<?php /* Smarty version Smarty 3.1.4, created on 2016-01-27 11:28:37
         compiled from "/home/work/ec_test_service/src/views/ecmonitor/ecmonitorresult.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1646415625548981bf50b3c5-61174241%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd6cae39d5ca1475329ecc5a04febcb52e780cddd' => 
    array (
      0 => '/home/work/ec_test_service/src/views/ecmonitor/ecmonitorresult.tpl',
      1 => 1450076151,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1646415625548981bf50b3c5-61174241',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_548981bf5498d',
  'variables' => 
  array (
    'this' => 0,
    'taskid' => 0,
    'ec1_result' => 0,
    'ec2_result' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548981bf5498d')) {function content_548981bf5498d($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'ecTask'));?>

<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="/scripts/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="static/js/ZeroClipboard/ZeroClipboard.js"></script>
<div class="container">
    <div class="row" data-spy="scroll" data-target="#myScrollspy">
		<div style="margin-top:20px;margin-left:-50px">
			<!--LEFT CONTENT-->
            <div class="col-md-2" id="myScrollspy">
				<ul class="nav nav-tabs nav-stacked" data-spy="affix" data-offset-top="125" style="width:173px;">
					<li style="background-color:#F5F5F5"><div style="height:38px;padding-left:13px;padding-top:10px;font-weight:bolder;">EC监控任务<?php echo $_smarty_tpl->tpl_vars['taskid']->value;?>
详情：</div><li>
                   <li class="active"><a href="#summery" class="list-group-item ">EC内存图</a></li>
                </ul>
            </div>
			<!--END LEFT CONTENT-->
			<!--RIGHT CONTENT-->
			<div class="col-md-10">
				<div class="head_line">
   					<ul class="breadcrumb">
						<li><a href="index.php?r=ecTask/jenkinsmission">EC监控任务列表</a></li>
      					<li>EC监控任务详情</li> 
     		 			<li class="active">任务结果</li> 
   					</ul>   
				</div> 
				<div class="panel panel-default" id="ec1_memory" >
					<div class="panel-heading"><span>EC1内存</span></div>
					<iframe src="<?php echo $_smarty_tpl->tpl_vars['ec1_result']->value;?>
" width=100% height=500 id="ec1_result"></iframe>
				</div>
				<div class="panel panel-default" id="ec2_memory">
					<div class="panel-heading"><span>EC2内存</span></div>
					<iframe src="<?php echo $_smarty_tpl->tpl_vars['ec2_result']->value;?>
" width=100% height=500></iframe>
				</div>
			</div>
			<!--END RIGHT CONTENT-->
		</div>
	</div>
</div>
<script>
//iframe1 = document.getElementById("ec1_result");
//iframe1.setAttribute("src","<?php echo $_smarty_tpl->tpl_vars['ec1_result']->value;?>
");
//iframe1.setAttribute("src","sfsdf");
</script>
<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<?php }} ?>