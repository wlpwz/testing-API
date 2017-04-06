<?php /* Smarty version Smarty 3.1.4, created on 2016-12-22 14:12:59
         compiled from "/home/work/ec_test_service/src/views/dictionaryresult/dictionarylog.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11768994054ae61e81651a4-00011935%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f80b8ba1d4c3ef06278974a2ed87be98cc26fd92' => 
    array (
      0 => '/home/work/ec_test_service/src/views/dictionaryresult/dictionarylog.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11768994054ae61e81651a4-00011935',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_54ae61e829cad',
  'variables' => 
  array (
    'this' => 0,
    'status' => 0,
    'taskid' => 0,
    'id' => 0,
    'ec_type' => 0,
    'resultftp' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ae61e829cad')) {function content_54ae61e829cad($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'ecTask'));?>

<script type="text/javascript" charset="utf8" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="static/js/ZeroClipboard/ZeroClipboard.js"></script>
<!--<link rel="stylesheet" type="text/css" href="/static/plugins/dataTable/css/dataTables.bootstrap.css">-->
<div class="container">
	<div class="row">
		<div style="margin-top:20px;margin-left:-50px">
			<div class="col-md-2" id="myScrollspy">
				<ul class="nav nav-tabs nav-stacked" data-spy="affix" data-offset-top="125" style="width:173px;">
					<li style="background-color:#F5F5F5;height:38px;padding-left:13px;padding-top:10px;font-weight:bolder;">词典测试运行日志：</li>
					<li class="active"><a href="#run" class="list-group-item ">执行日志</a></li>
					<?php if ($_smarty_tpl->tpl_vars['status']->value=="done"||$_smarty_tpl->tpl_vars['status']->value=="fail"){?>
					<li class=" "><a href="#module" class="list-group-item ">模块日志</a></li>
					<?php }?>
				</ul>
			</div>
			<div class="col-md-10">
				<div class="head_line">
                    <ul class="breadcrumb">
                        <li><a href="/">首页</a></li>
                        <li><a href="index.php?r=dictionary/task">词典测试任务列表</a></li>
                        <li class="active">词典测试日志</li>
                    </ul>
                </div>
				<div id="run">
				<div class="panel panel-default" ><!--
					<div class="panel-heading">日志下载方法：</div>-->
					<table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:15px;">
					<tr><td>
					
						执行日志:<a href="http://cq01-testing-ps7210.cq01.baidu.com:8901/<?php echo $_smarty_tpl->tpl_vars['taskid']->value;?>
"  target="_blank">  全部日志</a>
					
					</td></tr>
					<tr><td>
						<pre id="log" style="border: none;background-color: white;">
						</pre>
					</td></tr>
				</table>
				<p id="taskid" style="display:none"><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
</p>
				</div>
				</div>
				<?php if ($_smarty_tpl->tpl_vars['status']->value=="done"||$_smarty_tpl->tpl_vars['status']->value=="fail"){?>	
				<div class="panel panel-default" id="module">
                    <div class="panel-heading">模块日志：</div>
                    <table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:14px;">
        			
					<?php if ($_smarty_tpl->tpl_vars['ec_type']->value==0){?>
					<tr><td width="9%">新EC1</td>
                    <td>
						<input style="display:none" id="copy1" value="wget  -r -nH --preserve-permissions --level=0 --cut-dirs=8 <?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
/code/product_new/itlg-ec1/log"><a href="javascript:void(0);" id="btnCopy1" title="复制" onclick="toClipboard(this.id,'copy1')">wget  -r -nH --preserve-permissions --level=0 --cut-dirs=8  <?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
/code/product_new/itlg-ec1/log</a>
                    </td></tr>            
		
					<tr><td>新EC2</td>
                    <td>
                        <input style="display:none" id="copy2" value="wget  -r -nH --preserve-permissions --level=0 --cut-dirs=8 <?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
/code/product_new/itlg-ec2/log"><a href="javascript:void(0);" id="btnCopy2" title="复制" onclick="toClipboard(this.id,'copy2')">wget  -r -nH --preserve-permissions --level=0 --cut-dirs=8 <?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
/code/product_new/itlg-ec2/log</a>
                    </td></tr>
					<tr><td>旧EC1</td>
                    <td>
                    	<input style="display:none" id="copy3" value="wget  -r -nH --preserve-permissions --level=0 --cut-dirs=8 <?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
/code/product_old/itlg-ec1/log"><a href="javascript:void(0);" id="btnCopy3" title="复制" onclick="toClipboard(this.id,'copy3')">wget  -r -nH --preserve-permissions --level=0 --cut-dirs=8 <?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
/code/product_old/itlg-ec1/log</a> </td></tr>
					<tr><td>旧EC2</td>
                    <td>
                   		<input style="display:none" id="copy4" value="wget  -r -nH --preserve-permissions --level=0 --cut-dirs=8 <?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
/code/product_old/itlg-ec2/log"><a href="javascript:void(0);" id="btnCopy4" title="复制" onclick="toClipboard(this.id,'copy4')"> 
                        wget  -r -nH --preserve-permissions --level=0 --cut-dirs=8 <?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
/code/product_old/itlg-ec2/log</a>
                    
                    </td></tr>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['ec_type']->value==1){?>
					<tr><td width="9%">新EC</td>
                    <td>   
						<input style="display:none" id="copy5" value="wget  -r -nH --preserve-permissions --level=0 --cut-dirs=8  <?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
/code/product_new/log"><a href="javascript:void(0);" id="btnCopy5" title="复制" onclick="toClipboard(this.id,'copy5')"> wget  -r -nH --preserve-permissions --level=0 --cut-dirs=8  <?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
/code/product_new/log</a> </td></tr>
					<tr><td>旧EC</td>
                    <td>    
                          <input style="display:none" id="copy6" value="wget  -r -nH --preserve-permissions --level=0 --cut-dirs=8 <?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
/code/product_old/log"><a href="javascript:void(0);" id="btnCopy6" title="复制" onclick="toClipboard(this.id,'copy6')">wget  -r -nH --preserve-permissions --level=0 --cut-dirs=8 <?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
/code/product_old/log</a>
                    </td></tr>	
					<?php }?>
					</table>
                </div>
				<?php }?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" charset="utf8" src="/static/js/jquery.min.js"></script>
<script>
	var temp=$('#taskid').html();
	console.log(temp);
	var data = $.parseJSON(temp);
	console.log(data['taskid']);
	var resulturl="index.php?r=dictionaryresult/log&taskid="+data['taskid'];
	console.log(resulturl);
	countSecond(resulturl); 
	function countSecond(resulturl)
	{
		$.get(resulturl, function(ajaxObj)
        {
            var result = $.parseJSON(ajaxObj);
            console.log(result.taskid);
            $('#log').html(result.log);
            
        });
        setTimeout(function(){this.countSecond(resulturl);}, 10*1000);
	}
	
    ZeroClipboard.setMoviePath("static/js/ZeroClipboard/ZeroClipboard.swf");
    function toClipboard(copy_id,input_id) {
        var clip = new ZeroClipboard.Client();
        clip.setHandCursor(true); 
        clip.setText(document.getElementById(input_id).value); 
        clip.addEventListener('complete', function (client) {
            alert("复制成功");   
        });  
        clip.glue(copy_id);  
    }
</script>
<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>
                            
<?php }} ?>