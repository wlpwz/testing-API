<?php /* Smarty version Smarty 3.1.4, created on 2014-03-29 10:41:41
         compiled from "/home/work/pop-b1/src/views/userlog/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:623574723533632e5307db3-43205232%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e76ce0f7e2e04af7e6c3f4ff8ee0a66c4d6f67c0' => 
    array (
      0 => '/home/work/pop-b1/src/views/userlog/edit.tpl',
      1 => 1396055236,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '623574723533632e5307db3-43205232',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id' => 0,
    'config' => 0,
    'items' => 0,
    'ival' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_533632e539d76',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_533632e539d76')) {function content_533632e539d76($_smarty_tpl) {?><!-- Right Content Part -->
								<form class="form-horizontal" id="edit_form" role="form">
												<div class="headline">
													 <ul class="breadcrumb">
                  							 <li><a href="?r=userlog/index">用户访问指标</a></li>
                  							 <li><a href="?r=userlog/config">PV/UV监控配置管理</a></li>
                 								 <li class="active"><?php if ($_smarty_tpl->tpl_vars['id']->value){?>编辑<?php }else{ ?>新建<?php }?></li> 
         										</ul>  						
												</div>
												<input type="hidden" name="act" value="edit" />
												<input type="hidden" id="cid" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">平台名称</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="platname" value="<?php echo $_smarty_tpl->tpl_vars['config']->value->platname;?>
" placeholder="站长平台监控中心">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label">访问地址</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="url" value="<?php echo $_smarty_tpl->tpl_vars['config']->value->url;?>
" placeholder="http://sitemap-qa.baidu.com/">
                            </div>
                        </div>
                        <div class="form-group">
                       			<label for="inputPassword1" class="col-lg-2 control-label"><b style="color:red;">*</b>提交数据说明</label>
														<div class="col-md-6">
																	<ul class="form-ul">
																				<li>提交日志数据需包含至少用户名、访问地址、时间戳三列，并以“\t”分隔。多行数据请换行分隔。</li>
																				<li>例如：yanglingling01	site/index	1361289600</li>
																	</ul>
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
																<select class="form-control" name="cycle">
                            				<option value="1440">天级</option>
                        				</select>
														</div>
												</div>
												<div class="form-group">
														 <label for="inputPassword1" class="col-lg-2 control-label">采集机器列表</label>
														 <div class="col-md-6">
																	<textarea name="location" rows="8" placeholder="例如：ftp://cq01-testing-ps7236.cq01.baidu.com/home/work/file，多个地址请换行分隔。" required=""><?php echo $_smarty_tpl->tpl_vars['config']->value->location;?>
</textarea>

														 </div>
												</div>
												<div class="form-group">
                            <label for="inputPassword1" class="col-lg-2 control-label"><b style="color:red;">*</b>文件举例说明</label>
                            <div class="col-md-6">
                                  <ul class="form-ul">
                                        <li>需要提供如下文件（时间戳随日期变化）:</li>
                                        <li>ftp://cq01-testing-ps7236.cq01.baidu.com/home/work/file.20130816</li>
																<!--			<li>ftp://cq01-testing-ps7236.cq01.baidu.com/home/work/file.md5.20130816</li>
																				<li>其中，md5文件用于标识其对应数据文件是否变更。为保证数据正常采集，请务必提供以上两种文件。</li>  -->
                                  </ul>
                            </div>
                        </div>
												<div class="form-group">
														<label for="inputPassword1" class="col-lg-2 control-label"><b style="color:red;">*</b>监控项过滤规则</label>
														<div class="col-md-6">
																 <div id="input_items">
																		<?php if ($_smarty_tpl->tpl_vars['items']->value){?>
																				<?php  $_smarty_tpl->tpl_vars['ival'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ival']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ival']->key => $_smarty_tpl->tpl_vars['ival']->value){
$_smarty_tpl->tpl_vars['ival']->_loop = true;
?>
																				<div class="col-item">	
																							<span class="input-icon">
																							<input type="text" name="input_key[]" value="<?php echo $_smarty_tpl->tpl_vars['ival']->value['input_key'];?>
">
																							</span>
																							<span class="input-icon input-icon-right">
																							<input type="text" name="input_value[]" value="<?php echo $_smarty_tpl->tpl_vars['ival']->value['input_value'];?>
">
																							</span>
																							<a href="javascript:;" class="add_input"><i class="fa fa-plus"></i></a>
																							<a href="javascript:;" class="del_input"><i class="fa fa-minus"></i></a>
																				</div>
																				<?php } ?>
																		<?php }else{ ?>
																		<div class="col-item">
																				<span class="input-icon">
																								<input type="text" name="input_key[]" value="全网分析">
                                    		</span>
																				<span class="input-icon input-icon-right">
																								<input type="text" name="input_value[]" value="*/*">
                                    		</span>
																				<a href="javascript:;" class="add_input"><i class="fa fa-plus"></i></a>
																		</div>
																		<?php }?>
																 </div>
														</div>
												</div>
                        <div class="form-group">	
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="button" class="btn-u btn-u-green" id="submit">提交</button>
																<span class="mar5"><a href="?r=userlog/config">取消</a></span>
                            </div>
                        </div>
                    </form>
<!-- End Right Content Part -->
<script type="text/javascript" src="static/js/userlog_editor.js"></script>
<?php }} ?>