<?php /* Smarty version Smarty 3.1.4, created on 2014-05-06 15:38:27
         compiled from "/home/work/project-ktv/src/views/site/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20642439753397a6f0c5185-61331410%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f8d1a5d0eb88c6196aa65e6673078daf52edf81' => 
    array (
      0 => '/home/work/project-ktv/src/views/site/edit.tpl',
      1 => 1399361830,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20642439753397a6f0c5185-61331410',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53397a6f102c7',
  'variables' => 
  array (
    'topic' => 0,
    'this' => 0,
    'id' => 0,
    'project' => 0,
    'priority_list' => 0,
    'prjPriority' => 0,
    'level_list' => 0,
    'prjLevel' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53397a6f102c7')) {function content_53397a6f102c7($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/work/project-ktv/src/vendors/Smarty/plugins/function.html_options.php';
?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/column1',array('topic'=>$_smarty_tpl->tpl_vars['topic']->value));?>
    
<div class="page-title"><i class="i_icon"></i> 项目信息 </div>
    <div class="pd10 left">
      <div class="panel ">
        <div class="panel-main panel-gray">
          <div class="form pd10">
            <form id="form_info">
                <input type="hidden" name="act" value="edit"/>
                <p style="display:none;" id="prj_id"><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
</p>
                <input type="hidden" name="topic_id" value="<?php echo $_smarty_tpl->tpl_vars['topic']->value;?>
">
            <table border="0" cellspacing="0" cellpadding="0" width="100%">
              <tr>
            <td align="right">优先级：</td>
                <td align="left">
                    <select name="priority" id="select"  class="select width-sm2" >
                        <?php if ($_smarty_tpl->tpl_vars['project']->value->priority){?><?php $_smarty_tpl->tpl_vars['prjPriority'] = new Smarty_variable($_smarty_tpl->tpl_vars['project']->value->priority, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['prjPriority'] = new Smarty_variable(3, null, 0);?><?php }?>
                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['priority_list']->value,'selected'=>$_smarty_tpl->tpl_vars['prjPriority']->value),$_smarty_tpl);?>

                    </select>
                </td>
              </tr>
              <tr>
                <td align="right">项目分级：</td>
                <td align="left"><select name="level" class="select width-sm2" >
                        <?php if ($_smarty_tpl->tpl_vars['project']->value->level){?><?php $_smarty_tpl->tpl_vars['prjLevel'] = new Smarty_variable($_smarty_tpl->tpl_vars['project']->value->level, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['prjLevel'] = new Smarty_variable(3, null, 0);?><?php }?>
                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['level_list']->value,'selected'=>$_smarty_tpl->tpl_vars['prjLevel']->value),$_smarty_tpl);?>
  
                </select></td>
              </tr>
              <tr>
                <td align="right">icafe项目：</td>
                <td align="left"><input type="text" name="icafe" value="<?php echo @htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->icafe, ENT_QUOTES, 'UTF-8', true);?>
" class="input width-md2" width="200" maxlength="1024" placeholder="wdm-177-ccode中文query识别准确优化"/>
              </tr>
              <tr>
                <td align="right"><p>模块：</p></td>
                <td align="left"><input type="text" name="module" value="<?php echo @htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->module, ENT_QUOTES, 'UTF-8', true);?>
"  class="input width-md2" maxlength="256" placeholder="ccode" />
              </tr>
              <tr>
                <td align="right"><p>版本：</p></td>
                <td align="left"><input type="text" name="version" value="<?php echo @htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->version, ENT_QUOTES, 'UTF-8', true);?>
"  class="input width-md2" maxlength="256" placeholder="3.5.41.0" />
              </tr>
              <tr>    
                <td align="right"><p>代码规模：</p></td>
                <td align="left"><input type="text" name="codelines" value="<?php echo @htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->codelines, ENT_QUOTES, 'UTF-8', true);?>
"  class="input" placeholder="500"/>
              </tr>   
              <tr>        
                <td align="right"><p>RD负责人：</p></td>
                <td align="left"><input type="text" name="rd" value="<?php if ($_smarty_tpl->tpl_vars['project']->value->rd){?><?php echo @htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->rd, ENT_QUOTES, 'UTF-8', true);?>
<?php }else{ ?><?php echo Yii::app()->user->name;?>
<?php }?>" class="input" placeholder="xiaodu01,xiaodu02"/></td>
              </tr>               
              <tr>
                <td align="right"><p>预期提测时间：</p></td>
                <td align="left">
                       <input size="8" type="text" class="form_datetime" name="lift_date" value="<?php echo $_smarty_tpl->tpl_vars['project']->value->lift_date;?>
">
                </td>
              </tr>
              <tr>
                <td align="right"><p>预期上线时间：</p></td>
                <td align="left">
                       <input size="8" type="text" class="form_datetime" name="online_date" value="<?php echo $_smarty_tpl->tpl_vars['project']->value->online_date;?>
">
                </td> 
              </tr>
              <tr>
                <td width="20%" align="right">升级内容：</td>
                <td width="80%"  align="left">
                    <input type="text" name="content" value="<?php echo @htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->content, ENT_QUOTES, 'UTF-8', true);?>
" class="input width-md2" placeholder="策略特征服务化" maxlength="256" />
                </td>
              </tr>
              <tr>    
                <td align="right">预期线上影响：</td>
                <td align="left"><textarea type="text" name="influence" id="textfield2" class="input" width="200"/><?php echo @htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->influence, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
              </tr>  
              <tr>
                <td align="right">&nbsp;</td>
                <td align="left"><a class="btn btn-primary btn-large submit">提交</a> <a class="btn  btn-large" href="?r=site/index&topic=<?php echo $_smarty_tpl->tpl_vars['topic']->value;?>
">取消</a></td>
              </tr>
            </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<link rel="stylesheet" href="static/css/jquery-ui.css" type="text/css" charset="utf-8"/>  
<script language="javascript" src="static/js/jquery-ui.js"></script> 
<script>
    (function(){
        var topic = <?php echo $_smarty_tpl->tpl_vars['topic']->value;?>
;
        $(".form_datetime").datepicker({ dateFormat: "yy-mm-dd", minDate: -20, maxDate: "+1M +10D" });
        $(".submit").bind("click", function(){
            var data = $("#form_info").serialize();
            var url = "?r=site/edit&topic=" + topic;
            var id = $("#prj_id").html();
            if(id){
                url += "&id=" + id;
            }

            $.post(url, data, function(ajaxObj){
                var obj = $.parseJSON(ajaxObj);

                if(obj.status == 1){
                    alert("提交成功！");
                    window.location.href = "?r=site/index&topic=" + topic;
                }else if(obj.status == -1){
                    alert("邮件发送失败！");
                }else{
                    alert("提交失败，请稍后重试！");
                }
            });
        
        });       
 
    })();
</script>
<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<?php }} ?>