<!DOCTYPE html>
<html>
<head>
   <meta name="baidu-site-verification" content="KjBF2DaOFs" />
    <meta name="baidu-site-verification" content="6fe46ef19124bf1cc8731cd245615644"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>DATA-SAFE需求管理</title>
    <link rel="shortcut icon" href="static/css/sitemap/images/favicon.png"> 
    <!--add for waterfall view-->
    <link rel="stylesheet" href="static/css/sitemap/reset.css" type="text/css" charset="utf-8"> 
    <link rel="stylesheet" href="static/css/sitemap/global.css" type="text/css" charset="utf-8"> 
    <link rel="stylesheet" href="static/css/sitemap/home.css" type="text/css" charset="utf-8">
   <link rel="stylesheet" href="static/lib/dialog/dialog.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="static/css/sitemap/style.css" type="text/css" />
    <link rel="stylesheet" href="static/css/sitemap/jquery.visualize.css" type="text/css">
    <!-- Your Custom Stylesheet --> 
    <link rel="stylesheet" href="static/css/sitemap/custom.css" type="text/css" />
    <link rel="stylesheet" href="static/css/sitemap/sc-sitemap.css" type="text/css" />

    <link rel="stylesheet" href="static/css/sitemap/nav_left.css" type="text/css" charset="utf-8"/>
    
    <link rel="stylesheet" href="static/css/sitemap/bootstrapSwitch.css" type="text/css"/>
<!--    <script language="javascript" src="static/js/jquery-1.7.2.min.js"></script> -->
    <script language="javascript" src="static/lib/Base.js"></script>
    <script language="javascript" src="static/lib/underscore.js"></script>
<!--    <script language="javascript" src="static/lib/backbone.js"></script>  -->
    <script language="javascript" src="static/lib/dialog/dialog.js"></script>
  <!--script type="text/javascript" SRC="static/js/sitemap/swfobject.js"></script-->
  <!-- jQuery with plugins -->
  <script type="text/javascript" SRC="static/js/sitemap/jquery-1.5.2.min.js"></script>
    <script type="text/javascript" src="static/js/sitemap/bootstrapSwitch.js" defer></script>
  <!--script type="text/javascript" SRC="static/js/sitemap/jquery.ui.tabs.min.js"></script-->
  <!-- jQuery tooltips -->
  <script type="text/javascript" SRC="static/js/sitemap/jquery.tipTip.min.js"></script>
  <!-- Superfish navigation -->
  <script type="text/javascript" SRC="static/js/sitemap/jquery.superfish.min.js"></script>
  <script type="text/javascript" SRC="static/js/sitemap/jquery.supersubs.min.js"></script>
  <!-- jQuery form validation -->
  <script type="text/javascript" SRC="static/js/sitemap/jquery.validate_pack.js"></script>
  <!-- jQuery popup box -->
  <script type="text/javascript" SRC="static/js/sitemap/jquery.nyroModal.pack.js"></script>
  <!-- jQuery graph plugins -->
  <script type="text/javascript" SRC="static/js/sitemap/jquery.visualize.js"></script>
  <!--[if IE]><script type="text/javascript" src="js/flot/excanvas.min.js"></script><![endif]-->
  <script type="text/javascript" SRC="static/js/sitemap/flot/jquery.flot.min.js"></script>
  <script type="text/javascript" SRC="static/js/sitemap/flot/jquery.flot.selection.min.js"></script>
  <!-- jQuery data tables -->
  <script type="text/javascript" SRC="static/js/sitemap/jquery.dataTables.js"></script>
  <script type="text/javascript" SRC="static/js/sitemap/jquery.dataTables.min.js"></script>
  <!-- form validator class -->
<!--  <script type="text/javascript" SRC="static/js/formValidatorClass.js"></script>     -->                     
                                                  
  <script type="text/javascript" SRC="static/js/sitemap/page.js"></script>
<!--    <script language="javascript" src="static/js/jquery-1.7.2.min.js"></script>--> 
</head>
<body>
<div class="wrapper">

	<section class="column full first">
		<p>新需求</p>
		<form class="form-horizontal" method="POST" action="?r=requirement/additem">
			<fieldset>
			<div class="control-group">
				<label class="control-label">需求名称:</label>
				<div class="controls">
						<input name="name" type="text" class="span2 inline" style="width:300px" value="" placeholder="完善全部联系方式用户数" maxlength="30"/>
				<!--	<textarea name="name" class="span2 inline" rows="5" style="width:300px" value="" placeholder="完善全部联系方式用户数"></textarea> -->
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">需求描述或MRD:</label>
				<div class="controls">
						<textarea name="file" class="span2 inline" rows="5" style="width:300px" value="" placeholder="http://icafe.url"></textarea>
				<!--	<input name="file" type="text" class="span2 inline" style="width:300px" value="" placeholder="http://icafe.url"/> -->
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">申请人:</label>
				<div class="controls">
					<input name="proposer" id="proposer" class="span2 inline" size="256" type="text" value=""/>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">需求状态:</label>
				<div class="controls">
					<select class="span2 mr10" name="state" id="state">
						<option value="1" selected='true'>新建</option>
						<option value="2">开发中</option>
						<option value="3">已完成</option>
						<option value="4">延后处理</option>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">需求分类:</label>
				<div class="controls">
					<select class="span2 mr10" name="category" id="category">
						<option value="1" selected='true'>平台展现</option>
						<option value="2">校验策略</option>
						<option value="3">统一回灌</option>
						<option value="4">其他</option>
					</select>
				</div>
			</div>
		<!--	      <div class="control-group">
        <label class="control-label">申请时间:</label>
        <div class="controls">
            <input name="create_time" type="text" class="span2 inline" style="width:300px" value="" placeholder="2013/12/19" maxlength="30"/>
        </div>
      </div>
			      <div class="control-group">
        <label class="control-label">更新时间:</label>
        <div class="controls">
            <input name="update_time" type="text" class="span2 inline" style="width:300px" value="" placeholder="2013/12/19" maxlength="30"/>
        </div>
      </div>  -->

			<div class="control-group">
				<div class="controls">
					<button class="btn btn-mini btn-primary reset_btn" id="btn_save" type="submit">保存</button>
					<button class="btn btn-mini reset_btn_gray" id="btn_cancel" type="button">取消</button>
				</div>
			</div>
			</fieldset>
		</form>
	</section>
			
</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#btn_cancel').bind('click', function(){
      window.location.href = "?r=requirement/list";
    });
		$('#proposer').val("{%Yii::app()->user->name%}");
	});
</script>
