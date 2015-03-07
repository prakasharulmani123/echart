<?php
$arrayUsers = array();
$assist = explode(',', UserProfile::getAssitants());

if($userid != NULL){
    $criteria = new CDbCriteria;
    $criteria->condition = 't.user_id = "'.$userid.'" OR t.parent_id = "'.$userid.'"';
    $users = Users::model()->isActive()->findAll($criteria);
}else{
    $users = Users::model()->isActive()->findAll(array('order'=>'parent_id ASC'));
}


$i = 1;
foreach ($users as $key => $user) {
    if(!in_array($user->user_id, $assist)){
        $assistant = '';
        if($user->userProfile->prof_personal_staff != '0'){
            $assistant = $user->userProfile->profPersonalStaff->userProfile->prof_firstname;
        }
        $arrayUsers[$i++] = array(
            'parent_id' => ($user->parent_id - $level),
            'user_id' => $user->user_id,
            'name' => $user->userProfile->prof_firstname,
            'image' => $user->user_prof_image,
            'department' => $user->userProfile->profDepartment->dept_name,
            'assistant_id' => $user->userProfile->prof_personal_staff,
            'assistant' => $assistant
        );
    }
}
//echo '<pre>';
//print_r($arrayUsers);
//exit;

if(!function_exists(createTree)){
    function createTree($array, $currentParent, $currLevel = 0, $prevLevel = -1, $topParent) {
        foreach ($array as $categoryId => $category) {
            if ($currentParent == $category['parent_id']) {
                if ($currLevel > $prevLevel) {
                    if ($topParent == 0) {
                        echo '<ul id="organisation" class="display_none">';
                    } else {
                        echo '<ul>';
                    }
                }
                if ($currLevel == $prevLevel)
                    echo '</li>';
                $assis = $category['assistant'] == '' ? '' : '<adjunct>'. '<a href="javascript:popup('.$category['assistant_id'].')">'.$category['assistant'].'</a></adjunct>';
                echo '<li data-username="' . $category['name'] . '" data-userid="' . $category['user_id'] . '" class="big">'.$assis.'<em>' . $category['name'] . '</em><br/>'
                . '<a class="dialog_button" href="javascript:popup('.$category['user_id'].')" data-dialog="prof_' . $category['user_id'] . '"><img class="orgainzeImage" title="' . $category['name'] . '" src="' . Yii::app()->createAbsoluteUrl('uploads/user/'.$category['image']) . '"/></a>'
                . '<p class="orgDept">' . $category['department'] . '</p>'
                . '<p class="level"><a href="'.Yii::app()->createAbsoluteUrl("site/default/index?userid=".$category['user_id']). '">Move top</a></p>';
                if ($currLevel > $prevLevel) {
                    $prevLevel = $currLevel;
                }
                $currLevel++;
                createTree($array, $categoryId, $currLevel, $prevLevel, 1);
                $currLevel--;
            }
        }
        if ($currLevel == $prevLevel)
            echo ' </li>  </ul> ';
    }
}
?>
<div class="flat_area grid_16">
    <?php createTree($arrayUsers, 0, 0, -1, 0); ?>
    <div id="orgChart"></div>
</div>

<?php foreach ($users as $key => $user) { ?>
    <div class="display_none">
        <a id="a_prof_<?php echo $user->user_id ?>" class="dialog_button" href="javascript:void(0)" id data-dialog="prof_<?php echo $user->user_id ?>">Pop up</a>
        <div id="prof_<?php echo $user->user_id ?>" class="dialog_content" title="<?= $user->userProfile->prof_firstname ?> Profile">
            <div class="box tabs">
                <ul class="tab_header clearfix">
                    <li><a href="#tabs-1">Persons</a></li>
                    <li><a href="#tabs-2">Structures</a></li>
                    <li><a href="#tabs-3">Sites</a></li>
                </ul>
                <div class="toggle_container">
                    <div id="tabs-1" class="block">
                        <div class="columns clearfix">
                            <div class="col_25">
                                <div class="section">
                                    <?=
                                    CHtml::image(Yii::app()->createAbsoluteUrl('uploads/user/'.$user->user_prof_image), 
                                            $user->user_name, 
                                            array('width' => '55', 'id' => 'contactImage'))
                                    ?>
                                </div>
                            </div>
                            <div class="col_75">
                                <div class="section">
                                    <h2 id="contactName"><?= $user->userProfile->prof_firstname ?></h2>
                                    <h3 id="contactEmail"><?= $user->userProfile->profPosition->position_name ?></h3>
                                    <h3><?= $user->userProfile->profDepartment->dept_name ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="columns clearfix">
                            <div class="col_100">
                                <fieldset class="label_side top">
                                    <label><?= UserProfile::model()->getAttributeLabel('prof_phone') ?></label>
                                    <div>
                                        <p><?= $user->userProfile->prof_phone ?></p>
                                    </div>
                                </fieldset>

                                <fieldset class="label_side">
                                    <label><?= Users::model()->getAttributeLabel('user_email') ?></label>
                                    <div>
                                        <p><?= $user->user_email ?></p>
                                    </div>
                                </fieldset>

                                <fieldset class="label_side">
                                    <label><?= UserProfile::model()->getAttributeLabel('prof_mobile') ?></label>
                                    <div class="clearfix">
                                        <p><?= $user->userProfile->prof_mobile ?></p>
                                    </div>
                                </fieldset>

                                <fieldset class="label_side">
                                    <label><?= UserProfile::model()->getAttributeLabel('prof_fax') ?></label>
                                    <div class="clearfix">
                                        <p><?= $user->userProfile->prof_fax ?></p>
                                    </div>
                                </fieldset>

                                <fieldset class="label_side">
                                    <label><?= Users::model()->getAttributeLabel('prof_site') ?></label>
                                    <div class="clearfix">
                                        <p><?= $user->userProfile->profSite->site_name ?></p>
                                    </div>
                                </fieldset>

                                <fieldset class="label_side top">
                                    <label><?= UserProfile::model()->getAttributeLabel('prof_phone_2') ?></label>
                                    <div>
                                        <p><?= $user->userProfile->prof_phone_2 ?></p>
                                    </div>
                                </fieldset>

                                <fieldset class="label_side">
                                    <label><?= Users::model()->getAttributeLabel('prof_site_2') ?></label>
                                    <div class="clearfix">
                                        <p><?= $user->userProfile->profSite2->site_name ?></p>
                                    </div>
                                </fieldset>


                            </div>
                        </div>

                    </div>
                    <div id="tabs-2" class="block">
                        
                        <div class="columns clearfix">
                            <div class="col_100">
                                <fieldset class="label_side top">
                                    <label><?= UserProfile::model()->getAttributeLabel('prof_structure_code') ?></label>
                                    <div>
                                        <p><?= $user->userProfile->prof_structure_code ?></p>
                                    </div>
                                </fieldset>

                                <fieldset class="label_side">
                                    <label><?= UserProfile::model()->getAttributeLabel('prof_company') ?></label>
                                    <div class="clearfix">
                                        <p><?= $user->userProfile->profCompany->company_name ?></p>
                                    </div>
                                </fieldset>

                                <fieldset class="label_side">
                                    <label><?= UserProfile::model()->getAttributeLabel('prof_hierarchy') ?></label>
                                    <div class="clearfix">
                                        <p><?= $user->userProfile->prof_hierarchy ?></p>
                                    </div>
                                </fieldset>

                                <fieldset class="label_side">
                                    <label><?= Users::model()->getAttributeLabel('prof_code_site') ?></label>
                                    <div class="clearfix">
                                        <p><?= $user->userProfile->profCodeSite->site_name ?></p>
                                    </div>
                                </fieldset>

                                <fieldset class="label_side top">
                                    <label><?= UserProfile::model()->getAttributeLabel('prof_phone_2') ?></label>
                                    <div>
                                        <p><?= $user->userProfile->prof_phone_2 ?></p>
                                    </div>
                                </fieldset>

                                <fieldset class="label_side">
                                    <label><?= Users::model()->getAttributeLabel('prof_site_2') ?></label>
                                    <div class="clearfix">
                                        <p><?= $user->userProfile->profSite2->site_name ?></p>
                                    </div>
                                </fieldset>


                            </div>
                        </div>

                    </div>
                    <div id="tabs-3" class="block">
                        
                        <div class="columns clearfix">
                            <div class="col_100">
                                <fieldset class="label_side top">
                                    <label><?= UserProfile::model()->getAttributeLabel('prof_site') ?></label>
                                    <div>
                                        <p><?= $user->userProfile->profSite->site_name ?></p>
                                    </div>
                                </fieldset>
                                
                                <fieldset class="label_side top">
                                    <label><?= Site::model()->getAttributeLabel('reception_mail') ?></label>
                                    <div>
                                        <p><?= $user->userProfile->profSite->reception_mail ?></p>
                                    </div>
                                </fieldset>
                                
                                <fieldset class="label_side top">
                                    <label><?= Site::model()->getAttributeLabel('reception_phone') ?></label>
                                    <div>
                                        <p><?= $user->userProfile->profSite->reception_phone ?></p>
                                    </div>
                                </fieldset>
                                
                                <fieldset class="label_side top">
                                    <label><?= Site::model()->getAttributeLabel('parking_phone') ?></label>
                                    <div>
                                        <p><?= $user->userProfile->profSite->parking_phone ?></p>
                                    </div>
                                </fieldset>
                                
                                <fieldset class="label_side top">
                                    <label><?= Site::model()->getAttributeLabel('tel_security') ?></label>
                                    <div>
                                        <p><?= $user->userProfile->profSite->tel_security ?></p>
                                    </div>
                                </fieldset>
                                
                                <fieldset class="label_side top">
                                    <label><?= Site::model()->getAttributeLabel('address') ?></label>
                                    <div>
                                        <p><?= $user->userProfile->profSite->address ?></p>
                                    </div>
                                </fieldset>
                                
                                <fieldset class="label_side top">
                                    <label><?= Site::model()->getAttributeLabel('restaurant') ?></label>
                                    <div>
                                        <p><?= $user->userProfile->profSite->restaurant ?></p>
                                    </div>
                                </fieldset>

                                <fieldset class="label_side top">
                                    <label><?= Site::model()->getAttributeLabel('information') ?></label>
                                    <div>
                                        <p><?= $user->userProfile->profSite->information ?></p>
                                    </div>
                                </fieldset>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
}
?>
<script type="text/javascript">
    function popup(value){
        $("#a_prof_"+value).trigger("click");
    }
</script>
<?php
$js = <<< EOD
    $("#organisation").orgChart({container: $("#orgChart")});
//    $("#organisation").orgChart({container: $("#orgChart"), interactive: true, fade: true, speed: 'slow', nodeClicked: onNodeClicked});
    
    $(".dialog_button").on("click", function(){
        $("#a_prof_"+$(this).data("dialog")).trigger("click");
    });
    function onNodeClicked(_node) {
        $("#a_prof_"+_node.data("userid")).trigger("click");
    }
        
EOD;

Yii::app()->clientScript->coreScriptPosition = CClientScript::POS_END;
Yii::app()->clientScript->registerScript('organisation', $js);
?>

<style type="text/css">
    .ui-tabs-hide{
        display: none !important;
    }
</style>