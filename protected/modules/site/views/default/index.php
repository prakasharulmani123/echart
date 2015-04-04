<?php
//Get Departments to show
if ($deptid > 1) {
    $depts = Yii::app()->db->createCommand(
                    "SELECT GetDeptTree(dept_id) as depts
                FROM app_departmets
                Where dept_id = '{$deptid}'")->queryRow();

    $depts = "'" . $deptid . "','" . str_replace(",", "','", $depts['depts']) . "'";
    $departments = Department::model()->findAll("dept_id IN ({$depts}) And status = '1'");
} else {
    $departments = Department::model()->isActive()->findAll();
}

//Get Staff count by Tree function
$dept_tree = Yii::app()->db->createCommand(
                "SELECT dept_id, dept_name, dept_head_user_id, GetDeptTree(dept_id) as tree
                FROM app_departmets
                HAVING GetDeptTree(dept_id) != ''")->queryAll();
$dept_count = array();
foreach ($dept_tree as $key => $tree) {
    $trees = explode(',', $tree['tree']);
    $users_count = 0;
    foreach ($trees as $value) {
        $users_count += UserProfile::model()->count('prof_department = :dept_id', array(':dept_id' => $value));
    }
    $users_count += UserProfile::model()->count('prof_department = :dept_id And user_id != :user_id', array(':dept_id' => $tree['dept_id'], ':user_id' => $tree['dept_head_user_id']));
    $dept_count[$tree['dept_id']] = $users_count;
}

//Creating Parent keys for Chart Tree view
$arrayDepartments = $deptKeys = array();
foreach ($departments as $key => $department) {
    if ($department->childCount > 0) {
        $deptKeys[$department->dept_id] = $department->dept_name;
    }
}


$unique_dept = $head_users = array();
$show_dept_without_users = false;
//Generate Parent department First
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
                'user_name' => isset($department->deptHead->userProfile->prof_firstname) ? $department->deptHead->userProfile->prof_firstname : '',
                'user_id' => isset($department->deptHead->user_id) ? $department->deptHead->user_id : '',
                'user_image' => isset($department->deptHead->user_prof_image) ? $department->deptHead->user_prof_image : '',
                'user_phone' => isset($department->deptHead->userProfile->prof_mobile) ? $department->deptHead->userProfile->prof_mobile : '',
                'user_email' => isset($department->deptHead->user_email) ? $department->deptHead->user_email : '',
                'position_id' => isset($department->deptHead->userProfile->prof_position) ? $department->deptHead->userProfile->prof_position : '',
                'dept_head' => true,
            );
            if (isset($department->deptHead->userProfile->profPersonalStaff)) {
                $assistant = $department->deptHead->userProfile->profPersonalStaff;
                $arrayDepartments[$key]['assistant_id'] = $assistant->user_id;
                $arrayDepartments[$key]['assistant_name'] = $assistant->userProfile->prof_firstname;
                $arrayDepartments[$key]['assistant_image'] = $assistant->user_prof_image;
                $arrayDepartments[$key]['assistant_department'] = $assistant->userProfile->profDepartment->dept_name;
            }
            array_push($head_users, $department->deptHead->user_id);
        }
    }
}

if (!isset($_GET['organization'])) {
    $department2 = $arrayDepartments;
    $arr_count = key(array_slice($arrayDepartments, -1, 1, TRUE)) + 1;
    //Generate Childs departments for the parents
    foreach ($department2 as $department) {
//        if ($department['org_parent_id'] != 0) {
            if (empty($unique_dept) || !in_array($department['dept_id'], $unique_dept)) {
                $users = Users::model()->findAll('parent_dept_id = :parent_dept_id AND user_id != :user_id ', array(
                    ':parent_dept_id' => $department['dept_id'],
                    ':user_id' => $department['user_id'] != 0 ? $department['user_id'] : '',
                ));

                foreach ($users as $key => $user) {
                    if (!in_array($user->user_id, $head_users)) {
                        $parentkey = array_search($department['dept_name'], $deptKeys);
                        $arr_count++;
                        $arrayDepartments[$arr_count] = array(
                            'org_parent_id' => $department['org_parent_id'],
                            'parent_id' => $parentkey,
                            'dept_id' => $user->userProfile->profDepartment->dept_id,
                            'dept_name' => $user->userProfile->profDepartment->dept_name,
                            'user_name' => $user->userProfile->prof_firstname,
                            'user_id' => $user->user_id,
                            'user_image' => $user->user_prof_image,
                            'user_phone' => $user->userProfile->prof_mobile,
                            'user_email' => $user->user_email,
                            'position_id' => $user->userProfile->prof_position,
                        );
                        if (isset($user->userProfile->profPersonalStaff)) {
                            $assistant = $user->userProfile->profPersonalStaff;
                            $arrayDepartments[$arr_count]['assistant_id'] = $assistant->user_id;
                            $arrayDepartments[$arr_count]['assistant_name'] = $assistant->userProfile->prof_firstname;
                            $arrayDepartments[$arr_count]['assistant_image'] = $assistant->user_prof_image;
                            $arrayDepartments[$arr_count]['assistant_department'] = $assistant->userProfile->profDepartment->dept_name;
                        }
                    }
                }
//            }
            array_push($unique_dept, $department['dept_id']);
        }
    }
}

//Manager Filters
$managers_list = Position::model()->managersList();
if($_GET['manager']){
    foreach ($arrayDepartments as $key => $arrayDepartment) {
        if(!in_array($arrayDepartment['position_id'], $managers_list)){
            unset($arrayDepartments[$key]);
        }
    }
}

//Main function for create tree design
function createDeptTree($array, $currentParent, $currLevel = 0, $prevLevel = -1, $topParent, $dept_count) {
    foreach ($array as $categoryId => $category) {
        if ($currentParent == $category['parent_id']) {
            if ($currLevel > $prevLevel) {
                echo $topParent == 0 ? '<ul id="organisation" class="display_none">' : '<ul>';
            }
            if ($currLevel == $prevLevel)
                echo '</li>';

            $label = "<li class='big'>";
            $label .= "<span id='orgainzeImage{$category['user_id']}'>";
            $label .=!isset($_GET['organization']) ? "<em>{$category['user_name']}</em><br>" : '';
            $label .= '<a class="dialog_button" data-dialog="prof_' . $category['user_id'] . '" href="javascript:popup(' . $category['user_id'] . ')">';
            $label .= '<img class="orgainzeImage" src="' . Yii::app()->createAbsoluteUrl('uploads/user/' . $category['user_image']) . '" title="' . $category['user_name'] . '" />';
            $label .= "</a>";
            $label .= "</span>";
            $label .= "<div class='orgDept'><p>{$category['dept_name']}</p></div>";

            $staff_count = 0;
            if ($category['dept_id'] != $category['org_parent_id'] && isset($category['dept_head'])) {
                $staff_count = $dept_count[$category['dept_id']];
            }

            if (isset($_GET['staff']) && $_GET['staff'] == true && $staff_count > 0) {
                $label .= '<div class="orgStaff"><p>' . $staff_count . '</p></div>';
            }
            $ext_link = '';
            $ext_link .= isset($_GET['staff']) ? '&staff=true' : '';
            $ext_link .= isset($_GET['organization']) ? '&organization=true' : '';
            $ext_link .= isset($_GET['manager']) ? '&manager=true' : '';

            $down_condition = $staff_count != 0 && $category['org_parent_id'] != '0';
            $move_img = $down_condition ? CHtml::link(
                            CHtml::image(Yii::app()->createAbsoluteUrl('themes/site/images/interface/navidown.gif')), Yii::app()->createAbsoluteUrl('site/default/index?deptid=' . $category['dept_id'] . $ext_link), array('title' => 'Up in hierarchy')
                    ) : '';


            if (isset($_GET['deptid']) && $_GET['deptid'] != '') {
                if ($_GET['deptid'] == $category['dept_id'] && $category['org_parent_id'] != '0' && isset($category['dept_head'])) {
                    $move_img = CHtml::link(
                                    CHtml::image(Yii::app()->createAbsoluteUrl('themes/site/images/interface/naviup.gif')), Yii::app()->createAbsoluteUrl('site/default/index?deptid=' . $category['org_parent_id'] . $ext_link), array('title' => 'Down in hierarchy'));
                }
            }

            if (!isset($_GET['staff'])) {
                $label .= $category['user_phone'] != '' ? "<div class='orgPhone'><p>{$category['user_phone']}</p></div>" : '';
                $label .= $category['user_email'] != '' ? "<div class='orgEmail'><p>{$category['user_email']}</p></div>" : '';
            }
            $label .= '<div class="hire_img">' . $move_img . '</div>';

            if (isset($category['assistant_name']) && !isset($_GET['organization']) /* && $organize_chart == true */) {
                $img_path = Yii::app()->createAbsoluteUrl('uploads/user/' . $category['assistant_image']);
                $label .= '<adjunct>' . '<span id="orgainzeImage' . $category['assistant_id'] . '"><a href="javascript:popup(' . $category['assistant_id'] . ')">';
                $label .= "<img src='{$img_path}' class='orgainzeImage' alt='{$category['assistant_name']}' />";
                $label .= $category['assistant_name'];
                $label .= "</a></span><br />";
                $label .= "<span>{$category['assistant_department']}</span></adjunct>";
            }

            echo $label;
            if ($currLevel > $prevLevel) {
                $prevLevel = $currLevel;
            }
            $currLevel++;
            createDeptTree($array, $categoryId, $currLevel, $prevLevel, 1, $dept_count);
            $currLevel--;
        }
    }
    if ($currLevel == $prevLevel)
        echo ' </li>  </ul> ';
}
?>
<div class="flat_area grid_16">
    <?php createDeptTree($arrayDepartments, 0, 0, -1, 0, $dept_count); ?>
    <?php // createDeptTree($arrayDepartments, 2, 2, 1, 0); ?>
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
$users = Users::model()->with('userProfile')->isActive()->findAll();
foreach ($users as $key => $user) {
    ?>
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
    $img = CHtml::image(Yii::app()->createAbsoluteUrl('uploads/user/' . $user->user_prof_image), '', array('width' => '50', 'height' => '50', 'style' => 'margin-left:70px;'));
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
    div.orgChart div.node.big {
        height: auto;
    }
</style>
