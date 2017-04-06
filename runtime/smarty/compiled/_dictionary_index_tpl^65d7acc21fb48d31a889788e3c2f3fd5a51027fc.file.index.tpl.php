<?php /* Smarty version Smarty 3.1.4, created on 2016-12-21 11:02:36
         compiled from "/home/work/ec_test_service/src/views/dictionary/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:160187027554a8e218a36ed9-04016955%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '65d7acc21fb48d31a889788e3c2f3fd5a51027fc' => 
    array (
      0 => '/home/work/ec_test_service/src/views/dictionary/index.tpl',
      1 => 1482141256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '160187027554a8e218a36ed9-04016955',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_54a8e218aa677',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54a8e218aa677')) {function content_54a8e218aa677($_smarty_tpl) {?><!--script src="/static/js/jquery.min.js"></script-->
<!--script src="/static/js/bootstrap.min.js"></script-->
<div class="container">
	<div class="row">
			<div class="col-md-10">
                <div class="head_line">
                    <ul class="breadcrumb">
                        <li>词典测试</li> 
                        <li class="active">词典测试任务提交</li> 
                    </ul>   
                </div> 
				<div class="panel panel-default">
					<div class="panel-heading">第一步，选择词典来源</div>
					<table class="table table-bordered" style="text-align:left;font-size:14px;">
						<tr>
							<td>词典来源</td>
							<td width="90%"> 
								<input type="radio" name="method" value="0" checked>
								<font>全量测试&nbsp;</font>
								<i class="fa fa-question-circle" title="注：该方式下将词典拷到DC-CONF目录下"></i>
								<br>
								<select name="source" id="dictionary_source" style="margin-left:10px;width:90px;height:20px;">
                                    <option value="1">ftp</option>
                                    <option value="2">hdfs</option>
                                    <option value="3">svn</option>
                                    <input type="text"  name="source_data" id="source_data" placeholder="说明:数据来源是ftp时路径需要加上ftp://"    style="width: 600px;height:20px;margin-left:10px;border: darkseagreen;border-bottom:2px solid #a9c6c9;">
                                <code class="string" title="String">ftp路径最后一个目录就是词典的目录不要多加目录</code>
                                </select>	
								<br><br>
								<!--input type="radio" name="method" value="1">
								<font>增量测试&nbsp;</font><i class="fa fa-question-circle" title="第一列为要修改词典名，第二列为修改后词典的ftp地址"></i>
								<br>
								<div class="col-md-6" id="input_items">
										<div class="col-item">
											<span class="input-icon">
                                            	<input type="text" name="input_key" value="page_weight">
                                            </span>
											<span class="input-icon input-icon-right">
                                                <input type="text" name="input_value" value="*">
                                            </span>
                                                 <a href="javascript:;" class="add_input"><i class="fa fa-plus"></i></a>
                                         </div>
								</div-->
								<!--table>
									<tr>
										<td><font style="font-size:13px">请选择要修改的词典</font></td>
										<td><select id="dictionary_mergy" style="margin-left:10px;width:200px;height:20px;">
											<option value="page_weight">page_weight</option>
										</select></td>
									</tr>
									<tr>
										<td><font style="font-size:13px">请输入修改后词典的FTP地址</font></td>
										<td><input type="text"  id="mergy_data" style="width: 600px;height:20px;margin-left:10px;border: darkseagreen;border-bottom:2px solid #a9c6c9;"></td>
						       		</tr>
								</table-->
							</td>
						</tr>
					</table>
				</div> 
				<div class="panel panel-default">
					<div class="panel-heading">第二步，选择测试环境</div>
					<table class="table table-bordered" style="text-align:left;font-size:14px;">
						<tr>
							<td >语言选项</td>
							<td width="90%">
								<input type="radio" name="language" id="language"  value="0" checked/>中文
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<!--input type="radio" name="language" id="langeage"  value="1" />国际化-->
							</td>
						</tr>
						<tr>
							<td>词典名称</td>
							<td>
								<select id="dictionary_name" style="margin-left:10px;"><option value="page_weight">page_weight</option>
								<option value="attr_modify">attr_modify</option>
								<option value="alias">alias</option>
								<option value="anchor_text">anchor_text</option>
								<option value="blacklist2_url">blacklist2_url</option>
								<option value="blacklist_url">blacklist_url</option>
								<option value="dc_filter">dc_filter</option>
								<option value="dup_param">dup_param</option>
								<option value="dup_domain">dup_domain</option>
								<option value="CaseAnalysis">CaseAnalysis</option>
								<option value="follow_link">follow_link</option>
								<option value="follow_limit_create">follow_limit_create</option>
								<option value="follow_limit">follow_limit</option>
								<option value="global_whitelist">global_whitelist</option>
								<option value="image_whitelist">image_whitelist</option>
								<option value="innocent_url">innocent_url</option>
								<option value="not_text">not_text</option>
								<option value="model_func">model_func</option>
								<option value="mini_wdn_filter">mini_wdn_filter</option>
								<option value="MidWay">MidWay</option>
								<option value="new_spamming">new_spamming</option>
								<option value="pcre">pcre</option>
								<option value="pattern">pattern</option>
								<option value="page_weight">page_weight</option>
								<option value="page_extract">page_extract</option>
								<option value="questionable_site">questionable_site</option>
								<option value="redir">redir</option>
								<option value="spamming_site">spamming_site</option>
								<option value="translate">translate</option>
								<option value="vip_url">vip_url</option>
                                </select></td>
						</tr>
						<tr>
							<td width="10%">测试功能点</td>
							<td>
								<input type="checkbox"  id="newolddiff"  value="1" checked="checked">比较新旧版本DIFF
								 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  id="memory" value="1" checked="checked">物理内存使用统计
								 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  id="speed" value="1" checked="checked">包处理速度统计
							</td>
						</tr>
						<tr>
							<td>负责人</td>
							<td>
							<input type="text"  id="head" style="width:160px;height:20px;margin-left:10px;border: darkseagreen;border-bottom:2px solid #a9c6c9;">
                            <code class="string" title="String">线上推送效果需要关注一下哦</code>
							</td>
						</tr>
						<tr>
							<td>推送原因</td>
							<td>
							<input type="text"  id="reason" style="width:360px;height:20px;margin-left:10px;border: darkseagreen;border-bottom:2px solid #a9c6c9;">
							</td>
						</tr>
						<!--tr>
							<td>升级功能点</td>
							<td><input type="text" id="function_point" style="width: 600px;height:20px;margin-left:10px;border: darkseagreen;border-bottom:2px solid #a9c6c9;"/></td>
						</tr-->
					</table>
				</div>
				<h4 class="text-success"><button type="button" class="btn btn-primary" style="color: black;background-color: rgba(255, 255, 240, 0.05);margin-left: 500px;margin-top: 20px;" id="submit_task">提交任务</button></h4>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" SRC="static/js/dictionarysubmit.js"></script>
<?php }} ?>