<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>
<br>

    <div class="row-fluid">
        <span class="span2">
                <?php echo $form->label($model,'version'); ?>
        
                <?php echo $form->textField($model,'version',array('size'=>10,'maxlength'=>10)); ?>
        </span>
   
        <span class="span2">
        <?php echo $form->label($model,'language'); ?>
        
        <?php echo $form->textField($model,'language'); ?>
        </span>
        <span class="span2">
        <?php echo $form->label($model,'ecc_version'); ?>
        </span>
        <span class="span2">
        <?php echo $form->textField($model,'ecc_version'); ?>
        </span>
   
        <span class="span2">
        <?php echo $form->label($model,'framework_version'); ?>
        </span>
        <span class="span2">
        <?php echo $form->textField($model,'framework_version',array('size'=>10,'maxlength'=>10)); ?>
        </span>
		
        <span class="span2">
        <?php echo $form->label($model,'pagevalue_version'); ?>
        </span>
        <span class="span2">
        <?php echo $form->textField($model,'pagevalue_version',array('size'=>10,'maxlength'=>10)); ?>
        </span>
		<span class="span2">
        <?php echo $form->label($model,'is_splited'); ?>
        </span>
        <span class="span2">
        <?php echo $form->textField($model,'is_splited',array('size'=>10,'maxlength'=>10)); ?>
        </span>
    </div>
    <div class="row-fluid buttons">
        <span class="span10"></span>
        <span class="span2">
  				<button class="btn btn-info" type="button" id='create' value="Create">Create</button>
  				<button class="btn btn-info" type="reset" id='reset' value="Reset">Reset</button>
        </span>
     </div>

<?php $this->endWidget(); ?>

</div>
