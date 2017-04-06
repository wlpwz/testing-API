<?php /* Smarty version Smarty 3.1.4, created on 2016-12-22 11:38:07
         compiled from "/home/work/ec_test_service/src/views/dictionaryresult/result.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14644322854a9062ba405d3-46429443%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4e23c9d7b10e7bf76d3d4fc3b54ff9b0ea71c53' => 
    array (
      0 => '/home/work/ec_test_service/src/views/dictionaryresult/result.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14644322854a9062ba405d3-46429443',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_54a9062bb4d34',
  'variables' => 
  array (
    'this' => 0,
    'taskid' => 0,
    'newold' => 0,
    'memory' => 0,
    'speed' => 0,
    'newolddiff' => 0,
    'dc_type' => 0,
    'dictionary_name' => 0,
    'source_name' => 0,
    'source_ftp' => 0,
    'newec' => 0,
    'oldec' => 0,
    'dir' => 0,
    'input_data' => 0,
    'output_data_new' => 0,
    'output_data_old' => 0,
    'cov_result' => 0,
    'summery_result' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54a9062bb4d34')) {function content_54a9062bb4d34($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'ecTask'));?>

<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="static/js/ZeroClipboard/ZeroClipboard.js"></script>
<script type="text/javascript">
</script>

<div class="container">
	<div class="row" >
		<div style="margin-top:20px;margin-left:-50px">
			<!--LEFT CONTENT-->
            <div class="col-md-2" id="myScrollspy" >
				<ul class="nav nav-tabs nav-stacked" data-spy="affix" data-offset-top="125" style="width:173px;">	
<li style="background-color:#F5F5F5;height:38px;padding-left:13px;padding-top:10px;font-weight:bolder;">离线任务<?php echo $_smarty_tpl->tpl_vars['taskid']->value;?>
详情：</li>
					<li class="active"><a href="#summery" class="list-group-item ">任务概况</a></li>
					<?php if ($_smarty_tpl->tpl_vars['newold']->value==1){?>	
					<li class=""><a href="#newolddiff" class="list-group-item ">新旧DIFF测试结果</a></li>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['memory']->value==1){?>
							<li class=""><a href="#memory" class="list-group-item ">内存测试结果</a></li>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['speed']->value==1){?>
						<li class=""><a href="#speed" class="list-group-item ">包处理速度统计</a></li>
					<?php }?>
				

            </ul>             <!-- <div class="list-group" data-spy="affix" data-offset-top="20">
					<B class="list-group-item " style="background-color:#F5F5F5">离线任务<?php echo $_smarty_tpl->tpl_vars['taskid']->value;?>
详情：</B>
                    <a href="#summery" class="list-group-item active">离线运行概况</a>
					<?php if ($_smarty_tpl->tpl_vars['newolddiff']->value==1||'newdiff'==1||'olddiff'==1){?>

                    <a href="#diff" class="list-group-item ">DIFF测试结果</a>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['memory']->value==1||$_smarty_tpl->tpl_vars['speed']->value==1){?>
                    <a href="#performance" class="list-group-item ">性能测试结果</a>
					<?php }?>
                </div>-->
            </div>
			<!--END LEFT CONTENT-->
			<!--RIGHT CONTENT-->
			<div class="col-md-10">
				<div class="head_line">
   					<ul class="breadcrumb">
						<li><a href="index.php?r=dictionary/task">词典测试任务列表</a></li>
      					<li>词典测试任务详情</li> 
     		 			<li class="active">任务概况</li> 
   					</ul>   
				</div> 
				<div class="panel panel-default" id="summery">
					<div class="panel-heading">任务概况</div>
					<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:14px;">
						<tr>    
                            <td>测试功能点：</td>
							<td width="85%">
							<?php if ($_smarty_tpl->tpl_vars['newold']->value==1){?>
                            新旧版本DIFF  &nbsp;&nbsp;&nbsp;&nbsp;
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['memory']->value==1){?>
								物理内存使用统计 &nbsp;&nbsp;&nbsp;&nbsp;
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['speed']->value==1){?>
                                包处理速度统计 &nbsp;&nbsp;&nbsp;&nbsp;
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['newold']->value==0&&$_smarty_tpl->tpl_vars['memory']->value==0&&$_smarty_tpl->tpl_vars['speed']->value==0){?>
								获取输出包

							<?php }?>
							</td>
                        </tr>
						<tr><td>DC类型：</td>
							<td><?php if ($_smarty_tpl->tpl_vars['dc_type']->value==0){?>中文<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['dc_type']->value==1){?>国际化<?php }?>
								
							</td>
						</tr>
						<tr>
							<td>词典名称：</td>
							<td><?php echo $_smarty_tpl->tpl_vars['dictionary_name']->value;?>
</td>
						</tr>	
						<tr>
							<td>词典来源：</td>
							<td><?php if ($_smarty_tpl->tpl_vars['source_name']->value==1){?>ftp<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['source_name']->value==2){?>hdfs<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['source_name']->value==3){?>svn<?php }?>
							</td>
						</tr>
						<tr>
							<td>词典来源地址：</td>
							<td><?php echo $_smarty_tpl->tpl_vars['source_ftp']->value;?>
</td>
						</tr>
						<tr>
							<td>新版DC执行环境：</td>
							<td width="85%"><input style="display:none" id="copy1" value="<?php echo $_smarty_tpl->tpl_vars['newec']->value;?>
"><a href="javascript:void(0);" id="btnCopy1" title="复制" onclick="toClipboard(this.id,'copy1')"><?php echo $_smarty_tpl->tpl_vars['newec']->value;?>
</a></td>
						</tr>	
						<tr>
                            <td>旧版DC执行环境：</td>
                            <td width="85%"><input style="display:none" id="copy2" value="<?php echo $_smarty_tpl->tpl_vars['oldec']->value;?>
"><a href="javascript:void(0);" id="btnCopy2" title="复制" onclick="toClipboard(this.id,'copy2')"><?php echo $_smarty_tpl->tpl_vars['oldec']->value;?>
</a></td>
                        </tr> 
						<tr>
							<td>运行结果地址：</td>
							<td width="85%"><input style="display:none" id="copy3" value="<?php echo $_smarty_tpl->tpl_vars['dir']->value;?>
"><a href="javascript:void(0);" id="btnCopy3" title="复制" onclick="toClipboard(this.id,'copy3')"><?php echo $_smarty_tpl->tpl_vars['dir']->value;?>
</a></td>
						</tr>
						<!--全为0情况	<tr>
                                <td>输入包地址：</td>
                                <td width="85%"><?php echo $_smarty_tpl->tpl_vars['input_data']->value;?>
</td>
                            </tr>
                            <tr>
                                <td>新EC输出包地址：</td>
                                <td width="80%"><?php echo $_smarty_tpl->tpl_vars['output_data_new']->value;?>
</td>
							</tr>
							<tr>
								<td>旧EC输出包地址：</td>
                                <td>
                                    <?php echo $_smarty_tpl->tpl_vars['output_data_old']->value;?>

                                </td>
                            </tr>-->
					</table>
				</div>
					<?php echo $_smarty_tpl->getSubTemplate ("diffresult.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

					
				<?php if ($_smarty_tpl->tpl_vars['cov_result']->value!=''){?>
				<div class="panel panel-info" >
				    <div class="panel-heading"><a class="accordion-toggle" value=false onclick="showCovFile(this)"><span style="cursor:pointer">覆盖率信息  <strong >&nu;</strong></span></a>
					</div>
						<table width="100%" class="table table-bordered table-striped" id="cov_table">
						<?php echo $_smarty_tpl->tpl_vars['summery_result']->value;?>

						</table>
						<script>
							function showCovFile(node)
							{
								var flag = node.getAttribute("value");
								if (flag == "false")
								{
									document.getElementById("cov_table").innerHTML='<?php echo $_smarty_tpl->tpl_vars['cov_result']->value;?>
';
									node.setAttribute("value","true");
									node.innerHTML="<span style=\"cursor:pointer\">覆盖率信息 <strong>&Lambda;</strong></span>";
								}
								else
								{
									document.getElementById("cov_table").innerHTML="<?php echo $_smarty_tpl->tpl_vars['summery_result']->value;?>
";
									node.setAttribute("value","false");
									node.innerHTML="<span style=\"cursor:pointer\">覆盖率信息 <strong>&nu;</strong></span>";

								}
							}
						</script>
				</div>
				<?php }?>
					<div id="performance">
						<?php echo $_smarty_tpl->getSubTemplate ("performance.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

					</div>
				</div>
			</div>
			<!--END RIGHT CONTENT-->
		</div>
	</div>
</div>
<script>
	ZeroClipboard.setMoviePath("static/js/ZeroClipboard/ZeroClipboard.swf");
	function $(id) { return document.getElementById(id); }  
	function toClipboard(copy_id,input_id) {
		var clip = new ZeroClipboard.Client();
		clip.setHandCursor(true); 
		clip.setText($(input_id).value); 
		clip.addEventListener('complete', function (client) {
			alert("复制成功");  
		});  
		clip.glue(copy_id);  
	}
	   /* ZeroClipboard.setMoviePath("static/js/ZeroClipboard/ZeroClipboard.swf");
    var clip = new ZeroClipboard.Client(); // 新建一个对象
        clip.setHandCursor(true); // 设置鼠标为手型
		clip.setText(document.getElementById("copy1").value);
        clip.glue("btnCopy"); //与复制按钮关联，这里的btnCopy是关联对象的id，必须和第3步中的html对象的id相同
		clip.setText(document.getElementById("copy1").value);
  		clip.addEventListener( "complete", function(){  
        	alert("本文链接复制成功！");   
    	});*/

</script>
<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<?php }} ?>