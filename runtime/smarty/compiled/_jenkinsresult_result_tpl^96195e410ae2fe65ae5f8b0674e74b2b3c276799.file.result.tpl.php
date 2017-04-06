<?php /* Smarty version Smarty 3.1.4, created on 2016-02-29 23:49:11
         compiled from "/home/work/ec_test_service/src/views/jenkinsresult/result.tpl" */ ?>
<?php /*%%SmartyHeaderCode:39574028454216eaca3cf14-83731871%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '96195e410ae2fe65ae5f8b0674e74b2b3c276799' => 
    array (
      0 => '/home/work/ec_test_service/src/views/jenkinsresult/result.tpl',
      1 => 1450076151,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '39574028454216eaca3cf14-83731871',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_54216eacabf0a',
  'variables' => 
  array (
    'this' => 0,
    'taskid' => 0,
    'newolddiff' => 0,
    'newdiff' => 0,
    'olddiff' => 0,
    'memory' => 0,
    'speed' => 0,
    'ec_type' => 0,
    'thread_num' => 0,
    'newec' => 0,
    'oldec' => 0,
    'dir' => 0,
    'cov_result' => 0,
    'bigpack_ec1' => 0,
    'bigpack_ec1_list' => 0,
    'bigpack_ec2' => 0,
    'bigpack_ec2_list' => 0,
    'summery_result' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54216eacabf0a')) {function content_54216eacabf0a($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'ecTask'));?>

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
					<li style="background-color:#F5F5F5"><div style="height:38px;padding-left:13px;padding-top:10px;font-weight:bolder;">Jenkins任务<?php echo $_smarty_tpl->tpl_vars['taskid']->value;?>
详情：</div><li>
                   <li class="active"><a href="#summery" class="list-group-item ">任务概况</a></li>
					<?php if ($_smarty_tpl->tpl_vars['newolddiff']->value==1){?>
                   <li class=""><a href="#newolddiff" class="list-group-item ">新旧DIFF测试结果</a></li>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['newdiff']->value==1){?>
                   <li class=""><a href="#consistentdiff" class="list-group-item ">新版一致性测试结果</a></li>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['olddiff']->value==1){?>
				   <li class=""><a href="#olddiff" class="list-group-item ">旧版一致性测试结果</a></li>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['memory']->value==1){?>
                   <li class=""><a href="#memory" class="list-group-item ">内存测试结果</a></li>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['speed']->value==1){?>
                   <li class=""><a href="#performance" class="list-group-item ">包处理速度统计</a></li>
					<?php }?>
                   <li class=""><a href="#cov" class="list-group-item ">覆盖率信息</a></li>
                </ul>
            </div>
			<!--END LEFT CONTENT-->
			<!--RIGHT CONTENT-->
			<div class="col-md-10">
				<div class="head_line">
   					<ul class="breadcrumb">
						<li><a href="index.php?r=ecTask/jenkinsmission">jenkins任务列表</a></li>
      					<li>Jenkins任务详情</li> 
     		 			<li class="active">任务概况</li> 
   					</ul>   
				</div> 
				<div class="panel panel-default" id="summery">
					<div class="panel-heading">任务概况</div>
					<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:14px;">
						<tr>    
                            <td>测试功能点：</td>
							<td width="85%">
							<?php if ($_smarty_tpl->tpl_vars['newolddiff']->value==1){?>
                            新旧版本DIFF  &nbsp;&nbsp;&nbsp;&nbsp;<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['newdiff']->value==1){?>	新版一致性DIFF &nbsp;&nbsp;&nbsp;&nbsp;<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['olddiff']->value==1){?>	旧版一致性DIFF &nbsp;&nbsp;&nbsp;&nbsp;<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['memory']->value==1){?>	物理内存使用统计 &nbsp;&nbsp;&nbsp;&nbsp;<?php }?>
                             <?php if ($_smarty_tpl->tpl_vars['speed']->value==1){?>   包处理速度统计 &nbsp;&nbsp;&nbsp;&nbsp;<?php }?>
							</td>
                        </tr>	
						<tr>
							<td>EC类型</td>
							<?php if ($_smarty_tpl->tpl_vars['ec_type']->value==0){?>
								<td>中文</td>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['ec_type']->value==1){?>
								<td>国际化</td>
							<?php }?>
						</tr>
						<tr>
							<td>线程数</td>
							<td><?php echo $_smarty_tpl->tpl_vars['thread_num']->value;?>
</td>
						</tr>
						<tr>
							<td>新版EC执行环境：</td>
							<td width="85%"><input style="display:none" id="copy1" value="<?php echo $_smarty_tpl->tpl_vars['newec']->value;?>
"><a href="javascript:void(0);" id="btnCopy1" title="复制" onclick="toClipboard(this.id,'copy1')"><?php echo $_smarty_tpl->tpl_vars['newec']->value;?>
</a></td>
						</tr>	
						<tr>
                            <td>旧版EC执行环境：</td>
                            <td width="85%"><input style="display:none" id="copy2" value="<?php echo $_smarty_tpl->tpl_vars['oldec']->value;?>
"><a href="javascript:void(0);" id="btnCopy2" title="复制" onclick="toClipboard(this.id,'copy2')"><?php echo $_smarty_tpl->tpl_vars['oldec']->value;?>
</a></td>
                        </tr> 
						<tr>
							<td>运行结果地址：</td>
							<td width="85%"><input style="display:none" id="copy3" value="<?php echo $_smarty_tpl->tpl_vars['dir']->value;?>
"><a href="javascript:void(0);" id="btnCopy3" title="复制" onclick="toClipboard(this.id,'copy3')"><?php echo $_smarty_tpl->tpl_vars['dir']->value;?>
</td>
						</tr>
					</table>
				</div>
					<?php echo $_smarty_tpl->getSubTemplate ("diffresult.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

					
					<?php echo $_smarty_tpl->getSubTemplate ("performance.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

				<?php if ($_smarty_tpl->tpl_vars['cov_result']->value!=''){?>
				<div class="panel panel-default" id="bigpack_ec1" >
					<div class="panel-heading"><span>EC1大包处理速度对比</span></div>
					<iframe src="<?php echo $_smarty_tpl->tpl_vars['bigpack_ec1']->value;?>
" width=100% height=400></iframe>
					<div>
					     <table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:14px;">
						 <th>ID</th><th>Url</th><th>old use time</th><th>new use time</th>
						<?php echo $_smarty_tpl->tpl_vars['bigpack_ec1_list']->value;?>

						 </table>
					</div>
				</div>
				<div class="panel panel-default" id="bigpack_ec2">
					<div class="panel-heading"><span>EC2大包处理速度对比</span></div>
					<iframe src="<?php echo $_smarty_tpl->tpl_vars['bigpack_ec2']->value;?>
" width=100% height=400></iframe>
					<div>
					     <table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:14px;">
						 <th>ID</th><th>Url</th><th>old use time</th><th>new use time</th>
						<?php echo $_smarty_tpl->tpl_vars['bigpack_ec2_list']->value;?>

						 </table>
					</div>
				</div>
				<div class="panel panel-info" id="cov">
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