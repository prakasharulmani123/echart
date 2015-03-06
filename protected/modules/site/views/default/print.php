<?php
$cs = Yii::app()->getClientScript();
//$cs->registerCssFile($this->themeUrl . '/styles/adminica/reset.css');
//$cs->registerCssFile($this->themeUrl . '/styles/plugins/all/plugins.css');
//$cs->registerCssFile($this->themeUrl . '/styles/adminica/all.css');
//$cs->registerCssFile($this->themeUrl . '/styles/themes/switcher.css');
//$cs->registerCssFile($this->themeUrl . '/styles/themes/nav_top.css');
//$cs->registerCssFile($this->themeUrl . '/styles/themes/theme_blue.css');
//$cs->registerCssFile($this->themeUrl . '/styles/adminica/colours.css');

$cs->registerCssFile($this->themeUrl . '/styles/plugins/organizechart/jquery.orgchart.css');
$cs_pos_end = CClientScript::POS_END;
//
//$cs->registerScriptFile($this->themeUrl . '/scripts/plugins-min.js', $cs_pos_end);
$cs->registerScriptFile($this->themeUrl . '/scripts/organizechart/jquery.orgchart.min.js', $cs_pos_end);


$users = Users::model()->isActive()->findAll(array('order'=>'parent_id ASC'));
$arrayUsers = array();
$assist = explode(',', UserProfile::getAssitants());

$i = 1;
foreach ($users as $key => $user) {
    if(!in_array($user->user_id, $assist)){
        $assistant = '';
        if($user->userProfile->prof_personal_staff != '0'){
            $assistant = $user->userProfile->profPersonalStaff->userProfile->prof_firstname;
        }
        $arrayUsers[$i++] = array(
            'parent_id' => $user->parent_id,
            'user_id' => $user->user_id,
            'name' => $user->userProfile->prof_firstname,
            'image' => $user->user_prof_image,
            'department' => $user->userProfile->profDepartment->dept_name,
            'assistant_id' => $user->userProfile->prof_personal_staff,
            'assistant' => $assistant
        );
    }
}

if(!function_exists(createTree)){
    function createTree($array, $currentParent, $currLevel = 0, $prevLevel = -1, $topParent) {
        foreach ($array as $categoryId => $category) {
            if ($currentParent == $category['parent_id']) {
                if ($currLevel > $prevLevel) {
                    if ($topParent == 0) {
                        echo '<ul id="organisation">';
                    } else {
                        echo '<ul>';
                    }
                }
                if ($currLevel == $prevLevel)
                    echo '</li>';
                $assis = $category['assistant'] == '' ? '' : '<adjunct>'. '<a href="javascript:popup('.$category['assistant_id'].')">'.$category['assistant'].'</a></adjunct>';
                echo '<li data-username="' . $category['name'] . '" data-userid="' . $category['user_id'] . '" class="big">'.'<em>' . $category['name'] . '</em><br/>'
//                . '<a class="dialog_button" href="javascript:popup('.$category['user_id'].')" data-dialog="prof_' . $category['user_id'] . '"><img class="orgainzeImage" title="' . $category['name'] . '" src="' . Yii::app()->createAbsoluteUrl('uploads/user/'.$category['image']) . '"/></a>'
                . '<p class="orgDept">' . $category['department'] . '</p>';
                if ($currLevel > $prevLevel) {
                    $prevLevel = $currLevel;
                }
                $currLevel++;
                createTree($array, $categoryId, $currLevel, $prevLevel, 1);
                $currLevel--;
            }
        }
        if ($currLevel == $prevLevel)
            echo ' </li>  </ul> ';
    }
}
?>
<?php createTree($arrayUsers, 0, 0, -1, 0); ?>
<!--<div id="orgChart"></div>-->

<?php
$js = <<< EOD
//    $("#organisation").orgChart({container: $("#orgChart")});
EOD;

//Yii::app()->clientScript->coreScriptPosition = CClientScript::POS_END;
//Yii::app()->clientScript->registerScript('organisation', $js);
?>
<style>
    .display_none{
        display: none;
    }
</style>