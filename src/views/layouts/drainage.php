<?php
    $this->beginContent('/layouts/main',['current'=>'run']);
?>
<style type="text/css">
    div.innerbox{display: none}
    #taskmask{position:absolute;left:0; top:0;display:none; height:55px; width:100%; background:#666; z-index:999;opacity:0.7; filter:alpha(opacity=40);}
</style>
<div class="col-md-2">
    <dl class="dl-group top-border">
        <dt class="dt-group-title">数据引流</dt>
        <dd class="dd-group-item"><a href="?r=drainage/index">引流任务申请</a></dd>
		<dd class="dd-group-item"><a href="?r=drainage/monitor">引流任务监控</a></dd>
    </dl>
</div>
<div class="right-content">
        <?php echo $content; ?>
</div>
<script type="text/javascript" SRC="static/js/leftMenu.js"></script>
<?php $this->endContent(); ?>
