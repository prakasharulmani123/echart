<!doctype html public "✰">
<!--[if lt IE 7]> <html lang="en-us" class="no-js ie6"> <![endif]-->
<!--[if IE 7]>    <html lang="en-us" class="no-js ie7"> <![endif]-->
<!--[if IE 8]>    <html lang="en-us" class="no-js ie8"> <![endif]-->
<!--[if IE 9]>    <html lang="en-us" class="no-js ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en-us" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title><?php echo Yii::app()->name . " - Admin Panel"; ?></title>

        <meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1;">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

        <link href="images/interface/iOS_icon.png" rel="apple-touch-icon">
        <!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700">-->
        <!-- Styles -->
        <?php
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($this->themeUrl . '/styles/plugins/organizechart/demo.css');
        $cs->registerCssFile($this->themeUrl . '/styles/plugins/organizechart/jquery.orgchart.css');
        $cs->registerCssFile($this->themeUrl . '/styles/plugins/treeview/jquery.treeview.css');
        ?>
    </head>
    <body>
        <div id="wrapper" data-adminica-nav-top="1" data-adminica-side-top="1">
            <div id="main_container" class="main_container container_16 clearfix" style="float: left">
                <?php
                $deptid = 1;
                $departments = Department::model()->isActive()->findAll();

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
                        if ($department['org_parent_id'] != 0) {
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
                                        }
                                    }
                                }
                            }
                            array_push($unique_dept, $department['dept_id']);
                        }
                    }
                }

                //Main function for create tree design
                function createDeptTree($array, $currentParent, $currLevel = 0, $prevLevel = -1, $topParent, $dept_count) {
                    foreach ($array as $categoryId => $category) {
                        if ($currentParent == $category['parent_id']) {
                            if ($currLevel > $prevLevel) {
                                echo $topParent == 0 ? '<ul id="organisation" style="display:none">' : '<ul>';
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
                                $label .= "<img src='{$img_path}' class='orgainzeImage' />";
                                $label .= $category['assistant_name'];
                                $label .= "</a></span></adjunct>";
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
        </div>
    </div>
    <?php
    $cs_pos_end = CClientScript::POS_END;
    $cs->registerScriptFile($this->themeUrl . '/scripts/plugins-min.js', $cs_pos_end);
    $cs->registerScriptFile($this->themeUrl . '/scripts/adminica/adminica_all-min.js', $cs_pos_end);
    $cs->registerScriptFile($this->themeUrl . '/scripts/organizechart/jquery.orgchart.min.js', $cs_pos_end);

    $cs->registerScriptFile($this->themeUrl . '/scripts/treeview/jquery.treeview.js', $cs_pos_end);
    $cs->registerScriptFile($this->themeUrl . '/scripts/treeview/treeconfig.js', $cs_pos_end);
    ?>
    <?php
    $js = <<< EOD
    $("#organisation").orgChart({container: $("#orgChart")});
    $(".node").addClass("big");
    $(".adjunct").removeClass("big");
EOD;

    Yii::app()->clientScript->coreScriptPosition = CClientScript::POS_END;
    Yii::app()->clientScript->registerScript('organisation', $js);
    ?>

    <style type="text/css">
        .ui-tabs-hide{
            display: none !important;
        }
        div.orgChart{
            float: left;
        }

        div.adjunct.node {
            margin-left: -100px !important;
        }

        .orgDept img{
            display: none;
        }

        div.orgChart div.node.big {
            height: auto;
        }
    </style>

</body>
</html>
