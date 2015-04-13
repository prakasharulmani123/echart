<div class="box grid_8 align_center">
    <h2 class="box_head">View "<?php echo $model->userProfile->prof_firstname; ?>"</h2>
    <div class="toggle_container">
        <div class="block lines">
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo UserProfile::model()->getAttributeLabel('prof_firstname'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->userProfile->prof_firstname ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo UserProfile::model()->getAttributeLabel('prof_lastname'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->userProfile->prof_lastname ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo $model->getAttributeLabel('user_name'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->user_name ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo $model->getAttributeLabel('user_email'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->user_email ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo $model->getAttributeLabel('user_status'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo Myclass::getStatus($model->user_status) ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo UserProfile::model()->getAttributeLabel('prof_position'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->userProfile->profPosition->position_name ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo UserProfile::model()->getAttributeLabel('prof_department'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->userProfile->profDepartment->dept_name ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo UserProfile::model()->getAttributeLabel('prof_personal_staff'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->userProfile->profPersonalStaff->userProfile->prof_firstname ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo UserProfile::model()->getAttributeLabel('prof_sites'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                                                <?php
                        $site_list = explode(",", $model->userProfile->prof_sites);
                        foreach ($site_list as $value) {
                            echo "<p>".Site::model()->findByPk($value)->site_name."</p>";
                        }
                        ?>

                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo UserProfile::model()->getAttributeLabel('prof_phone'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->userProfile->prof_phone ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo UserProfile::model()->getAttributeLabel('prof_mobile'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->userProfile->prof_mobile ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo UserProfile::model()->getAttributeLabel('prof_fax'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->userProfile->prof_fax ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo UserProfile::model()->getAttributeLabel('prof_office'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->userProfile->prof_office ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo UserProfile::model()->getAttributeLabel('prof_sheet_position'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo CHtml::link($model->userProfile->prof_sheet_position, Yii::app()->createAbsoluteUrl('uploads/user/'.$model->userProfile->prof_sheet_position)); ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo UserProfile::model()->getAttributeLabel('prof_phone_2'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->userProfile->prof_phone_2 ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo UserProfile::model()->getAttributeLabel('prof_structure_code'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->userProfile->prof_structure_code ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo UserProfile::model()->getAttributeLabel('prof_department_2'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->userProfile->profDepartment2->dept_name ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo UserProfile::model()->getAttributeLabel('prof_company'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->userProfile->profCompany->company_name ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo UserProfile::model()->getAttributeLabel('prof_hierarchy'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->userProfile->prof_hierarchy ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo UserProfile::model()->getAttributeLabel('prof_code_site'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->userProfile->profCodeSite->site_name ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo UserProfile::model()->getAttributeLabel('prof_sheet_structrure'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->userProfile->prof_sheet_structrure ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo $model->getAttributeLabel('user_last_login'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->user_last_login ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo $model->getAttributeLabel('user_login_ip'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->user_login_ip ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
