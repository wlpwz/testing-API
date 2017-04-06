<?php /* Smarty version Smarty 3.1.4, created on 2014-03-29 13:51:35
         compiled from "/home/work/pop-b1/src/views/product/custom.tpl" */ ?>
<?php /*%%SmartyHeaderCode:128681724753365f67acf2b9-35308173%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '34f791692ae59a439638b25c7249323de89e9366' => 
    array (
      0 => '/home/work/pop-b1/src/views/product/custom.tpl',
      1 => 1396055236,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '128681724753365f67acf2b9-35308173',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id' => 0,
    'config' => 0,
    'items' => 0,
    'ival' => 0,
    'cname' => 0,
    'mids' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53365f67b39d3',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53365f67b39d3')) {function content_53365f67b39d3($_smarty_tpl) {?><!-- Right Content Part -->
								<form class="form-horizontal" id="edit_form" role="form">
												<div class="headline">
													 <ul class="breadcrumb">
                  							 <li><a href="?r=product/index">产品数据指标</a></li>
                  							 <li><a href="?r=product/report">报表管理</a></li>
                 								 <li class="active"><?php if ($_smarty_tpl->tpl_vars['id']->value){?>编辑<?php }else{ ?>新建<?php }?></li> 
         										</ul>  						
												</div>
												<input type="hidden" name="act" value="edit" />
												<input type="hidden" id="cid" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">报表名称</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="report_name" value="<?php echo $_smarty_tpl->tpl_vars['config']->value->report_name;?>
" placeholder="" required>
                            </div>
                        </div>
												<div class="form-group">
														<label for="inputPassword1" class="col-lg-2 control-label">监控项</label> 
														<div class="col-md-4">
																 <?php  $_smarty_tpl->tpl_vars['ival'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ival']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ival']->key => $_smarty_tpl->tpl_vars['ival']->value){
$_smarty_tpl->tpl_vars['ival']->_loop = true;
?>
																			<div class="" style="width: 800px;">
																					<?php  $_smarty_tpl->tpl_vars['cname'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cname']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ival']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cname']->key => $_smarty_tpl->tpl_vars['cname']->value){
$_smarty_tpl->tpl_vars['cname']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['cname']->key;
?>	
																					<label class="item-span" title="<?php echo $_smarty_tpl->tpl_vars['cname']->value;?>
">
																							<input type="checkbox" name="items[]" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['mids']->value&&in_array($_smarty_tpl->tpl_vars['id']->value,$_smarty_tpl->tpl_vars['mids']->value)){?>checked<?php }?>/> 
																							<?php echo $_smarty_tpl->tpl_vars['cname']->value;?>

																					</label>
																					<?php } ?>			
																			</div>
																 <?php } ?>	
														</div>
												</div>
                        <div class="form-group">	
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="button" class="btn-u btn-u-green" id="submit">提交</button>
																<span class="mar5"><a href="?r=product/report">取消</a></span>
                            </div>
                        </div>
                    </form>
<!-- End Right Content Part -->
<script type="text/javascript">
(function(){

      $('#submit').bind('click', function(){
        var sendData = $('#edit_form').serialize();
        var url = "?r=product/custom";
        if($("#cid").val()){
          url += "&id=" + $("#cid").val();
        }       

        $.post(url, sendData, function(data){
          eval("var data = " + data);
          if(data.status==1){
            alert("保存成功"); 
          }else{  
            alert("保存失败，请稍候重试！"); 
          }       
        });     

      });     

})();

</script>
<?php }} ?>