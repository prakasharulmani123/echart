<div id="nav_top" class="dropdown_menu clearfix round_top">
    <?php
    $this->themeUrl = Yii::app()->theme->baseUrl;
    $this->widget('zii.widgets.CMenu', array(
//        'htmlOptions' => array('class' => 'clearfix'),
        'encodeLabel' => false,
        'items' => array(
            array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/laptop.png") . '<span class="display_none">Home</span>', 'url' => '#', 'itemOptions' => array('class' => 'icon_only')),
            array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/frames.png") . '<span>Find</span>', 'url' => $this->createUrl('/site/users/find')),
            array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/frames.png") . '<span>Print</span>', 'url' => $this->createUrl('/site/arivu/print')),
            array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/frames.png") . '<span>Go to structure</span>', 'url' => '#'),
            array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/frames.png") . '<span>Explore Structure</span>', 'url' => $this->createUrl('/site/users/explore')),
            array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/frames.png") . '<span>Options</span>', 'url' => '#',
                'itemOptions' => array('class' => 'sub-menu'),
                'submenuOptions' => array('class' => 'sub'),
                'items' => array(
                    array('label' => '<span>Models</span>', 'url' => '#',
                        'itemOptions' => array('class' => 'sub-menu'),
                        'submenuOptions' => array('class' => 'drawer'),
                        'items' => array(
                            array('label' => '<span>Organization Chart</span>', 'url' => '#'),
                            array('label' => '<span>Manager</span>', 'url' => '#'),
                            array('label' => '<span>Organization</span>', 'url' => '#'),
                            array('label' => '<span>Staff</span>', 'url' => '#'),
                            array('label' => '<span>Phones</span>', 'url' => '#')
                        )),
                    array('label' => '<span>Styles</span>', 'url' => '#'),
                    array('label' => '<span>Levels</span>', 'url' => '#',
                        'itemOptions' => array('class' => 'sub-menu'),
                        'submenuOptions' => array('class' => 'drawer'),
                        'items' => array(
                            array('label' => '<span>3 Levels</span>', 'url' => '#'),
                            array('label' => '<span>4 Levels</span>', 'url' => '#'),
                            array('label' => '<span>5 Levels</span>', 'url' => '#'),
                        )),
                )),
        ),
    ));
    ?>

    <?php
    if (!Yii::app()->user->isGuest):
        $this->widget('zii.widgets.CMenu', array(
            'htmlOptions' => array('class' => 'send_right'),
            'encodeLabel' => false,
            'items' => array(
                array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/frames.png") . '<span>Users</span>', 'url' => array('/admin/user/index')),
                array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/frames.png") . '<span>Departments</span>', 'url' => array('/admin/department/index')),
                array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/frames.png") . '<span>Positions</span>', 'url' => array('/admin/position/index')),
                array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/frames.png") . '<span>Sites</span>', 'url' => array('/admin/site/index')),
                array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/frames.png") . '<span>Companies</span>', 'url' => array('/admin/company/index')),
            ),
        ));
    endif;
    ?>
    <div id="mobile_nav">
        <div class="main"></div>
        <div class="side"></div>
    </div>
</div>