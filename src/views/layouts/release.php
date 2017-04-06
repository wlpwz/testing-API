<?php
    $this->beginContent('/layouts/main',['current'=>'release']);
?>
<style type="text/css">
    div.innerbox{display: none}
    #taskmask{position:absolute;left:0; top:0;display:none; height:55px; width:100%; background:#666; z-index:999;opacity:0.7; filter:alpha(opacity=40);}
</style>
<div class="col-md-2">
	<dl class="dl-group">
		<dt class="dt-group-title">DC词典管理</dt>
		<dd class="dd-group-item"><a href="?r=dictionary/index">词典提交申请</a></dd>
		<dd class="dd-group-item"><a href="?r=dictionary/task">词典提交结果</a></dd>
		<dd class="dd-group-item"><a href="?r=dictversion/page_weight_zwversion">中文词典版本管理</a></dd>
		<dd class="dd-group-item"><a href="?r=dictversion/page_weight_hkversion">国际化词典版本管理</a></dd>
	</dl>
</div>
<div class="right-content">
        <?php echo $content; ?>
</div>
<script type="text/javascript" SRC="static/js/leftMenu.js"></script>
<?php $this->endContent(); ?>
