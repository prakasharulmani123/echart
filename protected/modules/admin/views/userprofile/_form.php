<?php
/* @var $this UserprofileController */
/* @var $model UserProfile */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-profile-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_firstname'); ?>
		<?php echo $form->textField($model,'prof_firstname',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'prof_firstname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_lastname'); ?>
		<?php echo $form->textField($model,'prof_lastname',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'prof_lastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_position'); ?>
		<?php echo $form->textField($model,'prof_position',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'prof_position'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_department'); ?>
		<?php echo $form->textField($model,'prof_department',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'prof_department'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_personal_staff'); ?>
		<?php echo $form->textField($model,'prof_personal_staff',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'prof_personal_staff'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_phone'); ?>
		<?php echo $form->textField($model,'prof_phone',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'prof_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_mobile'); ?>
		<?php echo $form->textField($model,'prof_mobile',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'prof_mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_fax'); ?>
		<?php echo $form->textField($model,'prof_fax',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'prof_fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_office'); ?>
		<?php echo $form->textField($model,'prof_office',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'prof_office'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_site'); ?>
		<?php echo $form->textField($model,'prof_site',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'prof_site'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_sheet_position'); ?>
		<?php echo $form->textField($model,'prof_sheet_position',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'prof_sheet_position'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_site_2'); ?>
		<?php echo $form->textField($model,'prof_site_2',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'prof_site_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_phone_2'); ?>
		<?php echo $form->textField($model,'prof_phone_2',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'prof_phone_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_structure_code'); ?>
		<?php echo $form->textField($model,'prof_structure_code',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'prof_structure_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_department_2'); ?>
		<?php echo $form->textField($model,'prof_department_2',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'prof_department_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_company'); ?>
		<?php echo $form->textField($model,'prof_company',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'prof_company'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_hierarchy'); ?>
		<?php echo $form->textField($model,'prof_hierarchy',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'prof_hierarchy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_code_site'); ?>
		<?php echo $form->textField($model,'prof_code_site',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'prof_code_site'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prof_sheet_structrure'); ?>
		<?php echo $form->textField($model,'prof_sheet_structrure',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'prof_sheet_structrure'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->