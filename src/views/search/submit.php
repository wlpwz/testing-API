<?php
        $r['topic'] = "search";
        $this->beginContent('/layouts/1',array('topic'=>$r));
?>
<div class="container" id="main_view">
	<span >输入Url:&nbsp;&nbsp;<span><input type=text size="150" id="text" /> <button class="btn btn-primary">提交</button>
</div>

<?php $this->endContent(); ?>

