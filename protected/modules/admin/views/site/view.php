<div class="box grid_8 align_center">
    <h2 class="box_head">View "<?php echo $model->site_name; ?>"</h2>
    <div class="toggle_container">
        <div class="block lines">
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo $model->getAttributeLabel('site_name'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->site_name ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo $model->getAttributeLabel('reception_mail'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->reception_mail ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo $model->getAttributeLabel('reception_phone'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->reception_phone ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo $model->getAttributeLabel('parking_phone'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->parking_phone ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo $model->getAttributeLabel('tel_security'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->tel_security ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo $model->getAttributeLabel('address'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->address ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo $model->getAttributeLabel('restaurant'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->restaurant ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo $model->getAttributeLabel('information'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->information ?></p>
                    </div>
                </div>
            </div>
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo $model->getAttributeLabel('status'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo Myclass::getStatus($model->status); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>