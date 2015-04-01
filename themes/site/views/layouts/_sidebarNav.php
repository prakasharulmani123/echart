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
            array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/frames.png") . '<span>Explorer Style</span>', 'url' => $this->createUrl('/site/users/explore')),
            array('label' => CHtml::image("$this->themeUrl/images/icons/small/grey/frames.png") . '<span>Options</span>', 'url' => '#',
                'itemOptions' => array('class' => 'sub-menu'),
                'submenuOptions' => array('class' => 'sub'),
                'items' => array(
                    array('label' => '<span>Models</span>', 'url' => '#',
                        'itemOptions' => array('class' => 'sub-menu'),
                        'submenuOptions' => array('class' => 'drawer'),
                        'items' => array(
//                            array('label' => '<span>Organization Chart</span>', 'url' => Yii::app()->createAbsoluteUrl('site/default/index')),
                            array('label' => '<span>Manager</span>', 'url' => Yii::app()->createAbsoluteUrl('site/default/index?manager=true')),
                            array('label' => '<span>Organization</span>', 'url' => Yii::app()->createAbsoluteUrl('site/default/index?organization=true')),
                            array('label' => '<span>Staff</span>', 'url' => Yii::app()->createAbsoluteUrl('site/default/index?staff=true')),
//                            array('label' => '<span>Phones</span>', 'url' => Yii::app()->createAbsoluteUrl('site/default/index?phone=true'))
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

<?php
$departments = Department::model()->isActive()->findAll();
$arrayDepartments = array();
//Creating Parent keys for Chart Tree view
$arrayDepartments = $deptKeys = array();
foreach ($departments as $key => $department) {
    if ($department->childCount > 0) {
        $deptKeys[$department->dept_id] = $department->dept_name;
    }
}

$show_dept_without_users = false;
foreach ($departments as $key => $department) {
    if ($department->childCount > 0) {
        if (isset($department->deptHead->user_id) || $show_dept_without_users == true) {
            $key = array_search($department->dept_name, $deptKeys);

            if ($deptid > 1) {
                $parentkey = $department->dept_id == $deptid ? 0 : array_search($department->deptParent->dept_name, $deptKeys);
            } else {
                $parentkey = array_search($department->deptParent->dept_name, $deptKeys);
            }
            $arrayDepartments[$key] = array(
                'org_parent_id' => $department->dept_parent_id,
                'parent_id' => $parentkey != '' ? $parentkey : 0,
                'dept_id' => $department->dept_id,
                'dept_name' => $department->dept_name,
                'user_id' => isset($department->deptHead->user_id) ? $department->deptHead->user_id : '',
                'head_name' => isset($department->deptHead->userProfile->prof_firstname) ? $department->deptHead->userProfile->prof_firstname : '',
            );
            if (isset($department->deptHead->userProfile->profPersonalStaff)) {
                $assistant = $department->deptHead->userProfile->profPersonalStaff;
                $arrayDepartments[$key]['assistant_id'] = $assistant->user_id;
                $arrayDepartments[$key]['assistant'] = $assistant->userProfile->prof_firstname;
            }
            $child_users = CHtml::listData(Users::model()->with('userProfile')->findAll('parent_dept_id = :dept_id', array(':dept_id' => $department->dept_id)), 'user_id', 'userProfile.prof_firstname');
            $arrayDepartments[$key]['child_users'] = !empty($child_users) ? $child_users : array();
        }
    }
}

function createStructureTree($array, $currentParent, $currLevel = 0, $prevLevel = -1, $topParent) {
    foreach ($array as $categoryId => $category) {
        if ($currentParent == $category['parent_id']) {
            $op_cl = 'closed';
            if ($currLevel > $prevLevel) {
                if ($topParent == 0) {
                    echo '<ul class="filetree">';
                    $op_cl = 'open';
                } else {
                    echo '<ul>';
                }
            }
            if ($currLevel == $prevLevel)
                echo '</li>';

            $link = CHtml::link($category['dept_name'], Yii::app()->createAbsoluteUrl('site/default/index?deptid=' . $category['dept_id'] . $ext_link), array('title' => $category['dept_name']));
            echo '<li class="' . $op_cl . '">' . '<span class="folder">' . $link . '</span>';
            if ($currLevel > $prevLevel) {
                $prevLevel = $currLevel;
            }
            $currLevel++;
            createStructureTree($array, $categoryId, $currLevel, $prevLevel, 1);
            $currLevel--;
        }
    }
    if ($currLevel == $prevLevel)
        echo ' </li>  </ul> ';
}

$js = <<< EOD
    $(".dialog_button").on("click", function(){
        $("#a_prof_"+$(this).data("dialog")).trigger("click");
    });
EOD;
?>

<script type="text/javascript">
    function popup(value) {
        $("#a_prof_" + value).trigger("click");
    }
</script>
<?php
Yii::app()->clientScript->coreScriptPosition = CClientScript::POS_END;
Yii::app()->clientScript->registerScript('_sidebar', $js);
?>

<style type="text/css">
    .ui-tabs-hide{
        display: none !important;
    }
</style>

<div class="display_none">
    <div id="go_structure" class="dialog_content" title="Go to structure">
        <?php createStructureTree($arrayDepartments, 0, 0, -1, 0); ?>
         <?php
//                    $this->widget('CTreeView', array(
//                        'id' => 'structure',
//                        'data' => Users::model()->getTreeItems(1, true, false),
//                        'control' => '#structure',
//                        'animated' => 'fast',
//                        'collapsed' => false,
//                        'htmlOptions' => array(
//                            'class' => 'filetree',
//                        )
//                    ));
                ?>
    </div>
</div>
