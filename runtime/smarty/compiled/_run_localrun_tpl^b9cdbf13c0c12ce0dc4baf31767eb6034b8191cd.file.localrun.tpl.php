<?php /* Smarty version Smarty 3.1.4, created on 2016-12-21 15:27:18
         compiled from "/home/work/ec_test_service/src/views/run/localrun.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24119411753fd35c9893b29-08700828%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b9cdbf13c0c12ce0dc4baf31767eb6034b8191cd' => 
    array (
      0 => '/home/work/ec_test_service/src/views/run/localrun.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24119411753fd35c9893b29-08700828',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53fd35c9d0384',
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53fd35c9d0384')) {function content_53fd35c9d0384($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('current'=>'run'));?>

<script type="text/javascript" SRC="static/js/localrun.js"></script>
<script type="text/javascript" src="static/js/bootstrap.js"></script>
<script type="text/javascript" src="static/js/jquery.js"></script>
<script type="text/javascript" SRC="static/js/localrun.js"></script>
<div class="container">
    <div class="row">
        <div style="margin-top:20px;margin-left:-50px">
            <div class="col-md-2">
                <div class="list-group">
                    <B class="list-group-item " style="background-color:#F5F5F5;">轻松运行</B>
                        <a href="?r=run/index" class="list-group-item">在线执行</a>
                        <a href="#" class="list-group-item active">离线执行</a>
                        <a href="?r=diff/index" class="list-group-item">结果DIFF执行</a>
                </div>  
            </div>  
            <div class="col-md-10">
                <div class="head_line">
                    <ul class="breadcrumb">
                        <li><a href="?r=run/index">EC自动化测试</a></li>
                        <li>轻松运行</li> 
                        <li class="active">离线执行</li> 
                    </ul>   
                </div> 

				<div class="panel panel-default">
 				<div class="panel-heading">第一步，填写任务描述<font style="font-size:10px;color:red">&nbsp;&nbsp;* &nbsp;仅保留最近7天的任务数据 </font></div>
				<table class="table table-bordered" style="text-align:left;font-size:14px;">
				<body>
					<tr>
						<td>任务描述</td>
						<td style="width:90%"><input type="text" id="des" style="width: 500px;height:30px;margin-left:0px;border: darkseagreen;border-bottom:2px solid #a9c6c9;" placeholder="输入任务描述，更方便识别任务哦~"></td>
					</tr>
				</body>
				</table>
				</div>
				
				<div class="panel panel-default">
 				<div class="panel-heading">第二步，选择测试功能点</div>
				<table class="table table-bordered" style="text-align:left;font-size:14px;"> 
	<tr>
		<td>运行一下</td>
		<td style="width:90%;"><input type="radio" name="get_output_pack" value="1" checked>获取输出包
			<font style="font-size:10px;color:red">&nbsp;&nbsp;*必选</font>
		</td>
	<tr>
        <td>DIFF测试
        <td style="width:90%;">
            <input type="checkbox"  id="newolddiff"  value="1" checked="checked">比较新旧版本DIFF
        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  id="newdiff" value="1" >比较新版一致性DIFF
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  id="olddiff" value="1" >比较旧版一致性DIFF
        </td>

    </tr></tr>
	<tr>
        <td>性能测试
        <td style="width:90%;">
			<input type="checkbox"  id="checkbox_memory" value="1">物理内存使用统计
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  id="checkbox_speed" value="1" >包处理速度统计
			<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  id="checkbox_Valgrind" value="1" >Valgrind扫描-->
		</td>
				
    </tr>
	
	
</table>
</div>
<div class="panel panel-default">
 <div class="panel-heading">第三步，选择执行环境</div>
<table class="table table-bordered" style="text-align:left;font-size:14px;">
<body><!--
	<tr>
		<td>任务描述</td>
		<td style="width:90%"><input type="text" id="des" style="width: 500px;height:30px;margin-left:0px;border: darkseagreen;border-bottom:2px solid #a9c6c9;" placeholder="输入任务描述，更方便识别任务哦~"></td>
	</tr>-->
    <tr>
    <td>部署机器</td>
    <td style="width:90%;">
        <input type="radio" name="radiobutton_machine" value="default_machine" checked 
            onchange="document.getElementById('table_machine').style.display='none';
        "/>平台默认机器
       <!-- <br/>

        <input type="radio" name="radiobutton_machine" value="define_machine"
            onchange="document.getElementById('table_machine').style.display='';
        "/>自定义机器
        <br/>
        <br/>
        
        <table rules=none id="table_machine" style="width:800px;display:none;font-size:13px;color:#333333">
        <body>
            <tr>
                <td>机器地址</td>
                <td style="width:90%;">
                    <input type="text" id="define_machine_machine" style="width: 600px;height:30px;margin-left:20px;border: darkseagreen;" placeholder="spider@cq01-testing-ps7133.vm.baidu.com">
                </td>
            </tr>

            <tr>
                <td>机器密码</td>
                <td style="width:90%;">
                    <input type="text" id="define_machine_password" style="width: 600px;height:30px;margin-left:20px;border: darkseagreen;" placeholder="ps-testing!!!">
                </td>
            </tr>

            <tr>
                <td>部署路径</td>
                <td style="width:90%;">
                    <input type="text" id="define_machine_deploypath" style="width: 600px;height:30px;margin-left:20px;border: darkseagreen;" placeholder="/home/spider/tmp">
                </td>
            </tr>

        </body>
        </table>-->


    </td>
    </tr>
    
    <tr>
    <td>EC类型</td>
    <td style="width:90%;">
		
       <input type="radio" name="radiobutton_type" id="radiobutton_type"  value="0" 
		onchange="document.getElementById('new').style.display='';
				  document.getElementById('old').style.display='';
				  document.getElementById('platform_data_type').value=0;
				  document.getElementById('data_chin').style.display='';
				  document.getElementById('data_inter').style.display='none';
				  document.getElementById('10w').style.display='none';
				document.getElementById('radiobutton_bin_new_scm').checked=true;
				document.getElementById('radiobutton_bin_old_scm').checked=true;
				document.getElementById('new_bin_define').style.display='none';
				document.getElementById('old_bin_define').style.display='none';
				document.getElementById('thread_num').value=6;
				document.getElementById('inter_strategy1').style.display='none';
				document.getElementById('chin_strategy1').style.display='';"
					checked/>中文
        
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="radiobutton_type" id="radiobutton_type" value="1" 
		 onchange="document.getElementById('platform_data_type').value=1;
					document.getElementById('new').style.display='none';
					document.getElementById('old').style.display='none';
					document.getElementById('data_chin').style.display='none';
					document.getElementById('data_inter').style.display='';
					document.getElementById('10w').style.display='';
					document.getElementById('radiobutton_bin_new').checked=true;
					document.getElementById('new_bin_define').style.display='';
					document.getElementById('radiobutton_bin_old').checked=true;
					document.getElementById('old_bin_define').style.display='';
					document.getElementById('thread_num').value=24;
					document.getElementById('inter_strategy1').style.display='';
                document.getElementById('chin_strategy1').style.display='none';					
					"/>国际化
    </td>
    </tr>
		<?php echo $_smarty_tpl->getSubTemplate ("strategy_1.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <tr>
    <td>执行代码</td>
    <td style="width:90%;">
		<table rules=none id="table_binpattern" style="width:100%;font-size:13px; color:#333333">
			<body>
				<tr>
					<td width=50%<?php ?>>
						<div id="new">
						<input type="radio" name="radiobutton_bin_new" id="radiobutton_bin_new_scm" value="product_new_code" checked  onchange="document.getElementById('new_bin_define').style.display='none';document.getElementById('bin_product').style.display='';"/>
						<font style="font-size:14px;">新EC-SCM&nbsp;&nbsp;</font>
						<input type="text"  id="new_scm" style="width: 200px;height:30px;margin-left:0px;border: darkseagreen;border-bottom:2px solid #a9c6c9;" placeholder="填写版本号，如：1.0.10.19340">
						<br>
						</div>
					</td>
					<td>
						<div id="old">
						<input type="radio" name="radiobutton_bin_old" id="radiobutton_bin_old_scm"value="product_old_code" checked  onchange="document.getElementById('old_bin_define').style.display='none';document.getElementById('bin_product').style.display='';"/>
						<font style="font-size:14px;">旧EC-SCM&nbsp;&nbsp;</font>
						<input type="text"  id="old_scm" style="width: 200px;height:30px;margin-left:0px;border: darkseagreen;border-bottom:2px solid #a9c6c9;" placeholder="填写版本号，如：1.0.10.19340">
						<br>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<input type="radio" name="radiobutton_bin_new" id="radiobutton_bin_new" value="define_new_code"  onchange="document.getElementById('new_bin_define').style.display='';"/>
						<font style="font-size:14px;">自定义新EC-FTP&nbsp;&nbsp;</font>
						<table style="width: 400px;display:none;font-size:13px; color:#333333" id="new_bin_define">
							<tr>
								<td>
									<input type="text" id="define_code_new_code_path"  style="width: 400px;height:30px;margin-left:0px;border: darkseagreen; border-bottom:2px solid #a9c6c9;" placeholder="ftp://spider@cq01-testing-ps7133.vm.baidu.com:/home/spider/tmp/output.tar.gz">
								</td>
							</tr>
						</table>
					</td>
					<td>
						<input type="radio" name="radiobutton_bin_old" id="radiobutton_bin_old" value="define_old_code"  onchange="document.getElementById('old_bin_define').style.display='';"/>
						<font style="font-size:14px;">自定义旧EC-FTP&nbsp;&nbsp;</font>
	                    <table style="width: 400px;display:none;font-size:13px; color:#333333" id="old_bin_define">
			                 <tr>
		                         <td>
					                <input type="text" id="define_code_old_code_path"  style="width: 400px;height:30px;margin-left:0px;border: darkseagreen; border-bottom:2px solid #a9c6c9;" placeholder="ftp://spider@cq01-testing-ps7133.vm.baidu.com:/home/spider/tmp/output.tar.gz">
							     </td>
			                 </tr>
						</table>
					</td>
				</tr>
			</body>
		</table>
	</td>
	</tr>
	<tr>    
        <td>线程数</td> 
        <td>
			
			<select id="thread_num" style="margin-left:20px;width:90px;">
				<option value="1">1</option>
				<option value="6" selected>6</option>
				<option value="12">12</option>
				<option value="24">24</option>
			</select>
		</td>
    </tr>   
  <!--     <input type="radio" name="radiobutton_bin1" value="product_code" checked
            onchange="document.getElementById('table_bin_define').style.display='none';
                      document.getElementById('bin_product').style.display='';
       "/>新EC-SCM
       <br/>
       <br/>
       <table rules=none id="bin_product">
       <body> 
           <tr>
               <td>填写SCM</td>
               <td>
                    <select name="product_code_new_version" id="product_code_new_version" style="margin-left:20px;width:90px;">
                        <option value="3.0.87" selected="selected">3.0.87</option>
                        <option value="3.0.78">3.0.78</option>
                    </select>
               </td>
           </tr>

           <tr>
               <td>旧EC-SCM</td>
               <td>
                    <select name="product_code_old_version" id="product_code_old_version" style="margin-left:20px;width:90px;">
                        <option value="0" selected="selected">3.0.87</option>
                        <option value="1">3.0.78</option>
                    </select>
                </td>
            </tr>
       </body>
       </table>-->

<!--
       <br>
       <input type="radio" name="radiobutton_bin" value="sitemap-select"  
            onchange="document.getElementById('table_bin_define').style.display='none';
                      document.getElementById('table_bin_platform').style.display='';
                      document.getElementById('bin_product').style.display='none';
        "/>平台编译完成的EC
       <br>
       <br>
        
        <table rules=none id="table_bin_platform">
        <body>
            <tr>
                <td>输入平台编译任务ID</td>
                <td>
                    <input type="text"  style="height:30px;margin-left:20px;border: darkseagreen;" placeholder="20">
                </td>
            </tr>
        </body>
        </table>
        <br/>

-->
<!--        <input type="radio" name="radiobutton_bin" value="define_code" checked
            onchange="document.getElementById('table_bin_define').style.display='';
        "/>填写
        <br>
        <br>


        <table rules=none id="table_bin_define" style="width: 800px;font-size:13px;color:#333333">
        <body>
            <tr>
                <td style="width:20%;">新EC的FTP地址</td>
                <td>
                    <input type="text" id="define_code_new_code_path"  style="width: 600px;height:30px;margin-left:20px;border: darkseagreen;" placeholder="ftp://spider@cq01-testing-ps7133.vm.baidu.com:/home/spider/tmp/output.tar.gz">
                </td>
            </tr>
            <tr>
                <td style="width:20%;">旧EC的FTP地址</td>
                <td>
                    <input type="text" id="define_code_old_code_path"  style="width: 600px;height:30px;margin-left:20px;border: darkseagreen;" placeholder="ftp://spider@cq01-testing-ps7133.vm.baidu.com:/home/spider/tmp/output.tar.gz">
                </td>
            </tr>
        </body>
        </table>
    </td>
    </tr>-->

<!--
    <tr>
    <td>CONF</td>
    <td style="width:90%;">
        <input type="radio" name="radiobutton_conf" value="sitemap-select" 
            onchange="document.getElementById('table_conf_define').style.display='none';
                      document.getElementById('conf_product').style.display='none';
        " />平台默认
        <br>

        <input type="radio" name="radiobutton_conf" value="sitemap-select-sitemap"
            onchange="document.getElementById('table_conf_define').style.display='none';
                      document.getElementById('conf_product').style.display='';
        "/>产品库
        <br/>
        <br/>

           <table rules=none id="conf_product">
           <body> 
               <tr>
                   <td>新EC</td>
                   <td>
                        <select name="conf" id="conf" style="margin-left:20px;width:90px;">
                            <option value="0" selected="selected">3.0.87</option>
                            <option value="1">3.0.78</option>
                        </select>
                   </td>
               </tr>

               <tr>
                   <td>旧EC</td>
                   <td>
                        <select name="conf_old" id="conf_old" style="margin-left:20px;width:90px;">
                            <option value="0" selected="selected">3.0.87</option>
                            <option value="1">3.0.78</option>
                        </select>
                    </td>
                </tr>
           </body>
           </table>

        <br>
        <input type="radio" name="radiobutton_conf" value="sitemap-select-sitemap" 
            onchange="document.getElementById('table_conf_define').style.display='';
                      document.getElementById('conf_product').style.display='none';
        "/>自定义
        <br/>
        <br/>

        <table rules=none id="table_conf_define" style="width: 800px;">
        <body>
            <tr>
                <td style="width:20%;">新EC的CONF的FTP地址</td>
                <td>
                    <input type="text"  style="width: 600px;height:30px;margin-left:20px;border: darkseagreen;" placeholder="ftp://spider@cq01-testing-ps7133.vm.baidu.com:/home/spider/tmp/conf">
                </td>
            </tr>
            <tr>
                <td style="width:20%;">旧EC的CONF的FTP地址</td>
                <td>
                    <input type="text"  style="width: 600px;height:30px;margin-left:20px;border: darkseagreen;" placeholder="ftp://spider@cq01-testing-ps7133.vm.baidu.com:/home/spider/tmp/conf">
                </td>
            </tr>
        </body>
        </table>

    </td>
    </tr>
-->
</body>
</table>

</div>
<div class="panel panel-default">
 <div class="panel-heading">第四步，选择输入数据 <font style="font-size:10px;color:red">&nbsp;&nbsp;*仅供DIFF测试和运行一下使用，性能测试使用默认数据</font> </div>
<table class="table table-bordered" style="text-align:left;font-size:14px;">
<body>
    <tr>
    <td>数据来源</td>
    <td style="width:90%;">
       <input type="radio" name="radiobutton_data" value="platform_data" checked
            onchange="document.getElementById('table_data_define').style.display='none';
                      document.getElementById('platform_data').style.display='';
       "/>平台数据
       <br/>
       <br/>
    
       <table rules=none id="platform_data" style="font-size:13px;color:#333333">
       <body> 
           <tr>
               <td>DATA TYPE</td>
               <td>
                    <select name="platform_data_type" id="platform_data_type"  style="margin-left:20px;width:90px;">
                        <option  value="0" id="data_chin">中文</option>
						<option  value="1" id="data_inter" style="display:none">国际化</option>
                    </select>
               </td>
           </tr>

           <tr>
               <td>数量</td>
               <td>
                    <select name="platform_data_num" id="platform_data_num" style="margin-left:20px;width:90px;">
                        <option value="10" selected="selected">10</option>
                        <option value="100">100</option>
                        <option value="1000">1000</option>
                        <option value="2000">2000</option>
                        <option value="5000">5000</option>
                        <option value="1w">1w</option>
                        <option value="2w">2w</option>
						<option value="10w" id="10w" style="display:none">10w</option>
                    </select>
                </td>
            </tr>
       </body>
       </table>

       <br/>
       <input type="radio" name="radiobutton_data" value="define_data" 
            onchange="document.getElementById('table_data_define').style.display='';
                      document.getElementById('platform_data').style.display='none';
       "/>自定义
       
        <br/>
        <br/>
        <table rules=none id="table_data_define" style="width: 800px;display:none;font-size:13px;color:#333333">
        <body>
            <tr>
                <td style="width:20%;">DATA的FTP地址</td>
                <td>
                    <input type="text"  id="define_data_ftp_path" style="width: 600px;height:30px;margin-left:0px;border: darkseagreen;border-bottom:2px solid #a9c6c9;" placeholder="ftp://spider@cq01-testing-ps7133.vm.baidu.com:/home/spider/tmp/pack.5000">
                </td>
            </tr>
        </body>
        </table>

    </td>
    </tr>
</body>
</table>
</div>
<h4 class="text-success"><button type="button" class="btn btn-primary" style="color: black;background-color: rgba(255, 255, 240, 0.05);margin-left: 500px;margin-top: 20px;" id="submit_task">提交任务</button></h4>
</div>
</div>
</div>
</div>
<script>
</script>
<script type="text/javascript" SRC="static/js/localrun.js"></script>
<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<?php }} ?>