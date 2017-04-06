<?php
/* @var $this TstaskController */
/* @var $model TsTaskInfo */
/* @var $form CActiveForm */
?>
<!-- <div class="span12 inner">
<div class="box dark"> -->
<!-- <div class="body"> -->
<div>

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>
<br>

    <div class="row-fluid">
        <span class="span2">
                <?php echo $form->label($model,'id'); ?>
        </span>
        <span class="span4">
                <?php echo $form->textField($model,'id'); ?>
        </span>
        <span class="span2">
                <?php echo $form->label($model,'user'); ?>
        </span>
        <span class="span4">
                <?php echo $form->textField($model,'user',array('size'=>50,'maxlength'=>50)); ?>
        </span>
    </div>

    <div class="row-fluid">
        <span class="span2">
        <?php echo $form->label($model,'new_version'); ?>
        </span>
        <span class="span4">
        <?php echo $form->textField($model,'new_version',array('size'=>50,'maxlength'=>50)); ?>
        </span>
        <span class="span2">
        <?php echo $form->label($model,'old_versoin'); ?>
        </span>
        <span class="span4">
        <?php echo $form->textField($model,'old_version',array('size'=>50,'maxlength'=>50)); ?>
        </span>
    </div>

    <div class="row-fluid">
        <span class="span2">
        <?php echo $form->label($model,'new_output_path'); ?>
        </span>
        <span class="span4">
        <?php echo $form->textField($model,'new_output_path',array('size'=>50,'maxlength'=>50)); ?>
        </span>
        <span class="span2">
        <?php echo $form->label($model,'old_output_path'); ?>
        </span>
        <span class="span4">
        <?php echo $form->textField($model,'old_output_path',array('size'=>50,'maxlength'=>50)); ?>
        </span>
    </div>
    <div class="row-fluid buttons">
        <span class="span10"></span>
        <span class="span2">
                <?php echo CHtml::submitButton('Search',array('class'=>'btn btn-info')); ?>
        </span>
     </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
<!-- </div>
</div> -->
