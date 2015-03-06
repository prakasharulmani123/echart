<?php
/* @var $this SiteController */
/* @var $data Site */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->site_id), array('view', 'id'=>$data->site_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_name')); ?>:</b>
	<?php echo CHtml::encode($data->site_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reception_mail')); ?>:</b>
	<?php echo CHtml::encode($data->reception_mail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reception_phone')); ?>:</b>
	<?php echo CHtml::encode($data->reception_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parking_phone')); ?>:</b>
	<?php echo CHtml::encode($data->parking_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tel_security')); ?>:</b>
	<?php echo CHtml::encode($data->tel_security); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('restaurant')); ?>:</b>
	<?php echo CHtml::encode($data->restaurant); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('information')); ?>:</b>
	<?php echo CHtml::encode($data->information); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>