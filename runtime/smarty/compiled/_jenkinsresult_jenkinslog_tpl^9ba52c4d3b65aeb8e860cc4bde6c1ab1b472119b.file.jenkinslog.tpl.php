<?php /* Smarty version Smarty 3.1.4, created on 2016-02-21 01:36:17
         compiled from "/home/work/ec_test_service/src/views/jenkinsresult/jenkinslog.tpl" */ ?>
<?php /*%%SmartyHeaderCode:97156251954295456e1c8b4-11009664%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ba52c4d3b65aeb8e860cc4bde6c1ab1b472119b' => 
    array (
      0 => '/home/work/ec_test_service/src/views/jenkinsresult/jenkinslog.tpl',
      1 => 1450076151,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '97156251954295456e1c8b4-11009664',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_54295456e8b9b',
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
<?php if ($_valid && !is_callable('content_54295456e8b9b')) {function content_54295456e8b9b($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'ecTask'));?>

<!--<link rel="stylesheet" type="text/css" href="/static/plugins/dataTable/css/dataTables.bootstrap.css">-->
<script type="text/javascript" src="static/js/ZeroClipboard/ZeroClipboard.js"></script>
<div class="container">
	<div class="row">
		<div style="margin-top:20px;margin-left:-50px">
			<div class="col-md-2" id="myScrollspy">
				<ul class="nav nav-tabs nav-stacked" data-spy="affix" data-offset-top="125" style="width:173px;">
                    <li style="background-color:#F5F5F5;height:38px;padding-left:13px;padding-top:10px;font-weight:bolder;">jekens任务运行日志：</li>
                    <li class="active"><a href="#run" class="list-group-item ">执行日志</a></li>
					  <?php if ($_smarty_tpl->tpl_vars['status']->value=="done"||$_smarty_tpl->tpl_vars['status']->value=="fail"){?>
                    <li class=" "><a href="#module" class="list-group-item ">模块日志</a></li>
					<?php }?>
                </ul>            	
<!--	<a href="?r=run/showERR&task_id=<<?php ?>?php //echo "$task_id"?<?php ?>>" class="list-group-item ">ERR</a>-->
             
			
            	</div>	
			</div>
			<div class="col-md-10">
				<div class="head_line">
                    <ul class="breadcrumb">
                        <li><a href="/">首页</a></li>
                        <li><a href="index.php?r=ecTask/jenkinsmission">Jenkins任务列表</a></li>
                        <li class="active">Jenkins运行日志</li>
                    </ul>
                </div>
				<div class="panel panel-default" id="run">
					<!--<div class="panel-heading">执行日志（日志下载方法：</div>
					--><table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:15px;">
					<tr><td>
					    执行日志:<a href="http://pat.baidu.com:8901/jekens/<?php echo $_smarty_tpl->tpl_vars['taskid']->value;?>
.log" target="_blank">    全部日志</a>
					</td></tr>
					<tr><td>
						<pre id="log" style="border: none;background-color: white;font-size:13px;color:#333">
						</pre>
					</td></tr>
				</table>
				<p id="id" style="display:none">
					
						<?php echo $_smarty_tpl->tpl_vars['id']->value;?>

					
				</p>
				</div>
				  <?php if ($_smarty_tpl->tpl_vars['status']->value=="done"||$_smarty_tpl->tpl_vars['status']->value=="fail"){?>
				<div class="panel panel-default" id="module">
                    <div class="panel-heading">模块日志：</div>
                    <table width="100%" class="table table-bordered table-striped" style="text-align:left;font-size:14px;">
                    <?php if ($_smarty_tpl->tpl_vars['ec_type']->value==0){?>
					<tr><td width="9%">新EC1</td>
                    <td>
                    	<input style="display:none" id="copy1" value="wget  -r -nH --preserve-permissions --level=0 --cut-dirs=8 <?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
/code/product_new/itlg-ec1/log"><a id="btnCopy1" title="复制" onclick="toClipboard(this.id,'copy1')">wget  -r -nH --preserve-permissions --level=0 --cut-dirs=8  <?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
/code/product_new/itlg-ec1/log
                 </a>   </td></tr>

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
/code/product_old/itlg-ec1/log</a>
                    </td></tr>
                    <tr><td>旧EC2</td>
                    <td>
						<input style="display:none" id="copy4" value="wget  -r -nH --preserve-permissions --level=0 --cut-dirs=8 <?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
/code/product_old/itlg-ec2/log"><a href="javascript:void(0);" id="btnCopy4" title="复制" onclick="toClipboard(this.id,'copy4')"> wget  -r -nH --preserve-permissions --level=0 --cut-dirs=8 <?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
/code/product_old/itlg-ec2/log</a>
                    </td></tr>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['ec_type']->value==1){?>
                    <tr><td width="9%">新EC</td>
                    <td>
                    	<input style="display:none" id="copy5" value="wget  -r -nH --preserve-permissions --level=0 --cut-dirs=8  <?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
/code/product_new/log"><a href="javascript:void(0);" id="btnCopy5" title="复制" onclick="toClipboard(this.id,'copy5')"> wget  -r -nH --preserve-permissions --level=0 --cut-dirs=8  <?php echo $_smarty_tpl->tpl_vars['resultftp']->value;?>
/code/product_new/log</a>
					</td></tr>
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
<script type="text/javascript" charset="utf8" src="/static/js/jquery.min.js"></script>
<script type="text/javascript">
	var temp = $('#id').html();
	console.log(temp);
	var data = $.parseJSON(temp);
	console.log(data);
	var resulturl = "index.php?r=jenkinsresult/log&taskid="+data['task_id'];
	countsecond(resulturl);
	function countsecond(resulturl){
		console.log(resulturl);
		$.get(resulturl,function(ajaxObj){
					
					var result=$.parseJSON(ajaxObj);
			$('#log').html(result.log);
					});
		setTimeout(function(){this.countsecond(resulturl);}, 10*1000);
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