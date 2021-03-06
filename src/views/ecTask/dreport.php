<?php
/* @var $this TstaskController */
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
<div class="search-form" style="display:none">
<?php $this->renderPartial('_compilesearch',array(
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
                'user',
        		'time',
				'status',
                'new_version',
                'old_version',
                'host_name',
				'log_path',
				'new_output_path',
				'old_output_path',
				'new_module_list',
				'old_module_list',
				
    ),
)); ?>
</div>
</div>
</div>
</div>
<script>
</script>
