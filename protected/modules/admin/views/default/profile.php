<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Profile'
);
?>
<div class="box grid_16">
    <div class="block">
        <h2 class="section">Edit Profile</h2>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'enableAjaxValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'role' => 'form'),
        ));
        ?>
        <div class="columns clearfix">
            <div class="col_50">

                <fieldset class="label_side top">
                    <?php echo $form->labelEx($model, 'admin_name', array('class' => 'col-lg-2 col-sm-2 control-label')); ?>
                    <div class="clearfix">
                        <?php echo $form->textField($model, 'admin_name', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'admin_name'); ?>
                    </div>
                </fieldset>
                <fieldset class="label_side top">
                    <?php echo $form->labelEx($model, 'admin_username', array('class' => 'col-lg-2 col-sm-2 control-label')); ?>
                    <div class="clearfix">
                        <?php echo $form->textField($model, 'admin_username', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'admin_username'); ?>
                    </div>
                </fieldset>
<!--                <fieldset class="label_side top">
                    <?php echo $form->labelEx($model, 'admin_password', array('class' => 'col-lg-2 col-sm-2 control-label')); ?>
                    <div class="clearfix">
                        <?php echo $form->textField($model, 'admin_password', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'admin_password'); ?>
                    </div>
                </fieldset>-->
                <fieldset class="label_side top">
                    <?php echo $form->labelEx($model, 'admin_email', array('class' => 'col-lg-2 col-sm-2 control-label')); ?>
                    <div class="clearfix">
                        <?php echo $form->textField($model, 'admin_email', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'admin_email'); ?>
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="button_bar clearfix">
            <button class="dark blue no_margin_bottom" type="submit">
                <div class="ui-icon ui-icon-check"></div>
                <span>Submit</span>
            </button>
            <?php echo CHtml::link('<button class="light send_right" type="button"><div class="ui-icon ui-icon-closethick"></div><span>Cancel</span></button>', array('/admin/department/index')) ?>

        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>


