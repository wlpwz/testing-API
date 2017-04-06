<?php /* Smarty version Smarty 3.1.4, created on 2014-05-22 21:21:50
         compiled from "/home/work/project-ktv/src/views/site/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:95395540053393fa32da935-61901460%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b529f46e7a766c9206560429469425f39855b1b' => 
    array (
      0 => '/home/work/project-ktv/src/views/site/index.tpl',
      1 => 1400763177,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '95395540053393fa32da935-61901460',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53393fa338046',
  'variables' => 
  array (
    'topic' => 0,
    'this' => 0,
    'topic_list' => 0,
    'state_list' => 0,
    'state' => 0,
    'keyword' => 0,
    'data' => 0,
    'dval' => 0,
    'manWhiteList' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53393fa338046')) {function content_53393fa338046($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/work/project-ktv/src/vendors/Smarty/plugins/function.html_options.php';
if (!is_callable('smarty_modifier_truncate')) include '/home/work/project-ktv/src/vendors/Smarty/plugins/modifier.truncate.php';
if (!is_callable('smarty_modifier_date_format')) include '/home/work/project-ktv/src/vendors/Smarty/plugins/modifier.date_format.php';
?><?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/column1',array('topic'=>$_smarty_tpl->tpl_vars['topic']->value));?>


<?php $_smarty_tpl->tpl_vars['manWhiteList'] = new Smarty_variable(array('liubaoguo','yanglingling01','wangsiyuan02'), null, 0);?>  

<div class="page-title"><i class="i_icon"></i> 测试项目信息 </div>
  <div class="pd10 left">
    <div class="page-search"> 
      业务:  
      <select name="topic" class="select">
        <option value="">全部</option>
        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['topic_list']->value,'selected'=>$_smarty_tpl->tpl_vars['topic']->value),$_smarty_tpl);?>

      </select>
      状态：      
      <select name="state" class="select">
        <option value="">全部</option>  
        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['state_list']->value,'selected'=>$_smarty_tpl->tpl_vars['state']->value),$_smarty_tpl);?>

      </select>
      关键字：
      <input type="text" name="keyword" class="input" width="160" value="<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
">
      <a href="javascript:;" class="btn btn-primary search"><i class="icon16 icon16-zoom"></i> 搜索</a> </div>
    <div class="page-operate mt10">
      <?php if ($_smarty_tpl->tpl_vars['topic']->value>0){?>
        <a href="?r=site/edit&topic=<?php echo $_smarty_tpl->tpl_vars['topic']->value;?>
" class="btn btn-primary">提测新项目</a>
      <?php }?>
     </div> 
      <div class="panel">
<div class="list-table" id="list-table">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th width="80px">icafe项目</th>
      <th width="80px">模块</th>
      <th width="80px">升级内容</th>
      <!--<th>业务</th>-->
      <th width="60px">RD负责人</th>
      <th>QA评审人</th>
      <th>QA负责人</th>
      <th>计划提测时间</th>
      <th>实际提测时间</th>
      <th>预期上线时间</th>
      <th>状态</th>
      <th>测试周期(天)</th>
      <th width="100" style="padding-left:15px;">操作</th>
    </tr>
    <?php  $_smarty_tpl->tpl_vars['dval'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dval']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dval']->key => $_smarty_tpl->tpl_vars['dval']->value){
$_smarty_tpl->tpl_vars['dval']->_loop = true;
?>
        <tr>
             <td title="<?php echo @htmlspecialchars($_smarty_tpl->tpl_vars['dval']->value->icafe, ENT_QUOTES, 'UTF-8', true);?>
"><a target="_blank" href="http://icafe.baidu.com/project/highQueryProjectWithPermission?name=<?php echo @htmlspecialchars($_smarty_tpl->tpl_vars['dval']->value->icafe, ENT_QUOTES, 'UTF-8', true);?>
&isTop=true"><?php echo smarty_modifier_truncate(@htmlspecialchars($_smarty_tpl->tpl_vars['dval']->value->icafe, ENT_QUOTES, 'UTF-8', true),20,"...");?>
</a></td>
             <td title="<?php echo @htmlspecialchars($_smarty_tpl->tpl_vars['dval']->value->module, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo smarty_modifier_truncate(@htmlspecialchars($_smarty_tpl->tpl_vars['dval']->value->module, ENT_QUOTES, 'UTF-8', true),20,"...");?>
</td>
             <td title="<?php echo @htmlspecialchars($_smarty_tpl->tpl_vars['dval']->value->content, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo smarty_modifier_truncate(@htmlspecialchars($_smarty_tpl->tpl_vars['dval']->value->content, ENT_QUOTES, 'UTF-8', true),20,"...");?>
</td>
             <td><?php if ($_smarty_tpl->tpl_vars['dval']->value->rd){?><?php echo @htmlspecialchars($_smarty_tpl->tpl_vars['dval']->value->rd, ENT_QUOTES, 'UTF-8', true);?>
<?php }else{ ?>-<?php }?></td>
             <td><?php if ($_smarty_tpl->tpl_vars['dval']->value->qa_reviewer){?><?php echo @htmlspecialchars($_smarty_tpl->tpl_vars['dval']->value->qa_reviewer, ENT_QUOTES, 'UTF-8', true);?>
<?php }else{ ?>-<?php }?></td>
             <td><?php if ($_smarty_tpl->tpl_vars['dval']->value->qa_master){?><?php echo @htmlspecialchars($_smarty_tpl->tpl_vars['dval']->value->qa_master, ENT_QUOTES, 'UTF-8', true);?>
<?php }else{ ?>-<?php }?></td>
             <td>
                <?php if ($_smarty_tpl->tpl_vars['dval']->value->lift_date){?>
                    <?php echo $_smarty_tpl->tpl_vars['dval']->value->lift_date;?>

                <?php }else{ ?>
                    -
                <?php }?>
             </td>
             <td act_lift_time="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['dval']->value->act_lift_time,"%Y-%m-%d %H:%M:%S");?>
">
               <?php if ($_smarty_tpl->tpl_vars['dval']->value->act_lift_time){?>
                    <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['dval']->value->act_lift_time,"%Y-%m-%d");?>

                <?php }else{ ?>
                    -
                <?php }?>
             </td>
             <td>
                <?php if ($_smarty_tpl->tpl_vars['dval']->value->online_date!=="0000-00-00"){?>
                    <?php echo $_smarty_tpl->tpl_vars['dval']->value->online_date;?>

                <?php }else{ ?>
                    -
                <?php }?>
            </td>
             <td state="<?php echo $_smarty_tpl->tpl_vars['dval']->value->state;?>
"><?php echo $_smarty_tpl->tpl_vars['state_list']->value[$_smarty_tpl->tpl_vars['dval']->value->state];?>
</td>
             <td><?php if ($_smarty_tpl->tpl_vars['dval']->value->qa_time){?><?php echo $_smarty_tpl->tpl_vars['dval']->value->qa_time;?>
<?php }else{ ?>-<?php }?></td>
             <td class="i-operate">   
                <?php if (in_array(Yii::app()->user->name,$_smarty_tpl->tpl_vars['manWhiteList']->value)){?> 
                <a href="javascript:;" topic="<?php echo $_smarty_tpl->tpl_vars['dval']->value->topic_id;?>
" report_time="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['dval']->value->report_time,"%Y-%m-%d %H:%M:%S");?>
" influence="<?php echo $_smarty_tpl->tpl_vars['dval']->value->influence;?>
" class="man_item" name="<?php echo $_smarty_tpl->tpl_vars['dval']->value->content;?>
" pid="<?php echo $_smarty_tpl->tpl_vars['dval']->value->id;?>
" title="管理">管理</a> | 
                <?php }?>
                <a href="?r=site/edit&id=<?php echo $_smarty_tpl->tpl_vars['dval']->value->id;?>
" title="编辑">编辑</a> |
               <a href="javascript:;" class="del_item" pid="<?php echo $_smarty_tpl->tpl_vars['dval']->value->id;?>
" title="删除">删除</a>
             </td>
        </tr>
    <?php } ?>
  </table>
</div>

</div>
<div class="list-page">
  <div class="i-total">共有相关信息 <b><?php echo $_smarty_tpl->tpl_vars['data']->value['count'];?>
</b> 条</div>
  <div class="i-list" id="slidePage"> 
    <!--     <span><</span>
         <span class="active">1</span>
         <a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><a href="#">></a>  -->
  </div>
  <div class="clear"></div>
</div>
  </div>

<div style="display:none;">
    <p id="statListJson"><?php echo json_encode($_smarty_tpl->tpl_vars['state_list']->value);?>
</p>
    <p id="topicListJson"><?php echo json_encode($_smarty_tpl->tpl_vars['topic_list']->value);?>
</p>
    <p id="count"><?php echo $_smarty_tpl->tpl_vars['data']->value['count'];?>
</p>
    <p id="pagenum"><?php echo $_smarty_tpl->tpl_vars['data']->value['page'];?>
</p>
    <p id="pagesize"><?php echo $_smarty_tpl->tpl_vars['data']->value['pagesize'];?>
</p>
</div>
<script src="static/js/list.js" type="text/javascript"></script> 

<?php echo $_smarty_tpl->tpl_vars['this']->value->endContent();?>

<?php }} ?>