<div id="nav_top" class="dropdown_menu clearfix round_top">
    <?php
    $this->themeUrl = Yii::app()->theme->baseUrl;
    $this->widget('zii.widgets.CMenu', array(
//        'htmlOptions' => array('class' => 'clearfix'),
        'encodeLabel' => false,
        'items' => array(
            array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/laptop.png") . '<span class="display_none">Home</span>', 'url' => '#', 'itemOptions' => array('class' => 'icon_only')),
            array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/frames.png") . '<span>Find</span>', 'url' => $this->createUrl('/site/users/find')),
            array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/frames.png") . '<span>Print</span>', 'url' => $this->createUrl('/site/default/print')),
            array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/frames.png") . '<span>Go to structure</span>', 'url' => '#', 'linkOptions' => array('class' => 'dialog_button', 'data-dialog' => 'go_structure')),
            array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/frames.png") . '<span>Explore Structure</span>', 'url' => $this->createUrl('/site/users/explore')),
            array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/frames.png") . '<span>Options</span>', 'url' => '#',
                'itemOptions' => array('class' => 'sub-menu'),
                'submenuOptions' => array('class' => 'sub'),
                'items' => array(
                    array('label' => '<span>Models</span>', 'url' => '#',
                        'itemOptions' => array('class' => 'sub-menu'),
                        'submenuOptions' => array('class' => 'drawer'),
                        'items' => array(
                            array('label' => '<span>Organization Chart</span>', 'url' => Yii::app()->createAbsoluteUrl('site/default/index')),
                            array('label' => '<span>Manager</span>', 'url' => Yii::app()->createAbsoluteUrl('site/default/index?manager=true')),
                            array('label' => '<span>Organization</span>', 'url' => Yii::app()->createAbsoluteUrl('site/default/index?organization=true')),
                            array('label' => '<span>Staff</span>', 'url' => Yii::app()->createAbsoluteUrl('site/default/index?staff=true')),
                            array('label' => '<span>Phones</span>', 'url' => Yii::app()->createAbsoluteUrl('site/default/index?phone=true'))
                        )),
                    array('label' => '<span>Styles</span>', 'url' => '#',
                        'itemOptions' => array('class' => 'sub-menu'),
                        'submenuOptions' => array('class' => 'drawer'),
                        'items' => array(
                            array('label' => '<span>Horizontal</span>', 'url' => Yii::app()->createAbsoluteUrl('site/default/index')),
                        )),
                    array('label' => '<span>Levels</span>', 'url' => '#',
                        'itemOptions' => array('class' => 'sub-menu'),
                        'submenuOptions' => array('class' => 'drawer'),
                        'items' => array(
                            array('label' => '<span>3 Levels</span>', 'url' => Yii::app()->createAbsoluteUrl('site/default/index?depth=3')),
                            array('label' => '<span>4 Levels</span>', 'url' => Yii::app()->createAbsoluteUrl('site/default/index?depth=4')),
                            array('label' => '<span>5 Levels</span>', 'url' => Yii::app()->createAbsoluteUrl('site/default/index?depth=5')),
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

<div class="display_none">
    <div id="go_structure" class="dialog_content" title="Go to structure">
         <?php
                    $this->widget('CTreeView', array(
                        'id' => 'structure',
                        'data' => Users::model()->getTreeItems(1, true, false),
                        'control' => '#structure',
                        'animated' => 'fast',
                        'collapsed' => false,
                        'htmlOptions' => array(
                            'class' => 'filetree',
                        )
                    ));
                ?>
    </div>
</div>

<?php
$js = <<< EOD
    $(".dialog_button").on("click", function(){
        $("#a_prof_"+$(this).data("dialog")).trigger("click");
    });
EOD;
Yii::app()->clientScript->coreScriptPosition = CClientScript::POS_END;
Yii::app()->clientScript->registerScript('sidebarnav', $js);
?>

