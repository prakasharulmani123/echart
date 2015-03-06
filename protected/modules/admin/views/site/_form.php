<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'site-form',
    'enableAjaxValidation' => false,
        ));
?>
<div class="columns clearfix">
    <div class="col_100">
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'site_name'); ?>
            <div class="clearfix">
                <?php echo $form->textField($model, 'site_name', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($model, 'site_name'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'reception_mail'); ?>
            <div class="clearfix">
                <?php echo $form->textField($model, 'reception_mail', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($model, 'reception_mail'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'reception_phone'); ?>
            <div class="clearfix">
                <?php echo $form->textField($model, 'reception_phone', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($model, 'reception_phone'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'parking_phone'); ?>
            <div class="clearfix">
                <?php echo $form->textField($model, 'parking_phone', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($model, 'parking_phone'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'tel_security'); ?>
            <div class="clearfix">
                <?php echo $form->textField($model, 'tel_security', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($model, 'tel_security'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'address'); ?>
            <div class="clearfix">
                <?php echo $form->textArea($model, 'address', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($model, 'address'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'restaurant'); ?>
            <div class="clearfix">
                <?php echo $form->textArea($model, 'restaurant', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($model, 'restaurant'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'information'); ?>
            <div class="clearfix">
                <?php echo $form->textArea($model, 'information', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($model, 'information'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'status'); ?>
            <div class="clearfix ml-11 send_left">
                <?php echo $form->dropDownList($model, 'status', Myclass::getStatus(), array('class' => 'uniform')); ?>
                <?php echo $form->error($model, 'status'); ?>
            </div>
        </fieldset>
    </div>
</div>

<div class="button_bar clearfix">
    <button class="dark blue no_margin_bottom" type="submit">
        <div class="ui-icon ui-icon-check"></div>
        <span>Submit</span>
    </button>
    <?php echo CHtml::link('<button class="light send_right" type="button"><div class="ui-icon ui-icon-closethick"></div><span>Cancel</span></button>', array('/admin/site/index')) ?>

</div>
<?php $this->endWidget(); ?>