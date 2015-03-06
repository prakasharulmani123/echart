<?php $themeUrl = Yii::app()->theme->baseUrl; ?>
<div class="isolate">
    <div class="center narrow">
        <div class="main_container full_size container_16 clearfix">
            <div class="box">
                <div class="block">
                    <div class="section">
                        <div class="alert dismissible alert_light">
                            <?php echo CHtml::image($themeUrl . "/images/icons/small/grey/locked.png", "", array("width" => "24", "height" => "24")); ?>
                            <strong>Welcome to <?php echo Yii::app()->name; ?>.</strong> Please enter your details to login.
                        </div>
                    </div>
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'loginform',
                        'enableAjaxValidation' => false,
                        'htmlOptions' => array('class' => 'validate_form')
                    ));
                    ?>
                    <?php
                    if (isset($this->flashMessages)):
                        foreach ($this->flashMessages as $key => $message) {
                            echo "<div class='alert alert-$key'>$message </div>";
                        }
                    endif;
                    ?>
                    <fieldset class="label_side top">
                        <?php echo $form->labelEx($model, 'username'); ?>
                        <div>
                            <?php echo $form->textField($model, 'username', array('autofocus', 'class' => 'required text')); ?>
                            <?php echo $form->error($model, 'username'); ?>
                        </div>
                    </fieldset>
                    <fieldset class="label_side bottom">
                        <?php echo $form->labelEx($model, 'password'); ?>
                        <div>
                            <?php echo $form->passwordField($model, 'password', array('class' => 'required text')); ?>
                            <?php echo $form->error($model, 'password'); ?>
                        </div>
                    </fieldset>
                    <div class="button_bar clearfix">
                        <button class="wide" type="submit">
                            <?php echo CHtml::image($themeUrl . "/images/icons/small/white/key_2.png", ""); ?>
                            <span>Login</span>
                        </button>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .isolate{
        height: 600px;
    }
    #loginform fieldset.label_side > label > span{
        display: inline-block;
    }
    #loginform label.error,.errorMessage{
        background: none;
        border: none;
        color: #da202c;
    }
    .errorMessage {
        padding: 10px 0 0;
    }
</style>