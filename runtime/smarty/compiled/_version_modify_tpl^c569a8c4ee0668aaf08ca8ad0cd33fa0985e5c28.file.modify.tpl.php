<?php /* Smarty version Smarty 3.1.4, created on 2016-02-18 16:50:17
         compiled from "/home/work/ec_test_service/src/views/version/modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15619107155407fd466aebc7-35784887%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c569a8c4ee0668aaf08ca8ad0cd33fa0985e5c28' => 
    array (
      0 => '/home/work/ec_test_service/src/views/version/modify.tpl',
      1 => 1450076151,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15619107155407fd466aebc7-35784887',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5407fd466f8c7',
  'variables' => 
  array (
    'this' => 0,
    'id' => 0,
    'editid' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5407fd466f8c7')) {function content_5407fd466f8c7($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'version'));?>

	<div class="container">
	<div class="row"
		<div style="margin-top:20px;margin-left:-50px">
	

            <div class="col-md-2">
                <div class="list-group">
					<B class="list-group-item " style="background-color:#f5f5f5">版本管理</B>
                    <a href="?r=version/index" class="list-group-item">版本列表</a>
                    <a href="?r=version/add" class="list-group-item" >增加版本项</a>
					<a href="#" class="list-group-item active" >修改版本项</a>

                </div>  
            </div>

            <div class="col-md-10">
				<div class="head_line">
                    <ul class="breadcrumb">
                        <li><a href="/">首页</a></li>
                        <li>版本管理</li>
                        <li class="active">修改版本项</li>
                    </ul>
                </div>
				<form class="form-horizontal" id="edit_form" role="form" style="margin-top:50px;margin-bottom:50px;">
					<div class="wrapper">
						<input type="hidden" name="act" value="edit" />
					
						<input type="hidden" id="cid" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
					
						<section class="column full first">
							<div class="form-group">
								<label class="col-lg-3 control-label" for="inputEmail1">EC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;版本号</label>
									<div class="col-md-4">
					
										<input type="text" required="" placeholder="EC版本号" value="<?php echo $_smarty_tpl->tpl_vars['editid']->value->version;?>
" id="EcVersionControl_version" class="form-control">
									</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label" for="inputPassword1">EC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;类型</label>
									<div class="col-md-4">
		    							<input type="text" placeholder="CH" value="<?php echo $_smarty_tpl->tpl_vars['editid']->value->language;?>
" id="EcVersionControl_language"  class="form-control">
        						</div>  
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label" for="inputPassword1">ECC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;版本号</label>
								<div class="col-md-4">
		    						<input type="text" placeholder="ECC版本号" maxlength="1024" value="<?php echo $_smarty_tpl->tpl_vars['editid']->value->ecc_version;?>
" id="EcVersionControl_ecc_version" class="form-control">
        						</div>  
							</div>
							<div class="form-group">
                                <label class="col-lg-3 control-label" for="inputPassword1">Framework版本号</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Framework版本号" maxlength="1024" value="<?php echo $_smarty_tpl->tpl_vars['editid']->value->framework_version;?>
" id="EcVersionControl_framework_version" class="form-control">
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-lg-3 control-label" for="inputPassword1">Pagevalue&nbsp;&nbsp;版本号</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Pagevalue版本号" maxlength="1024" value="<?php echo $_smarty_tpl->tpl_vars['editid']->value->pagevalue_version;?>
" id="EcVersionControl_pagevalue_version" class="form-control">
                                </div>
                            </div>
							<!--<div class="form-group">
                                <label class="col-lg-2 control-label" for="inputPassword1">Is Splited</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder=" " maxlength="1024" value="<?php echo $_smarty_tpl->tpl_vars['editid']->value->is_splited;?>
" id="EcVersionControl_is_splited" class="form-control">
                                </div>
                            </div>-->
							<br/>
							<br/>
							<div class="form-group">
								<div class="col-lg-offset-3 col-lg-10">
									<button id="update" class="btn btn-primary" type="button">提交</button>
									<span class="mar5"><a href="?r=version/index">取消</a></span>
								</div>
							</div>
						</section>
					</div>
				</form>
			</div>
	</div>

</div>
</div>
</div>
<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<script src="static/js/modifyversion.js"></script> 
<?php }} ?>