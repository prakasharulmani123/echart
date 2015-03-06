<div class="box grid_8 align_center">
    <h2 class="box_head">View "<?php echo $model->dept_name; ?>"</h2>
    <div class="toggle_container">
        <div class="block lines">
            <div class="columns clearfix">
                <div class="col_50 no_border_top">
                    <div class="section">
                        <p><?php echo $model->getAttributeLabel('dept_name'); ?></p>
                    </div>
                </div>
                <div class="col_50 no_border_top no_border_right">
                    <div class="section">
                        <p><?php echo $model->dept_name ?></p>
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