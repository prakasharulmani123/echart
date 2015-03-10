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
//        $cs->registerCssFile($this->themeUrl . '/styles/adminica/reset.css');
//        $cs->registerCssFile($this->themeUrl . '/styles/plugins/all/plugins.css');
//        $cs->registerCssFile($this->themeUrl . '/styles/adminica/all.css');
//        $cs->registerCssFile($this->themeUrl . '/styles/themes/switcher.css');
//        $cs->registerCssFile($this->themeUrl . '/styles/themes/nav_top.css');
//        $cs->registerCssFile($this->themeUrl . '/styles/themes/theme_blue.css');
//        $cs->registerCssFile($this->themeUrl . '/styles/adminica/colours.css');
//
//        $cs->registerCssFile($this->themeUrl . '/styles/custom.css');
        $cs->registerCssFile($this->themeUrl . '/styles/plugins/organizechart/demo.css');
        $cs->registerCssFile($this->themeUrl . '/styles/plugins/organizechart/jquery.orgchart.css');

        $cs->registerCssFile($this->themeUrl . '/styles/plugins/treeview/jquery.treeview.css');

//        $cs->registerCssFile($this->themeUrl . '/styles/plugins/tooltip/tooltipster.css');
//        $cs->registerCssFile($this->themeUrl . '/styles/plugins/tooltip/themes/tooltipster-light.css');
//        $cs->registerCssFile($this->themeUrl . '/styles/plugins/tooltip/themes/tooltipster-noir.css');
//        $cs->registerCssFile($this->themeUrl . '/styles/plugins/tooltip/themes/tooltipster-punk.css');
//        $cs->registerCssFile($this->themeUrl . '/styles/plugins/tooltip/themes/tooltipster-shadow.css');
        ?>
    </head>
    <body>
        <div id="wrapper" data-adminica-nav-top="1" data-adminica-side-top="1">
            <div id="main_container" class="main_container container_16 clearfix" style="float: left">
                <div class="flat_area grid_16">
                    <div style="display: none">
                        <?php
                        $this->widget('CTreeView', array(
                            'id' => 'organisation',
                            'data' => Users::model()->getTreeItems(1, true, true),
                            'control' => '#treecontrol',
                            'animated' => 'fast',
                            'collapsed' => true,
                            'htmlOptions' => array(
                                'class' => 'filetree',
                            )
                        ));
                        ?>
                    </div>
                    <div id="orgChart"></div>
                </div>
            </div>
        </div>
        <?php
        $cs_pos_end = CClientScript::POS_END;

//        $cs->registerCoreScript('jquery');

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
                height: 80px !important;
            }
        </style>

    </body>
</html>
