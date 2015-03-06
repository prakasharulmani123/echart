<?php
/* @var $this UserprofileController */
/* @var $model UserProfile */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'prof_id'); ?>
		<?php echo $form->textField($model,'prof_id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_firstname'); ?>
		<?php echo $form->textField($model,'prof_firstname',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_lastname'); ?>
		<?php echo $form->textField($model,'prof_lastname',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_position'); ?>
		<?php echo $form->textField($model,'prof_position',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_department'); ?>
		<?php echo $form->textField($model,'prof_department',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_personal_staff'); ?>
		<?php echo $form->textField($model,'prof_personal_staff',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_phone'); ?>
		<?php echo $form->textField($model,'prof_phone',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_mobile'); ?>
		<?php echo $form->textField($model,'prof_mobile',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_fax'); ?>
		<?php echo $form->textField($model,'prof_fax',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_office'); ?>
		<?php echo $form->textField($model,'prof_office',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_site'); ?>
		<?php echo $form->textField($model,'prof_site',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_sheet_position'); ?>
		<?php echo $form->textField($model,'prof_sheet_position',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_site_2'); ?>
		<?php echo $form->textField($model,'prof_site_2',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_phone_2'); ?>
		<?php echo $form->textField($model,'prof_phone_2',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_structure_code'); ?>
		<?php echo $form->textField($model,'prof_structure_code',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_department_2'); ?>
		<?php echo $form->textField($model,'prof_department_2',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_company'); ?>
		<?php echo $form->textField($model,'prof_company',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_hierarchy'); ?>
		<?php echo $form->textField($model,'prof_hierarchy',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_code_site'); ?>
		<?php echo $form->textField($model,'prof_code_site',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prof_sheet_structrure'); ?>
		<?php echo $form->textField($model,'prof_sheet_structrure',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->