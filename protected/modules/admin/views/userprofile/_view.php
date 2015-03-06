<?php
/* @var $this UserprofileController */
/* @var $data UserProfile */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->prof_id), array('view', 'id'=>$data->prof_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_firstname')); ?>:</b>
	<?php echo CHtml::encode($data->prof_firstname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_lastname')); ?>:</b>
	<?php echo CHtml::encode($data->prof_lastname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_position')); ?>:</b>
	<?php echo CHtml::encode($data->prof_position); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_department')); ?>:</b>
	<?php echo CHtml::encode($data->prof_department); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_personal_staff')); ?>:</b>
	<?php echo CHtml::encode($data->prof_personal_staff); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_phone')); ?>:</b>
	<?php echo CHtml::encode($data->prof_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_mobile')); ?>:</b>
	<?php echo CHtml::encode($data->prof_mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_fax')); ?>:</b>
	<?php echo CHtml::encode($data->prof_fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_office')); ?>:</b>
	<?php echo CHtml::encode($data->prof_office); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_site')); ?>:</b>
	<?php echo CHtml::encode($data->prof_site); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_sheet_position')); ?>:</b>
	<?php echo CHtml::encode($data->prof_sheet_position); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_site_2')); ?>:</b>
	<?php echo CHtml::encode($data->prof_site_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_phone_2')); ?>:</b>
	<?php echo CHtml::encode($data->prof_phone_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_structure_code')); ?>:</b>
	<?php echo CHtml::encode($data->prof_structure_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_department_2')); ?>:</b>
	<?php echo CHtml::encode($data->prof_department_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_company')); ?>:</b>
	<?php echo CHtml::encode($data->prof_company); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_hierarchy')); ?>:</b>
	<?php echo CHtml::encode($data->prof_hierarchy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_code_site')); ?>:</b>
	<?php echo CHtml::encode($data->prof_code_site); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prof_sheet_structrure')); ?>:</b>
	<?php echo CHtml::encode($data->prof_sheet_structrure); ?>
	<br />

	*/ ?>

</div>