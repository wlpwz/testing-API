<!--<script type="text/javascript" src="static/js/c2c_item_list.js" charset="utf-8"></script>-->
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
    <link rel="stylesheet" href="static/lib/My97DatePicker/skin/WdatePicker.css" type="text/css" charset="utf-8"> 
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

  <!--swfobject - needed only if you require <video> tag support for older browsers -->
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
		<br/>
        <H3 align="center">DATA-SAFE需求管理</H2>
        <br/>
		<div class="controls-row">
				 <div class="mr10" style="display:inline;">
							<input class="span2" id="keyword" type="text" value="{%$keyword%}">
				 </div>
				 <button class="btn btn-primary" type="button" id="search_btn">查询</button>
				&nbsp;&nbsp;
				 <button class="btn btn-info" type="button" id="new_requirement">新建需求</button>
		</div>

		<table id="select_sitemap" class="table table-bordered table-striped table-hover valignM" style="width:1000px;">
		 <thead>
				<tr class="info">
					<th width="5%">ID</th>
					<th width="10%">需求名称</th>
					<th width="20%">需求描述或MRD</th>
					<th width="8%">分类</th>
					<th width="10%">申请人</th>
					<th width="10%">申请时间</th>
					<th width="5%">状态</th>
					<th width="10%">更新人</th>
					<th width="10%">更新时间</th>
					<th width="5%">操作</th>
          <th width="7%">发送邮件</th>
				</tr>
			</thead>
			<tbody>
			{%foreach $list as $item%}
				<tr>
						<td>{%$item->id%}</td>
						<td>{%$item->name%}</td>
						<td>{%$item->file%}</td>
						<td>{%$categoryList[$item->category]%}</td>
						<td>{%$item->proposer%}</td>
						<td>{%date("Y-m-d", $item->create_time)%}</td>
						<td style="background-color:{%$bgColorList[$item->state]%}"><font color='white'>{%$stateList[$item->state]%}</font></td>
						<td>{%$item->update_user%}</td>
						<td>{%date("Y-m-d", $item->update_time)%}</td>
						<td>
						{%if Yii::app()->user->name|in_array:array("yangyanhong", "zhoumeiting","haolifei","tangxing","huyuanyuan01","chenping01","lishuo02")%}
							<button class="btn btn-mini btn-primary reset_btn_gray editor" type="button" item_id="{%$item->id%}">编辑</button>
						{%/if%}
						</td>
             <td> 
            {%if Yii::app()->user->name|in_array:array("yangyanhong", "zhoumeiting","haolifei","tangxing","huyuanyuan01","lishuo02")%}
              <button class=" btn-primary" type="button" item_id="{%$item->id%}" onclick="javascript:window.location.href='?r=requirement/email&name={%$item->name%}&proposer={%$item->proposer%}&state={%$item->state%}&updater={%$item->update_user%}'">发送</button>
            {%/if%}
            </td>
				</tr>
			{%/foreach%}
			</tbody>
	</table>
	<div class="pagination pagination-right" id="slidePage"></div>
	
	</section>
	<div class="no-display" id="count">{%$count%}</div>
	<div class="no-display" id="pagenum">{%$page%}</div>
	<div class="no-display" id="pagesize">{%$pagesize%}</div>
	<div class="no-display" id="offset">{%$offset%}</div>
	
</div>
</body>
</html>
<script type="text/javascript" src="static/js/sitemap/requirement_list.js" charset="utf-8"></script>
<script type="text/javascript">
  $('#select_sitemap').dataTable({'bAutoWidth':false, 'aaSorting':[[0,'desc']]});
	$(document).ready(function(){
		$('#new_requirement').click(function() {
			window.location.href="?r=requirement/add";
		});
	});
</script>
