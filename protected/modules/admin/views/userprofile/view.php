<?php
/* @var $this UserprofileController */
/* @var $model UserProfile */

$this->breadcrumbs=array(
	'User Profiles'=>array('index'),
	$model->prof_id,
);

$this->menu=array(
	array('label'=>'List UserProfile', 'url'=>array('index')),
	array('label'=>'Create UserProfile', 'url'=>array('create')),
	array('label'=>'Update UserProfile', 'url'=>array('update', 'id'=>$model->prof_id)),
	array('label'=>'Delete UserProfile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->prof_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserProfile', 'url'=>array('admin')),
);
?>

<h1>View UserProfile #<?php echo $model->prof_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'prof_id',
		'user_id',
		'prof_firstname',
		'prof_lastname',
		'prof_position',
		'prof_department',
		'prof_personal_staff',
		'prof_phone',
		'prof_mobile',
		'prof_fax',
		'prof_office',
		'prof_site',
		'prof_sheet_position',
		'prof_site_2',
		'prof_phone_2',
		'prof_structure_code',
		'prof_department_2',
		'prof_company',
		'prof_hierarchy',
		'prof_code_site',
		'prof_sheet_structrure',
	),
)); ?>
