<?php
function fetchParentTree($parent = 0, $spacing = '', $dept_tree_array = '') {
    if (!is_array($dept_tree_array))
        $dept_tree_array = array();

    $parent_depts = Department::model()->findAllByAttributes(
            array('dept_parent_id' => $parent));

    foreach ($parent_depts as $key => $parent_dept) {
        $dept_tree_array[] = array("id" => $parent_dept->dept_id, "name" => $spacing . $parent_dept->dept_name);
        $dept_tree_array = fetchParentTree($parent_dept->dept_id, $spacing . '--', $dept_tree_array);
    }
    return $dept_tree_array;
}

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'Department-form',
    'enableAjaxValidation' => false,
        ));
?>
<div class="columns clearfix">
    <div class="col_50">
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'dept_parent_id'); ?>
            <div class="clearfix">
                <?php
                $parentList = fetchParentTree();
                ?>
                <select id="Department_dept_parent_id" class="uniform" name="Department[dept_parent_id]">
                    <option value=""> </option>
                    <?php foreach ($parentList as $parent) { ?>
                    <option value="<?php echo $parent["id"] ?>" 
                    <?php echo $model->dept_parent_id == $parent["id"] ? 'selected' : ''?>
                    <?php echo $model->dept_id == $parent["id"] ? 'disabled' : ''?>
                    ><?php echo $parent["name"]; ?></option>
                    <?php } ?>
                </select>
            </div>
        </fieldset>
        
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'dept_name'); ?>
            <div class="clearfix">
                <?php echo $form->textField($model, 'dept_name', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($model, 'dept_name'); ?>
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
    <?php echo CHtml::link('<button class="light send_right" type="button"><div class="ui-icon ui-icon-closethick"></div><span>Cancel</span></button>', array('/admin/department/index')) ?>

</div>
<?php $this->endWidget(); ?>