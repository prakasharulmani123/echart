<div class="box grid_16 no_titlebar" style="opacity: 1;">
    <div class="block" style="opacity: 1;">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'print-form',
            'htmlOptions' => array('role' => 'form')
        ));
        ?>
        <h2 class="section">Print</h2>
        <div class="columns clearfix">
            <div class="col_100">
                <fieldset class="label_side top">
                    <?php echo $form->labelEx($model, 'print'); ?>
                    <div class="clearfix ml-11 send_left">
                        <?php echo $form->dropDownList($model, 'print', array('pdf' => 'PDF', 'png' => 'PNG'), array('class' => 'uniform')); ?>
                        <?php echo $form->error($model, 'print'); ?>
                    </div>
                </fieldset>
            </div>

        </div>

        <div class="button_bar clearfix">
            <button type="submit" class="dark img_icon has_text">
                <span>Print</span>
            </button>
        </div>
        <?php $this->endWidget(); ?>
    </div>

</div>