<?php
$users = Users::model()->isActive()->findAll(array('order' => 'parent_id ASC'));
?>
<div class="flat_area grid_16">
    <div class="display_none">
        <?php
        $this->widget('CTreeView', array(
            'id' => 'organisation',
            'data' => Users::model()->getTreeItems($userid, true, true),
            'control' => '#treecontrol',
            'animated' => 'fast',
            'collapsed' => true,
            'htmlOptions' => array(
                'class' => 'filetree',
            )
        ));
        ?>
    </div>
    <div id="orgChart"></div>
</div>
<script type="text/javascript">
    function popup(value) {
        $("#a_prof_" + value).trigger("click");
    }
</script>
<?php
$js = <<< EOD
    $("#organisation").orgChart({container: $("#orgChart"), depth: $depth});
//    $("#organisation").orgChart({container: $("#orgChart"), interactive: true, fade: true, speed: 'slow', nodeClicked: onNodeClicked});
    
    $(".dialog_button").on("click", function(){
        $("#a_prof_"+$(this).data("dialog")).trigger("click");
    });
    function onNodeClicked(_node) {
        $("#a_prof_"+_node.data("userid")).trigger("click");
    }
    $(".node").addClass("big");
    $(".adjunct").removeClass("big");
EOD;
?>

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
                                    <?= CHtml::image(Yii::app()->createAbsoluteUrl('uploads/user/' . $user->user_prof_image), $user->user_name, array('width' => '55'))
                                    ?>
                                </div>
                            </div>
                            <div class="col_75">
                                <div class="section">
                                    <h2 id="contactName"><?php echo $firstname = $user->userProfile->prof_firstname ?></h2>
                                    <h3 id="contactEmail"><?php echo $position = $user->userProfile->profPosition->position_name ?></h3>
                                    <h3><?php echo $dept = $user->userProfile->profDepartment->dept_name ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="columns clearfix">
                            <div class="col_100">
                                <fieldset class="label_side top">
                                    <label><?= UserProfile::model()->getAttributeLabel('prof_phone') ?></label>
                                    <div>
                                        <p><?php echo $phone = $user->userProfile->prof_phone ?></p>
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
$img = CHtml::image(Yii::app()->createAbsoluteUrl('uploads/user/' . $user->user_prof_image), '',array('width'=>'50', 'height' => '50', 'style' => 'margin-left:70px;'));
$js .= <<< EOD
    $('h2 #orgainzeImage$user->user_id').tooltipster({
            content: $('$img<p style="text-align:center;"><b>$firstname</b></p><br /><p style="text-align:center;">$position</p><p style="text-align:center">$dept</p><p style="text-align:center">$phone</p>'),
            // setting a same value to minWidth and maxWidth will result in a fixed width
            minWidth: 200,
            maxWidth: 200,
            position: 'right',
            theme: 'tooltipster-light'
    });
    
EOD;
}
Yii::app()->clientScript->coreScriptPosition = CClientScript::POS_END;
Yii::app()->clientScript->registerScript('organisation', $js);
?>

<style type="text/css">
    .ui-tabs-hide{
        display: none !important;
    }

<?php if (isset($_GET['phone'])) { ?>
        div.orgChart div.node.big {
            height: auto;
        }
<?php } ?>
</style>
