<?php
$user_find = Users::model()->with('userProfile')->isActive()->isNotAssistnant()->findAll('userProfile.prof_department = :dept', array(':dept' => $id), array('order' => 'userProfile.prof_name ASC'));
$users = CHtml::listData($user_find, 'user_id', 'userProfile.prof_firstname');
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'Department-form',
    'enableAjaxValidation' => false,
        ));
?>
<div class="columns clearfix">
    <div class="col_50">
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'dept_name'); ?>
            <div class="clearfix ml-11" style="margin-top: 7px;">
                <?php echo $model->dept_name; ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'dept_head_user_id'); ?>
            <div class="clearfix ml-11 send_left">
                <?php echo $form->dropDownList($model, 'dept_head_user_id', $users, array('class' => 'uniform', 'prompt' => '')); ?>
                <?php echo $form->error($model, 'dept_head_user_id'); ?>
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