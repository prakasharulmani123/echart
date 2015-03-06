<?php
/* @var $this UserprofileController */
/* @var $model UserProfile */

$this->breadcrumbs=array(
	'User Profiles'=>array('index'),
	$model->prof_id=>array('view','id'=>$model->prof_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserProfile', 'url'=>array('index')),
	array('label'=>'Create UserProfile', 'url'=>array('create')),
	array('label'=>'View UserProfile', 'url'=>array('view', 'id'=>$model->prof_id)),
	array('label'=>'Manage UserProfile', 'url'=>array('admin')),
);
?>

<h1>Update UserProfile <?php echo $model->prof_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>