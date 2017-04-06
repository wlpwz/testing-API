<?php /* Smarty version Smarty 3.1.4, created on 2016-12-19 18:44:35
         compiled from "/home/work/ec_test_service/src/views/performance/diff.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9577713575857ba1310a911-38156110%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5ff2bce0cfd3bb62129733bdd84dae5a852b88c2' => 
    array (
      0 => '/home/work/ec_test_service/src/views/performance/diff.tpl',
      1 => 1482143411,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9577713575857ba1310a911-38156110',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5857ba131463a',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5857ba131463a')) {function content_5857ba131463a($_smarty_tpl) {?><!--script src="/static/js/jquery.min.js"></script-->
<!--script src="/static/js/bootstrap.min.js"></script-->
<div class="container">
	<div class="row">
			<div class="col-md-10">
                <div class="head_line">
                    <ul class="breadcrumb">
                        <li>性能平台</li> 
                        <li class="active">任务性能比较页面</li> 
                    </ul>   
                </div>
				<div class="panel panel-default">
					<div class="panel-heading">任务性能比较</div></br>
						<form action="?r=performance/diffsubmit" method="post">
							<font>&nbsp&nbsp&nbsp新版本任务的id号</font>
							<input type="text" name="task1_id" placeholder="task1_id"></br></br>
							<font>&nbsp&nbsp&nbsp旧版本任务的id号</font>
							<input type="text" name="task2_id" placeholder="task2_id"></br></br>
							<font>&nbsp&nbsp&nbsp</font>
							<input type="submit" value="任务提交">
						</form>	
				</div>
				
			</div>
	</div>
</div>



<?php }} ?>