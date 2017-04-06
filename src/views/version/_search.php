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
                <?php echo $form->label($model,'version'); ?>
        </span>
        <span class="span4">
                <?php echo $form->textField($model,'version',array('size'=>50,'maxlength'=>50)); ?>
        </span>
    </div>

    <div class="row-fluid">
        <span class="span2">
        <?php echo $form->label($model,'language'); ?>
        </span>
        <span class="span4">
        <?php echo $form->textField($model,'language'); ?>
        </span>
        <span class="span2">
        <?php echo $form->label($model,'ecc_version'); ?>
        </span>
        <span class="span4">
        <?php echo $form->textField($model,'ecc_version'); ?>
        </span>
    </div>

    <div class="row-fluid">
        <span class="span2">
        <?php echo $form->label($model,'framework_version'); ?>
        </span>
        <span class="span4">
        <?php echo $form->textField($model,'framework_version',array('size'=>24,'maxlength'=>32)); ?>
        </span>
        <span class="span2">
        <?php echo $form->label($model,'pagevalue_version'); ?>
        </span>
        <span class="span4">
        <?php echo $form->textField($model,'pagevalue_version',array('size'=>24,'maxlength'=>32)); ?>
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
