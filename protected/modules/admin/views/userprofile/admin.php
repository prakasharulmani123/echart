<?php
/* @var $this UserprofileController */
/* @var $model UserProfile */

$this->breadcrumbs=array(
	'User Profiles'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserProfile', 'url'=>array('index')),
	array('label'=>'Create UserProfile', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-profile-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage User Profiles</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-profile-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'prof_id',
		'user_id',
		'prof_firstname',
		'prof_lastname',
		'prof_position',
		'prof_department',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
