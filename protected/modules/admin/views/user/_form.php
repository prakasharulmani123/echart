<?php
$companies = CHtml::listData(Company::model()->isActive()->findAll(), 'company_id', 'company_name');
$sites = CHtml::listData(Site::model()->isActive()->findAll(), 'site_id', 'site_name');
$secratey = CHtml::listData(Users::model()->isActive()->findAll(), 'user_id', 'user_name');
$departments = CHtml::listData(Department::model()->isActive()->findAll(), 'dept_id', 'dept_name');
$positions = CHtml::listData(Position::model()->isActive()->findAll(), 'position_id', 'position_name');

$GLOBALS['assist'] = UserProfile::getAssitants();

function fetchParentTree($parent = 0, $spacing = '', $user_tree_array = '') {
    if (!is_array($user_tree_array))
        $user_tree_array = array();

    $parent_users = Users::model()->with('userProfile')->findAllByAttributes(
            array('parent_id' => $parent), 
            array(
                'condition' =>'t.user_id NOT IN (:staff)',
                'params'=>array(':staff'=> "{$GLOBALS['assist']}")
                ));

    foreach ($parent_users as $key => $parent_user) {
        $user_tree_array[] = array("id" => $parent_user->user_id, "name" => $spacing . $parent_user->userProfile->prof_firstname);
        $user_tree_array = fetchParentTree($parent_user->user_id, $spacing . '--', $user_tree_array);
    }
    return $user_tree_array;
}

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data', 'role' => 'form', 'validateOnSubmit' => true)
        ));
?>

<div class="columns clearfix">
    <div class="col_50">
                <fieldset class="label_side top">
        <?php echo $form->labelEx($model, 'is_personal_staff'); ?>
                    <div class="clearfix">
        <?php echo $form->dropDownList($model, 'is_personal_staff', Myclass::getPersonalStaffStatus(), array('class' => 'uniform')); ?>
        <?php echo $form->error($model, 'is_personal_staff'); ?>
                    </div>
                </fieldset>

        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'parent_id'); ?>
            <div class="clearfix">
                <?php
                $parentList = fetchParentTree();
                ?>
                <select id="Users_parent_id" class="uniform" name="Users[parent_id]">
                    <option value=""> </option>
                    <?php foreach ($parentList as $parent) { ?>
                        <option value="<?php echo $parent["id"] ?>" <?php echo $model->parent_id == $parent["id"] ? 'selected' : '' ?>
                                <?php echo $model->user_id == $parent["id"] ? 'disabled' : '' ?>><?php echo $parent["name"]; ?></option>
                            <?php } ?>
                </select>
            </div>
        </fieldset>

        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'user_name'); ?>
            <div class="clearfix">
                <?php echo $form->textField($model, 'user_name', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($model, 'user_name'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'user_email'); ?>
            <div class="clearfix">
                <?php echo $form->textField($model, 'user_email', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($model, 'user_email'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'user_prof_image'); ?>
            <div class="clearfix">
                <?php echo $form->fileField($model, 'user_prof_image'); ?>
                <?php echo $form->error($model, 'user_prof_image'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($profModel, 'prof_firstname'); ?>
            <div class="clearfix">
                <?php echo $form->textField($profModel, 'prof_firstname', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($profModel, 'prof_firstname'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($profModel, 'prof_lastname'); ?>
            <div class="clearfix">
                <?php echo $form->textField($profModel, 'prof_lastname', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($profModel, 'prof_lastname'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($profModel, 'prof_position'); ?>
            <div class="clearfix">
                <?php echo $form->dropDownList($profModel, 'prof_position', $positions, array('class' => 'uniform', 'prompt' => '')); ?>
                <?php echo $form->error($profModel, 'prof_position'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($profModel, 'prof_department'); ?>
            <div class="clearfix">
                <?php echo $form->dropDownList($profModel, 'prof_department', $departments, array('class' => 'uniform', 'prompt' => '')); ?>
                <?php echo $form->error($profModel, 'prof_department'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top" id="personal_staff_field">
            <?php echo $form->labelEx($profModel, 'prof_personal_staff'); ?>
            <div class="clearfix">
                <?php echo $form->dropDownList($profModel, 'prof_personal_staff', $secratey, array('class' => 'uniform', 'prompt' => '')); ?>
                <?php echo $form->error($profModel, 'prof_personal_staff'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($profModel, 'prof_phone'); ?>
            <div class="clearfix">
                <?php echo $form->textField($profModel, 'prof_phone', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($profModel, 'prof_phone'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($profModel, 'prof_mobile'); ?>
            <div class="clearfix">
                <?php echo $form->textField($profModel, 'prof_mobile', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($profModel, 'prof_mobile'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($profModel, 'prof_fax'); ?>
            <div class="clearfix">
                <?php echo $form->textField($profModel, 'prof_fax', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($profModel, 'prof_fax'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($profModel, 'prof_office'); ?>
            <div class="clearfix">
                <?php echo $form->textField($profModel, 'prof_office', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($profModel, 'prof_office'); ?>
            </div>
        </fieldset>
    </div>
    <div class="col_50">




        <fieldset class="label_side top">
            <?php echo $form->labelEx($profModel, 'prof_site'); ?>
            <div class="clearfix">
                <?php echo $form->dropDownList($profModel, 'prof_site', $sites, array('class' => 'uniform', 'prompt' => '')); ?>
                <?php echo $form->error($profModel, 'prof_site'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($profModel, 'prof_sheet_position'); ?>
            <div class="clearfix">
                <?php echo $form->fileField($profModel, 'prof_sheet_position'); ?>
                <?php echo $form->error($profModel, 'prof_sheet_position'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($profModel, 'prof_site_2'); ?>
            <div class="clearfix">
                <?php echo $form->dropDownList($profModel, 'prof_site_2', $sites, array('class' => 'uniform', 'prompt' => '')); ?>
                <?php echo $form->error($profModel, 'prof_site_2'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($profModel, 'prof_phone_2'); ?>
            <div class="clearfix">
                <?php echo $form->textField($profModel, 'prof_phone_2', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($profModel, 'prof_phone_2'); ?>
            </div>
        </fieldset>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($profModel, 'prof_structure_code'); ?>
            <div class="clearfix">
                <?php echo $form->textField($profModel, 'prof_structure_code', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($profModel, 'prof_structure_code'); ?>
            </div>
        </fieldset>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($profModel, 'prof_department_2'); ?>
            <div class="clearfix">
                <?php echo $form->dropDownList($profModel, 'prof_department_2', $departments, array('class' => 'uniform', 'prompt' => '')); ?>
                <?php echo $form->error($profModel, 'prof_department_2'); ?>
            </div>
        </fieldset>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($profModel, 'prof_company'); ?>
            <div class="clearfix">
                <?php echo $form->dropDownList($profModel, 'prof_company', $companies, array('class' => 'uniform', 'prompt' => '')); ?>
                <?php echo $form->error($profModel, 'prof_company'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($profModel, 'prof_hierarchy'); ?>
            <div class="clearfix">
                <?php echo $form->textField($profModel, 'prof_hierarchy', array('size' => 60, 'maxlength' => 150)); ?>
                <?php echo $form->error($profModel, 'prof_hierarchy'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($profModel, 'prof_code_site'); ?>
            <div class="clearfix">
                <?php echo $form->dropDownList($profModel, 'prof_code_site', $sites, array('class' => 'uniform', 'prompt' => '')); ?>
                <?php echo $form->error($profModel, 'prof_code_site'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($profModel, 'prof_sheet_structrure'); ?>
            <div class="clearfix">
                <?php echo $form->fileField($profModel, 'prof_sheet_structrure'); ?>
                <?php echo $form->error($profModel, 'prof_sheet_structrure'); ?>
            </div>
        </fieldset>
        <fieldset class="label_side top">
            <?php echo $form->labelEx($model, 'user_status'); ?>
            <div class="clearfix ml-11 send_left">
                <?php echo $form->dropDownList($model, 'user_status', Myclass::getStatus(), array('class' => 'uniform')); ?>
                <?php echo $form->error($model, 'user_status'); ?>
            </div>
        </fieldset>
    </div>
</div>

<div class="button_bar clearfix">
    <button class="dark blue no_margin_bottom" type="submit">
        <div class="ui-icon ui-icon-check"></div>
        <span>Submit</span>
    </button>
    <?php echo CHtml::link('<button class="light send_right" type="button"><div class="ui-icon ui-icon-closethick"></div><span>Cancel</span></button>', array('/admin/user/index')) ?>

</div>
<?php $this->endWidget(); ?>

<?php
$js = <<< EOD
        $(document).ready(function(){
            $("#Users_is_personal_staff").on("change", function(){
                if($(this).val() == '0'){
                    $("#personal_staff_field").show();
                }else{
                    $("#personal_staff_field").hide();
                }
            });
        });
EOD;

Yii::app()->clientScript->coreScriptPosition = CClientScript::POS_END;
Yii::app()->clientScript->registerScript('_form', $js);
?>