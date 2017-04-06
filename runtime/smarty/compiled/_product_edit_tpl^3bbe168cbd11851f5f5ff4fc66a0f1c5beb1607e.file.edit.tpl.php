<?php /* Smarty version Smarty 3.1.4, created on 2014-03-29 13:51:42
         compiled from "/home/work/pop-b1/src/views/product/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:85657290553365f6ec144a9-96704876%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3bbe168cbd11851f5f5ff4fc66a0f1c5beb1607e' => 
    array (
      0 => '/home/work/pop-b1/src/views/product/edit.tpl',
      1 => 1396055236,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85657290553365f6ec144a9-96704876',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id' => 0,
    'config' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53365f6ecb668',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53365f6ecb668')) {function content_53365f6ecb668($_smarty_tpl) {?><!-- Right Content Part -->
								<form class="form-horizontal" id="edit_form" role="form">
												<div class="headline">
													 <ul class="breadcrumb">
                  							 <li><a href="?r=product/index">产品数据指标</a></li>
                  							 <li><a href="?r=product/list">产品数据指标监控配置</a></li>
                 								 <li class="active"><?php if ($_smarty_tpl->tpl_vars['id']->value){?>编辑<?php }else{ ?>新建<?php }?></li> 
         										</ul>  						
												</div>
												<input type="hidden" name="act" value="edit" />
												<input type="hidden" id="cid" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">监控项</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="name" value="<?php echo $_smarty_tpl->tpl_vars['config']->value->name;?>
" placeholder="pie_result_number" required>
                            </div>
                        </div>
												<div class="form-group">
															<label for="inputEmail1" class="col-lg-2 control-label">中文名称</label>
															<div class="col-md-4">
																	<input type="text" class="form-control" name="cname" value="<?php echo $_smarty_tpl->tpl_vars['config']->value->cname;?>
" placeholder="模板统计" required>
															</div>
												</div>
                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label">数据库配置</label>
                            <div class="col-md-6">
																	<input type="text" class="form-control in-col-def2" name="conn_ip" value="<?php echo $_smarty_tpl->tpl_vars['config']->value->conn_ip;?>
" placeholder="ip，如：10.23.56.22">
																	<input type="text" class="form-control in-col-def1" name="conn_port" value="<?php echo $_smarty_tpl->tpl_vars['config']->value->conn_port;?>
" placeholder="port，如：8306">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label">数据库名称</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="conn_database" value="<?php echo $_smarty_tpl->tpl_vars['config']->value->conn_database;?>
" placeholder="sitemap2">
                            </div>  
                        </div>
												<div class="form-group">
														<label for="inputPassword1" class="col-lg-2 control-label">数据库用户名</label> 
														<div class="col-sm-3">
																	<input type="text" class="form-control" name="conn_user" value="<?php echo $_smarty_tpl->tpl_vars['config']->value->conn_username;?>
" placeholder="root">
														</div>
												</div>  	
												<div class="form-group">
															<label for="inputPassword1" class="col-lg-2 control-label">数据库密码</label>
														 <div class="col-sm-3">
   															<input type="password" class="form-control" name="conn_pwd" value="<?php echo substr(base64_decode($_smarty_tpl->tpl_vars['config']->value->conn_pwd),4);?>
" placeholder="Password">
														</div>
												</div>
												<div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label">监控SQL</label> 
                        		<div class="col-md-6">
																<textarea name="sql" rows="3" placeholder="SELECT COUNT(*) as `count` FROM users;" required=""><?php echo $_smarty_tpl->tpl_vars['config']->value->sql;?>
</textarea>

														 </div>
												</div> 
												<div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label">监控状态</label>
                            <div class="col-md-4">
                            			<input type="radio" name="stat"  value="1" <?php if ($_smarty_tpl->tpl_vars['config']->value->stat==1){?>checked<?php }?>>开启
																	<input type="radio" name="stat"  value="0" <?php if ($_smarty_tpl->tpl_vars['config']->value->stat==0){?>checked<?php }?>>关闭	
														</div>
                        </div>
												<div class="form-group">
														<label for="inputPassword1" class="col-lg-2 control-label">监控周期</label> 
														<div class="col-md-4">
                                  <input type="checkbox" name="daily" value="1" <?php if ($_smarty_tpl->tpl_vars['config']->value->daily!=0||$_smarty_tpl->tpl_vars['config']->value->daily===false){?>checked<?php }?>> 天级
																	<input type="checkbox" name="weekly" value="1" <?php if ($_smarty_tpl->tpl_vars['config']->value->weekly!=0||$_smarty_tpl->tpl_vars['config']->value->weekly===false){?>checked<?php }?>> 周级
																	<input type="checkbox" name="monthly" value="1" <?php if ($_smarty_tpl->tpl_vars['config']->value->monthly!=0||$_smarty_tpl->tpl_vars['config']->value->monthly===false){?>checked<?php }?>> 月级
														</div>
												</div>
                        <div class="form-group">	
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="button" class="btn-u btn-u-green" id="submit">提交</button>
																<span class="mar5"><a href="?r=product/list">取消</a></span>
                            </div>
                        </div>
                    </form>
<!-- End Right Content Part -->
<script type="text/javascript" src="static/js/product_editor.js"></script>
<?php }} ?>