<?php
/* @var $this CompanyController */
/* @var $model Company */

$this->breadcrumbs=array(
	'Companies'=>array('index'),
	$model->company_id=>array('view','id'=>$model->company_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Company', 'url'=>array('index')),
	array('label'=>'Create Company', 'url'=>array('create')),
	array('label'=>'View Company', 'url'=>array('view', 'id'=>$model->company_id)),
	array('label'=>'Manage Company', 'url'=>array('admin')),
);
?>
<div class="box grid_16">
    <div class="block">
        <h2 class="section">Update Company "<?php echo $model->company_name; ?>"</h2>
        <?php $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
</div>