<?php /* Smarty version Smarty 3.1.4, created on 2014-03-30 07:28:12
         compiled from "/home/work/pop-b1/src/views/layouts/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:129961085553361d3f8fbcc7-76404479%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c367415264fe97a84a5f5e3ef2d91324489c798c' => 
    array (
      0 => '/home/work/pop-b1/src/views/layouts/main.tpl',
      1 => 1396135682,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '129961085553361d3f8fbcc7-76404479',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_53361d3f9f241',
  'variables' => 
  array (
    'pid' => 0,
    'plat' => 0,
    'current' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53361d3f9f241')) {function content_53361d3f9f241($_smarty_tpl) {?><!DOCTYPE html>
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">    
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>产品运营监控平台</title>
		
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS Global Compulsory-->
    <link rel="stylesheet" href="static/css/bootstrap.min.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="static/css/style.css" type="text/css" charset="utf-8">  
		<link rel="stylesheet" href="static/css/layout.css" type="text/css" charset="utf-8">  
    <link rel="stylesheet" href="static/css/header1.css" type="text/css" charset="utf-8">     
    <link rel="stylesheet" href="static/css/responsive.css" type="text/css" charset="utf-8">  
    <!-- CSS Implementing Plugins -->    
    <link rel="stylesheet" href="static/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="static/plugins/flexslider/flexslider.css">     
    <link rel="stylesheet" href="static/plugins/parallax-slider/css/parallax-slider.css">  
    <!-- CSS Theme -->    
    <link rel="stylesheet" href="static/css/themes/default.css" id="style_color">
		<link rel="shortcut icon" href="static/img/favicon.ico">

		<!-- custom css style sheet -->
		<link rel="stylesheet" href="static/css/pop.css" type="text/css" charset="utf-8">
		
		<script type="text/javascript" src="static/js/jquery-1.10.2.min.js"></script>

		<body>
		<!--=== Top ===-->    
					<div class="top">
    						<div class="container">         
        							<ul class="loginbar pull-right">
            								<li class="devider">
																	<?php if (Yii::app()->user->isGuest){?>
																			<a href="javascript:;">Guest</a>
																	<?php }else{ ?>
                                                                           <input type="hidden" id="pid" value="<?php echo Yii::app()->platform->sePid;?>
"/>
																			<a href="javascript:;"><?php echo Yii::app()->user->name;?>
</a>
																	<?php }?>
														</li>   
            								<li><a href="#">帮助</a></li>                                                  
            								<li class="devider"></li>   
            								<li>
																	<?php if (Yii::app()->user->isGuest){?>
																	<a href="?r=auth/index">登录</a>
																	<?php }else{ ?>
																	<a href="?r=auth/logout">退出</a>
																	<?php }?>
														</li>    
        							</ul>
    						</div>
					</div><!--/top-->
		<!--=== End Top ===-->
    <!--=== Header ===-->    
    <div class="header">
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="?r=site/index">
                        <img id="logo-header" src="static/img/pop.jpg" alt="Logo">
                    </a>
                    <div class="navbar-header-tab">
                        <span class="header-tab" id="header-tab">
                            <?php echo Yii::app()->platform->pSet[Yii::app()->platform->sePid];?>

                            <a href="javascript:;" class="header-tab-link">[切换平台]</a>
                        </span>
                        <ul class="navbar-header-tab-ul">
                        <?php  $_smarty_tpl->tpl_vars['plat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['plat']->_loop = false;
 $_smarty_tpl->tpl_vars['pid'] = new Smarty_Variable;
 $_from = Yii::app()->platform->pSet; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['plat']->key => $_smarty_tpl->tpl_vars['plat']->value){
$_smarty_tpl->tpl_vars['plat']->_loop = true;
 $_smarty_tpl->tpl_vars['pid']->value = $_smarty_tpl->tpl_vars['plat']->key;
?>
                            <li class="navbar-header-tab-li"><a href="?r=report/index&pid=<?php echo $_smarty_tpl->tpl_vars['pid']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['plat']->value;?>
</a></li>
                        <?php } ?>  
                        </ul> 
                    </div>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-responsive-collapse navbar-right">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown <?php if ($_smarty_tpl->tpl_vars['current']->value=="home"){?>active<?php }?>">
                            <a href="?r=site/index">
                                首页
                            </a>
                        </li>
                        <li class="dropdown <?php if ($_smarty_tpl->tpl_vars['current']->value=="target"){?>active<?php }?>">
                            <a href="?r=userlog/index&pid=<?php echo Yii::app()->platform->sePid;?>
">
                                产品指标监控
                            </a>
                        </li>
                        <li class="dropdown <?php if ($_smarty_tpl->tpl_vars['current']->value=="system"){?>active<?php }?>">
                            <a href="?r=backend/task&pid=<?php echo Yii::app()->platform->sePid;?>
">
                                系统风险监控
                            </a>
                        </li>
                    <!--    <li class="dropdown">
                            <a href="http://htmlstream.com/preview/unify/index.html#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">
                                用户行为分析
                                <i class="icon-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="http://htmlstream.com/preview/unify/portfolio_text_blocks.html">Portfolio Text Blocks</a></li>
                                <li><a href="http://htmlstream.com/preview/unify/portfolio_2_column.html">Portfolio 2 Columns</a></li>
                            </ul>
                        </li>  -->
                        <li class="dropdown <?php if ($_smarty_tpl->tpl_vars['current']->value=="monitem"){?>active<?php }?>">
                            <a href="?r=monitem/list">
                                平台管理
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">
                                关于我们
                            </a>
                        </li>                    
                        <li class="hidden-sm"><a class="search"><i class="fa fa-search search-btn"></i></a></li>
                    </ul>
                    <div class="search-open">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button class="btn-u" type="button">搜索</button>
                            </span>
                        </div><!-- /input-group -->
                    </div>                
                </div><!-- /navbar-collapse -->

            </div>    
        </div>    
    </div><!--/header-->
    <!--=== End Header ===-->    

    <!--=== Content ===-->  
		<div class="content pop">
          <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		</div>
    <!--=== Content ===-->  

    <!--=== Footer ===-->
    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4 md-margin-bottom-40">
                    <!-- About -->
                <div class="headline"><h2>关于</h2></div>  
            <p class="margin-bottom-25 md-margin-bottom-40">产品运营监控平台（POP），致力于平台运营分析与监控，这里不仅有诸如PV/UV的分析数据，还有系统运行的监控数据，更有基于数据的无限产品灵感。</p>  

          </div><!--/col-md-4-->  
          
      <!--    <div class="col-md-4 md-margin-bottom-40">
                    <div class="posts">
                        <div class="headline"><h2>Recent Blog Entries</h2></div>
                        <dl class="dl-horizontal">
                            <dt><a href="http://htmlstream.com/preview/unify/index.html#"><img src="./Unify   Welcome..._files/6(1).jpg" alt=""></a></dt>
                            <dd>
                                <p><a href="http://htmlstream.com/preview/unify/index.html#">Anim moon officia Unify is an incredibly beautiful responsive Bootstrap Template</a></p> 
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                        <dt><a href="http://htmlstream.com/preview/unify/index.html#"><img src="./Unify   Welcome..._files/10(1).jpg" alt=""></a></dt>
                            <dd>
                                <p><a href="http://htmlstream.com/preview/unify/index.html#">Anim moon officia Unify is an incredibly beautiful responsive Bootstrap Template</a></p> 
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                        <dt><a href="http://htmlstream.com/preview/unify/index.html#"><img src="./Unify   Welcome..._files/11.jpg" alt=""></a></dt>
                            <dd>
                                <p><a href="http://htmlstream.com/preview/unify/index.html#">Anim moon officia Unify is an incredibly beautiful responsive Bootstrap Template</a></p> 
                            </dd>
                        </dl>
                    </div>
          </div>--><!--/col-md-4-->

          <div class="col-md-4">
                  <!-- Monthly Newsletter -->
                <div class="headline"><h2>联系我们</h2></div> 
                    <address class="md-margin-bottom-40">
              Baidu Hi: <a href="baidu://message/?id=雨西119">杨玲玲</a>
												<a href="baidu://message/?id=xjzh67255">张晓杰</a>
												<a href="baidu://message/?id=dabaohi">刘宝国</a></br>
              Email: <a href="mailto:info@anybiz.com" class="">testing-sitemap@baidu.com</a>
                    </address>

                    <!-- Stay Connected -->
              <!--  <div class="headline"><h2>Stay Connected</h2></div> 
                    <ul class="social-icons">
                        <li><a href="http://htmlstream.com/preview/unify/index.html#" data-original-title="Feed" class="social_rss"></a></li>
                        <li><a href="http://htmlstream.com/preview/unify/index.html#" data-original-title="Facebook" class="social_facebook"></a></li>
                        <li><a href="http://htmlstream.com/preview/unify/index.html#" data-original-title="Twitter" class="social_twitter"></a></li>
                        <li><a href="http://htmlstream.com/preview/unify/index.html#" data-original-title="Goole Plus" class="social_googleplus"></a></li>
                        <li><a href="http://htmlstream.com/preview/unify/index.html#" data-original-title="Pinterest" class="social_pintrest"></a></li>
                        <li><a href="http://htmlstream.com/preview/unify/index.html#" data-original-title="Linkedin" class="social_linkedin"></a></li>
                        <li><a href="http://htmlstream.com/preview/unify/index.html#" data-original-title="Vimeo" class="social_vimeo"></a></li>
                    </ul> -->
          </div><!--/col-md-4-->
					<div class="col-md-4">
                  <!-- Monthly Newsletter -->
                <div class="headline"><h2>友情链接</h2></div>
                    <address class="md-margin-bottom-40">
              					 <a href="http://sitemap-qa.baidu.com/" target="_blank">站长平台监控中心</a>
												 <a class="mar5" href="http://hunter.baidu.com/" target="_blank">Hunter</a>
												 <a class="mar5" href="http://log.baidu.com/" target="_blank">Log平台</a>
                    </address>

          </div><!--/col-md-4-->


        </div><!--/row--> 
      </div><!--/container--> 
    </div><!--/footer-->  
    <!--=== End Footer ===-->

    <!--=== Copyright ===-->
    <div class="copyright">
      <div class="container">
        <div class="row">
          <div class="col-md-6">            
                  <p class="copyright-space">
                        2014 © Baidu QA. ALL Rights Reserved. 
                    </p>
          </div>
					<!--
          <div class="col-md-6">  
            <a href="#">
                        <img id="logo-footer" src="static/img/logo2-default.png" class="pull-right" alt="">
                    </a>
          </div>  -->
        </div><!--/row-->
      </div><!--/container--> 
    </div><!--/copyright--> 
    <!--=== End Copyright ===-->
<div style="display:none;">
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F564396f6b71e005c2702a6e4057acbdf' type='text/javascript'%3E%3C/script%3E"));</script>
</div>
		
<!-- JS Global Compulsory -->
<script type="text/javascript" async="" src="static/js/ga.js"></script>
<script type="text/javascript" src="static/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="static/js/bootstrap.min.js"></script>
<script type="text/javascript" src="static/js/hover-dropdown.min.js"></script>
<script type="text/javascript" src="static/js/back-to-top.js"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="static/plugins/flexslider/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="static/plugins/parallax-slider/js/modernizr.js"></script>
<script type="text/javascript" src="static/plugins/parallax-slider/js/jquery.cslider.js"></script>
<!--<script type="text/javascript" src="static/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="static/js/jquery.dataTables.bootstrap.js"></script> -->
<!-- JS Page Level -->
<script type="text/javascript" src="static/js/app.js"></script>
<script type="text/javascript" src="static/js/index.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        App.initSliders();
        Index.initParallaxSlider();

			  //默认选中当前访问的url
    		$(".dl-group dd a").each(function(){
        		var url = window.location.href; 
		    		var pattern = /(\?r=[\w|\/]+[#|&]{0,1})/;
        		var rs = pattern.exec(url);
        		var compare = (rs===null)?'':(rs[0].replace(/[#|&]$/,''));
      	
						var uparam = url.split("?"); 			
						var	urlstr = decodeURIComponent("?" + uparam[1]);		

			  		if(urlstr != $(this).attr('href')){
            		$(this).parent().removeClass("dd-active");
        		}else{
            		$(this).parent().addClass("dd-active");
        		}
    		});

    });
</script>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-29166220-1']);
  _gaq.push(['_setDomainName', 'htmlstream.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

<script type="text/javascript">
    (function(){
        $('#header-tab').delegate('.header-tab-link', 'click', function(){
            $('.navbar-header-tab-ul').slideToggle();
        });

       /* $('select[name="pid"]').bind('change', function(){
            var url = window.location.href;
            var uArray = url.split("&"); 
            var pid = $(this).val();
            window.location.href = uArray[0] + "&pid=" + pid;
        });  */
    })();
</script>
</body>
</html>

<?php }} ?>