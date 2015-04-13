<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="box grid_16 tabs">
    <ul class="tab_header clearfix">
        <li><a href="#tabs-1">Persons</a></li>
        <!--<li><a href="#tabs-2">Structures</a></li>-->
    </ul>
    <div class="toggle_container">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'action' => Yii::app()->createUrl($this->route),
            'method' => 'get',
        ));
        ?>

        <div id="tabs-1" class="block"><div class="block" style="opacity: 1;">
                <div class="columns clearfix">
                    <div class="col_50">
                        <fieldset class="label_side label_small top">
                            <?php echo $form->label($model, 'surname'); ?>
                            <div class="clearfix">
                                <?php echo $form->textField($model, 'surname', array()); ?>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col_50">
                        <fieldset class="label_side label_small top">
                            <?php echo $form->label($model, 'phone'); ?>
                            <div class="clearfix">
                                <?php echo $form->textField($model, 'phone', array()); ?>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="columns clearfix">
                    <div class="col_50">
                        <fieldset class="label_side label_small top">
                            <?php echo $form->label($model, 'name'); ?>
                            <div class="clearfix">
                                <?php echo $form->textField($model, 'name', array()); ?>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col_50">
                        <fieldset class="label_side label_small top">
                            <?php echo $form->label($model, 'fax'); ?>
                            <div class="clearfix">
                                <?php echo $form->textField($model, 'fax', array()); ?>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="columns clearfix">
                    <div class="col_50">
                        <fieldset class="label_side label_small top">
                            <?php echo $form->label($model, 'position'); ?>
                            <div class="clearfix">
                                <?php
                                echo $form->dropDownList(
                                        $model, 'position', CHtml::listData(Position::model()->isActive()->findAll(), 'position_id', 'position_name'), array(
                                    'class' => 'uniform',
                                    'prompt' => '',
                                ));
                                ?>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col_50">
                        <fieldset class="label_side label_small top">
                            <?php echo $form->label($model, 'office'); ?>
                            <div class="clearfix">
                                <?php echo $form->textField($model, 'office', array()); ?>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="columns clearfix">
                    <div class="col_50">
                        <fieldset class="label_side label_small top">
                            <?php echo $form->label($model, 'department'); ?>
                            <div class="clearfix">
                                <?php
                                echo $form->dropDownList(
                                        $model, 'department', CHtml::listData(Department::model()->isActive()->findAll(), 'dept_id', 'dept_name'), array(
                                    'class' => 'uniform',
                                    'prompt' => '',
                                ));
                                ?>
                            </div>
                        </fieldset>
                    </div>
<!--                    <div class="col_50">
                        <fieldset class="label_side label_small top">
                            <?php echo $form->label($model, 'site'); ?>
                            <div class="clearfix">
                                <?php
                                echo $form->dropDownList(
                                        $model, 'site', CHtml::listData(Site::model()->isActive()->findAll(), 'site_id', 'site_name'), array(
                                    'class' => 'uniform',
                                    'prompt' => '',
                                ));
                                ?>
                            </div>
                        </fieldset>
                    </div>-->
                </div>
                <div class="columns clearfix">
                    <div class="col_50">
                        <fieldset class="label_side label_small top">
                            <?php echo $form->label($model, 'company'); ?>
                            <div class="clearfix">
                                <?php
                                echo $form->dropDownList(
                                        $model, 'company', CHtml::listData(Company::model()->isActive()->findAll(), 'company_id', 'company_name'), array(
                                    'class' => 'uniform',
                                    'prompt' => '',
                                ));
                                ?>
                            </div>
                        </fieldset>
                    </div>

                </div>
                <!--                <div class="columns clearfix">
                                    <div class="col_50">
                                        <fieldset class="label_side label_small top">
                <?php echo $form->label($model, 'building'); ?>
                                            <div class="clearfix">
                <?php echo $form->textField($model, 'building', array()); ?>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>-->


                <div class="button_bar clearfix">
                    <button type="submit" class="dark img_icon has_text">
                        <?php echo CHtml::image(Yii::app()->createAbsoluteUrl('themes/site/images/icons/small/white/search.png'), '', array()) ?>
                        <span>Search</span>
                    </button>

                </div>
            </div></div>
        <!--        <div id="tabs-2" class="block">
                    <div class="section">
                        <h1>Primary Heading</h1>
                        <p>Lorem Ipsum is simply dummy text of the <a href="#" title="This is a tooltip">printing industry</a>. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        <h2>Secondary Heading</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p> 					</div>
                </div>-->
        <?php $this->endWidget(); ?>
    </div>
</div>

<div class="box grid_16 single_datatable">
    <div id="dt1" class="no_margin">
        <table class=" datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo UserProfile::model()->getAttributeLabel('prof_firstname') ?></th>
                    <th><?php echo UserProfile::model()->getAttributeLabel('prof_lastname') ?></th>
                    <th><?php echo UserProfile::model()->getAttributeLabel('prof_position') ?></th>
                    <th><?php echo UserProfile::model()->getAttributeLabel('prof_department') ?></th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($search_model)) { ?>
                    <?php foreach ($search_model as $key => $search) { ?>
                        <tr>
                            <td align="right"><?php echo $key + 1 ?></td>
                            <td align="center"><?php echo $search->userProfile->prof_firstname ?></td>
                            <td align="center"><?php echo $search->userProfile->prof_lastname ?></td>
                            <td align="center"><?php echo $search->userProfile->profPosition->position_name ?></td>
                            <td align="center"><?php echo $search->userProfile->profDepartment->dept_name ?></td>
                            <td align="center">        
                                <a id="a_prof_<?php echo $search->user_id ?>" class="dialog_button" href="javascript:void(0)" id data-dialog="prof_<?php echo $search->user_id ?>" style="text-align: unset !important"><div class="ui-icon ui-icon-search"></div></a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php foreach ($search_model as $key => $user) { ?>
    <div class="display_none">
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
                                    <label><?= UserProfile::model()->getAttributeLabel('prof_sites') ?></label>
                                    <div class="clearfix">
                                        <?php
                                        $site_list = explode(",", $user->userProfile->prof_sites);
                                        foreach ($site_list as $value) {
                                            echo "<p>" . Site::model()->findByPk($value)->site_name . "</p>";
                                        }
                                        ?>

                                    </div>
                                </fieldset>

                                <fieldset class="label_side top">
                                    <label><?= UserProfile::model()->getAttributeLabel('prof_phone_2') ?></label>
                                    <div>
                                        <p><?= $user->userProfile->prof_phone_2 ?></p>
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
                                    <label><?= UserProfile::model()->getAttributeLabel('prof_code_site') ?></label>
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

                            </div>
                        </div>

                    </div>
                    <div id="tabs-3" class="block">

                        <div class="columns clearfix">
                            <div class="col_100" style="max-height: 450px; overflow-y: scroll">
                                <?php
                                $i = 1;
                                foreach ($site_list as $value) {
                                    $site = Site::model()->findByPk($value);?>
                                    <fieldset class="label_side top">
                                        <label><?= "Site ".$i++ ?></label>
                                        <div>
                                            <p><?= $site->site_name ?></p>
                                        </div>
                                        <label><?= UserProfile::model()->getAttributeLabel('reception_mail') ?></label>
                                        <div>
                                            <p><?= $site->reception_mail ?></p>
                                        </div>
                                        <label><?= UserProfile::model()->getAttributeLabel('reception_phone') ?></label>
                                        <div>
                                            <p><?= $site->reception_phone ?></p>
                                        </div>
                                        <label><?= UserProfile::model()->getAttributeLabel('parking_phone') ?></label>
                                        <div>
                                            <p><?= $site->parking_phone ?></p>
                                        </div>
                                        <label><?= UserProfile::model()->getAttributeLabel('tel_security') ?></label>
                                        <div>
                                            <p><?= $site->tel_security ?></p>
                                        </div>
                                        <label><?= UserProfile::model()->getAttributeLabel('address') ?></label>
                                        <div>
                                            <p><?= $site->address ?></p>
                                        </div>
                                        <label><?= UserProfile::model()->getAttributeLabel('restaurant') ?></label>
                                        <div>
                                            <p><?= $site->restaurant ?></p>
                                        </div>
                                        <label><?= UserProfile::model()->getAttributeLabel('information') ?></label>
                                        <div>
                                            <p><?= $site->information ?></p>
                                        </div>
                                    </fieldset>
                                <?php }?>
                                
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
