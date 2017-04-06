<?php /* Smarty version Smarty 3.1.4, created on 2014-05-28 16:37:40
         compiled from "/home/work/ec_test_service/src/views/run/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:51689963853859e95eca517-05163273%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '37756c0a5dda9e636ee06c89ba71704f3cdfcd57' => 
    array (
      0 => '/home/work/ec_test_service/src/views/run/index.tpl',
      1 => 1401266244,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '51689963853859e95eca517-05163273',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53859e95f3a99',
  'variables' => 
  array (
    'r' => 0,
    'this' => 0,
    'topic_list' => 0,
    'topic' => 0,
    'state_list' => 0,
    'state' => 0,
    'keyword' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53859e95f3a99')) {function content_53859e95f3a99($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/work/ec_test_service/src/vendors/Smarty/plugins/function.html_options.php';
?>
<?php $_smarty_tpl->createLocalArrayVariable('r', null, 0);
$_smarty_tpl->tpl_vars['r']->value['topic'] = "run";?>
<?php echo $_smarty_tpl->tpl_vars['this']->value->beginContent('/layouts/main',array('topic'=>$_smarty_tpl->tpl_vars['r']->value));?>


<?php $_smarty_tpl->tpl_vars['manWhiteList'] = new Smarty_variable(array('zhanghao15','baiyang03'), null, 0);?>  


<!--<div class="page-title"><i class="i_icon"></i> EC 基本参数配置 </div>
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
</div>
-->
<div>
</div>











</div>
<div class="list-page">
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