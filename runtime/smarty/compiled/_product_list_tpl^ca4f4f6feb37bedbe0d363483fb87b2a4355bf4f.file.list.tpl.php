<?php /* Smarty version Smarty 3.1.4, created on 2014-03-29 10:18:55
         compiled from "/home/work/pop-b1/src/views/product/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:147054396353362d8f73c189-73457080%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca4f4f6feb37bedbe0d363483fb87b2a4355bf4f' => 
    array (
      0 => '/home/work/pop-b1/src/views/product/list.tpl',
      1 => 1396055236,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '147054396353362d8f73c189-73457080',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'keyword' => 0,
    'list' => 0,
    'rval' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53362d8f7d5df',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53362d8f7d5df')) {function content_53362d8f7d5df($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/work/pop-b1/src/vendors/Smarty/plugins/modifier.date_format.php';
?><?php $_smarty_tpl->tpl_vars['cycle'] = new Smarty_variable(array("1440"=>"天级"), null, 0);?>
<!-- Right Content Part -->
						<div class="headline">
         			<ul class="breadcrumb">
                  <li><a href="?r=product/index">产品数据指标</a></li>
                  <li><a href="?r=product/list">产品数据指标监控配置</a></li>
                  <li class="active">配置列表</li> 
        			 </ul>   
    				</div> 					
	
						<div class="form-inline">
									<div class="form-group">
												<input type="text" class="form-control" id="keyword" value="<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
"/>
									</div>
									<button type="submit" class="btn-u btn-u-blue" id="search">查询</button>
									<a href="?r=product/edit" class="se-right-area"><i class="fa fa-plus-square"></i>新增监控</a>
						</div>

						<div class="right-table">	
									<table id="sample-table-2" class="table table-striped table-bordered table-hover dataTable">
											<thead>
														<tr role="row">
																	<th>ID</th>
																	<th>中文名称</th>
																	<th>监控项</th>
															<!--		<th>上次抓取时间</th>  -->
																	<th>监控周期</th>
																	<th>创建人</th>
																	<th>创建时间</th>
																	<th>监控状态</tj>
																	<th>操作</th>
														</tr>
											</thead>
											<tbody>
														<?php  $_smarty_tpl->tpl_vars['rval'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rval']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rval']->key => $_smarty_tpl->tpl_vars['rval']->value){
$_smarty_tpl->tpl_vars['rval']->_loop = true;
?>									
														<tr>		
																	<td><?php echo $_smarty_tpl->tpl_vars['rval']->value->id;?>
</td>
																	<td><?php echo $_smarty_tpl->tpl_vars['rval']->value->cname;?>
</td>
																	<td><?php echo $_smarty_tpl->tpl_vars['rval']->value->name;?>
</td>
															<!--		<td><?php if ($_smarty_tpl->tpl_vars['rval']->value->last_crawl_time){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rval']->value->last_crawl_time,"%Y-%m-%d");?>
<?php }else{ ?>-<?php }?></td>  -->
																	<td>
																			<?php if ($_smarty_tpl->tpl_vars['rval']->value->daily==1){?>天级,<?php }?>
																			<?php if ($_smarty_tpl->tpl_vars['rval']->value->weekly==1){?>周级,<?php }?>
																			<?php if ($_smarty_tpl->tpl_vars['rval']->value->monthly==1){?>月级,<?php }?>
																	</td>
																	<td><?php echo $_smarty_tpl->tpl_vars['rval']->value->create_user;?>
</td>
																	<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rval']->value->create_time,"%Y-%m-%d");?>
</td>  
																	<td><?php if ($_smarty_tpl->tpl_vars['rval']->value->stat==1){?><span class="badge badge-green">开启</span><?php }else{ ?><span class="badge">关闭</span><?php }?></td>
																	<td><a href="?r=product/edit&id=<?php echo $_smarty_tpl->tpl_vars['rval']->value->id;?>
" title="编辑"><i class="fa fa-edit"></i></a> | <a cid="<?php echo $_smarty_tpl->tpl_vars['rval']->value->id;?>
" class="del-item" href="javascript:;" title="删除"><i class="fa fa-trash-o fa-lg"></i></a></td>
														</td>
														<?php } ?>
											</tbody>
									</table>
					</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#search').click(function() {
			window.location.href = "?r=product/list&keyword=" + $('#keyword').val() ;
		});

		$('.del-item').bind('click', function(){
					if(confirm("数据删除后不可恢复，请确认是否继续？")){					
							var id = $(this).attr("cid");
							var url = "?r=product/delete&id="+id;
			
							$.get(url, function(ajaxObj){
									var obj = eval("[" + ajaxObj + "]");
									var data = obj[0];

									if(data.status == 1){
											alert("删除成功！");
											window.location.reload();
									}else{
											alert("删除失败，请稍候重试！");
									}
					});
					}
		
		});		


	});
</script>
<!-- End Right Content Part -->



<?php }} ?>