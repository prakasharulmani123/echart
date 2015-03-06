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
                                <?php echo $form->dropDownList(
                                        $model, 
                                        'position', 
                                        CHtml::listData(Position::model()->isActive()->findAll(), 'position_id', 'position_name'), 
                                        array(
                                            'class' => 'uniform',
                                            'prompt' => '',
                                            )); ?>
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
                                <?php echo $form->dropDownList(
                                        $model, 
                                        'department', 
                                        CHtml::listData(Department::model()->isActive()->findAll(), 'dept_id', 'dept_name'), 
                                        array(
                                            'class' => 'uniform',
                                            'prompt' => '',
                                            )); ?>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col_50">
                        <fieldset class="label_side label_small top">
                            <?php echo $form->label($model, 'site'); ?>
                            <div class="clearfix">
                                <?php echo $form->dropDownList(
                                        $model, 
                                        'site', 
                                        CHtml::listData(Site::model()->isActive()->findAll(), 'site_id', 'site_name'), 
                                        array(
                                            'class' => 'uniform',
                                            'prompt' => '',
                                            )); ?>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="columns clearfix">
                    <div class="col_50">
                        <fieldset class="label_side label_small top">
                            <?php echo $form->label($model, 'company'); ?>
                            <div class="clearfix">
                                <?php echo $form->dropDownList(
                                        $model, 
                                        'department', 
                                        CHtml::listData(Company::model()->isActive()->findAll(), 'company_id', 'company_name'), 
                                        array(
                                            'class' => 'uniform',
                                            'prompt' => '',
                                            )); ?>
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
                    <th><?php echo UserProfile::model()->getAttributeLabel('prof_firstname')?></th>
                    <th><?php echo UserProfile::model()->getAttributeLabel('prof_lastname')?></th>
                    <th><?php echo UserProfile::model()->getAttributeLabel('prof_position')?></th>
                    <th><?php echo UserProfile::model()->getAttributeLabel('prof_department')?></th>
                    <th><?php echo UserProfile::model()->getAttributeLabel('prof_site')?></th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($search_model)){?>
                <?php foreach ($search_model as $key => $search) {?>
                <tr>
                    <td align="right"><?php echo $key+1?></td>
                    <td align="center"><?php echo $search->userProfile->prof_firstname?></td>
                    <td align="center"><?php echo $search->userProfile->prof_lastname?></td>
                    <td align="center"><?php echo $search->userProfile->profPosition->position_name?></td>
                    <td align="center"><?php echo $search->userProfile->profDepartment->dept_name?></td>
                    <td align="center"><?php echo $search->userProfile->profSite->site_name?></td>
                </tr>
                <?php }?>
      <?php }?>
      </tbody>
    </table>
    </div>
</div>