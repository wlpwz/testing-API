<?php
    $this->beginContent('/layouts/main',['current'=>'run']);
?>
<style type="text/css">
    div.innerbox{display: none}
    #taskmask{position:absolute;left:0; top:0;display:none; height:55px; width:100%; background:#666; z-index:999;opacity:0.7; filter:alpha(opacity=40);}
</style>
<div class="col-md-2">
    <dl class="dl-group top-border">
        <dt class="dt-group-title">EC自动化测试</dt>
        <dd class="dd-group-item"><a href="?r=run/localrun">轻松运行</a></dd>
		<dd class="dd-group-item"><a href="?r=ecTask/runmission">任务列表</a></dd>
		<dd class="dd-group-item"><a href="?r=version/index">EC版本管理</a></dd>
    </dl>
</div>
<div class="right-content">
        <?php echo $content; ?>
</div>
<script type="text/javascript" SRC="static/js/leftMenu.js"></script>
<?php $this->endContent(); ?>
