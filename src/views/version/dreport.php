<?php
/* @var $model TsTaskInfo */

$current_user=Yii::app()->user->name;
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#ts-task-info-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
    });
");
?>


<div class="span12 inner">
<div class="box dark">
<div class="body">
<h1><?php echo $admin_title?></h1>
<p>
可使用 (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) 进行组合查询.
</p>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<span></span>
<button class="btn btn-primary" id="add-button" type="button" >增加版本项</button>
<div class="add-form" style="display:none">
<?php echo $this->renderPartial('_add', array('model'=>$model)); ?>
</div>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
      'model'=>$model,
)); ?>

</div><!-- search-form -->
<div style="Overflow:auto">
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'ts-task-info-grid',
    // 'dataProvider'=>$model->search(),
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
                'id',
                'version',
        		'language',
                'ecc_version',
                'framework_version',
                'pagevalue_version',
                'is_splited',
    ),
)); ?>
</div>
</div>
</div>
</div>
<script>
	function add_item(){

    	$('.add-form').toggle();
   		 return false;

}
	$(document).ready(function(){
		$('#add-button').bind('click',function(){
			$('.add-form').toggle();
			return false;
		});
		$('#create').bind('click',function(){
				var sendData;
				var version = $('#EcVersionControl_version').val();
				var language = $('#EcVersionControl_language').val();
				var ecc_version = $('#EcVersionControl_ecc_version').val();
				var framework_version = $('#EcVersionControl_framework_version').val();
				var pagevalue_version = $('#EcVersionControl_pagevalue_version').val();
				var is_splited = $('#EcVersionControl_is_splited').val();
				sendData = {version: version, language: language, ecc_version: ecc_version,framework_version:framework_version,pagevalue_version:pagevalue_version,is_splited:is_splited};
				console.log(sendData);
				$.ajax({
					type: "POST",
					url: "/?r=version/create",
					dataType: "json",
					data: sendData,
					success: function(data){
						if(data.status == 1){
							alert("保存成功！");
							window.location.reload();
						}else{
							alert("保存失败！");
						}
					}
				});
		});
	}); 

</script>
