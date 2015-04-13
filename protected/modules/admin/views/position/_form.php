<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'position-form',
    'enableAjaxValidation' => false,
        ));
?>
<div class="columns clearfix">
    <div class="col_100">
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'position_dept_id'); ?>
            <div class="clearfix ml-11 send_left">
                <?php $departments = CHtml::listData(Department::model()->isActive()->findAll(), 'dept_id', 'dept_name')?>
                <?php echo $form->dropDownList($model, 'position_dept_id', $departments, array('class' => 'uniform', 'prompt' => '')); ?>
                <?php echo $form->error($model, 'position_dept_id'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'position_name'); ?>
            <div class="clearfix">
                <?php echo $form->textField($model, 'position_name', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($model, 'position_name'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'position_status'); ?>
            <div class="clearfix ml-11 send_left">
                <?php echo $form->dropDownList($model, 'position_status', Myclass::getStatus(), array('class' => 'uniform')); ?>
                <?php echo $form->error($model, 'position_status'); ?>
            </div>
        </fieldset>
    </div>
</div>

<div class="button_bar clearfix">
    <button class="dark blue no_margin_bottom" type="submit">
        <div class="ui-icon ui-icon-check"></div>
        <span>Submit</span>
    </button>
    <?php echo CHtml::link('<button class="light send_right" type="button"><div class="ui-icon ui-icon-closethick"></div><span>Cancel</span></button>', array('/admin/position/index')) ?>

</div>
<?php $this->endWidget(); ?>