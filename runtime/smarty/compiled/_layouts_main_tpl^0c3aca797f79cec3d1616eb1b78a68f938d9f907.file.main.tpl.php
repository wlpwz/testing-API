<?php /* Smarty version Smarty 3.1.4, created on 2014-05-22 21:21:50
         compiled from "/home/work/project-ktv/src/views/layouts/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:87308856653393fa33b34a2-29899375%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c3aca797f79cec3d1616eb1b78a68f938d9f907' => 
    array (
      0 => '/home/work/project-ktv/src/views/layouts/main.tpl',
      1 => 1400763177,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '87308856653393fa33b34a2-29899375',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53393fa34dfd2',
  'variables' => 
  array (
    'topic' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53393fa34dfd2')) {function content_53393fa34dfd2($_smarty_tpl) {?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>WD项目管理平台</title>
<link href="static/css/style.css" rel="stylesheet" type="text/css">
 <link href="static/css/project.css" rel="stylesheet" type="text/css">
<script src="static/js/jquery-1.9.1.js"></script>
<script src="static/js/common.js" type="text/javascript"></script>
<script src="static/js/page.js" type="text/javascript"></script>
<script src="static/js/poplayer.js" type="text/javascript"></script>
</head>
<body>
<div class="layout_header">
  <div class="header">
    <div class="h_logo"><a href="?r=site/index" title="业务监控平台"><img src="static/images/qaup_logo.png" width="130" height="40"  alt=""/></a></div>
    <div class="h_nav"> <span class="hi"><img src="static/images/head_default.jpg" alt="id"/> Hello，<?php echo Yii::app()->user->name;?>
</span><span class="link"><a href="#"><i class="icon16 icon16-setting"></i> 设置</a><a href="?r=auth/logout"><i class="icon16 icon16-power"></i> 注销</a></span> </div>
    <div class="clear"></div>
  </div>
</div>


<div class="layout_leftnav">
  <div class="inner">
    <div class="nav-vertical">
  <ul class="accordion">
    <li id="one"> <a href="#one">项目管理<span></span></a>
      <ul class="sub-menu">
       <!-- <li><a href="#">内部项目管理</a></li>  -->
        <li><a href="?r=site/index&topic=1" <?php if ($_smarty_tpl->tpl_vars['topic']->value==1){?>class="active"<?php }?>>WD知识库</a></li>
        <li><a href="?r=site/index&topic=2" <?php if ($_smarty_tpl->tpl_vars['topic']->value==2){?>class="active"<?php }?>>WD服务平台</a></li>
        <li><a href="?r=site/index&topic=3" <?php if ($_smarty_tpl->tpl_vars['topic']->value==3){?>class="active"<?php }?>>数据价值挖掘</a></li>
        <li><a href="?r=site/index&topic=5" <?php if ($_smarty_tpl->tpl_vars['topic']->value==5){?>class="active"<?php }?>>页面解析服务</a></li>
        <li><a href="?r=site/index&topic=4" <?php if ($_smarty_tpl->tpl_vars['topic']->value==4){?>class="active"<?php }?>>站长平台</a></li>
      </ul>
    </li>
  <!--  <li id="two"> <a href="#two">成员管理<span></span></a>
      <ul class="sub-menu">
        <li><a href="#">经销商管理</a></li>
        <li><a href="#">组织管理</a></li>
        <li><a href="#">岗位管理</a></li>
      </ul>
    </li>
    <li id="three"> <a href="#three">线下培训<span></span></a>
      <ul class="sub-menu">
        <li><a href="#">培训列表</a></li>
        <li><a href="#">预备培训</a></li>
      </ul>
    </li>
    <li id="four"> <a href="#four">个人设置<span></span></a>
      <ul class="sub-menu">
        <li><a href="#">个人信息</a></li>
        <li><a href="#">通知设置</a></li>
        <li><a href="#">退出系统</a></li>
      </ul>
    </li>   -->
  </ul>
  <script type="text/javascript">
		$(document).ready(function() {
			// Store variables
			var accordion_head = $('.accordion > li > a'),
				accordion_body = $('.accordion li > .sub-menu');
			// Open the first tab on load
			accordion_head.first().addClass('active').next().slideDown('normal');
			// Click function
			accordion_head.on('click', function(event) {
				// Disable header links
				event.preventDefault();
				// Show and hide the tabs on click
				if ($(this).attr('class') != 'active'){
					accordion_body.slideUp('normal');
					$(this).next().stop(true,true).slideToggle('normal');
					accordion_head.removeClass('active');
					$(this).addClass('active');
				}
			});
		});
	</script> 
</div>
  </div>
</div>
<div class="layout_rightmain">
  <div class="inner">
    <!--=== Content ===-->  
          <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

    <!--=== Content ===-->  
   <!-- <div class="page-title"><i class="i_icon"></i> 个人信息 </div>
    <div class="pd20 left">
      <div class="alert alert-welcome">
        <div class="i-title">你好！欢迎登录百度平台。</div>
        <div class="i-info">上次登录时间：2013-10-15</div>
        <div class="i-data">发布信息：<b>128</b> | 已解决问题：<b >12</b> | 未解决问题：<b>191</b></div>
      </div>
      <div class="panel mt20">
        <div class="panel-header">最新消息</div>
        <div class="panel-main pd0x10">
          <div class="list-title">
            <ul>
              <li><span class="i-time">2013-10-11</span><i class="icon16 icon16-li"></i><a href="#">山西省委附近爆炸案告破 41岁嫌犯被抓</a></li>
              <li><span class="i-time">2013-10-11</span><i class="icon16 icon16-li"></i><a href="#">人民日报整版阐释习近平"两个不能否定"</a></li>
              <li><span class="i-time">2013-10-11</span><i class="icon16 icon16-li"></i><a href="#">李克强：地方政府改革是一场自我革命</a></li>
              <li><span class="i-time">2013-10-11</span><i class="icon16 icon16-li"></i><a href="#">外媒：中国“神秘”无人机曝光引轰动</a></li>
              <li><span class="i-time">2013-10-11</span><i class="icon16 icon16-li"></i><a href="#">路透社：北约司令压土耳其弃买中国“红旗”-9</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>  -->
  </div>
</div>



<div class="layout_footer">&copy; 2013-2014 Baidu.com 百度公司版权所有</div>
</body>
</html>
<?php }} ?>