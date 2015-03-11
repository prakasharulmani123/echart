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
                    <div id="beforesend" style="display: none; text-align: left; font-weight: bolder; font-size: 18px;">Please Wait... Processing chart ......</div>
                    <div id="orgChart"></div>
                    <div id="goback" style="display: none; text-align:center">
                        <a href="<?php echo Yii::app()->createAbsoluteUrl('site/default/index')?>">Go back</a>
                    </div>
                    <div id="canvaspng" style="display: none"></div>

                </div>
            </div>
        </div>
        
        <?php
        $cs_pos_end = CClientScript::POS_END;
        $expurl = Yii::app()->createAbsoluteUrl('site/default/exportpng');

//        $cs->registerCoreScript('jquery');

        $cs->registerScriptFile($this->themeUrl . '/scripts/plugins-min.js', $cs_pos_end);
        $cs->registerScriptFile($this->themeUrl . '/scripts/adminica/adminica_all-min.js', $cs_pos_end);
        $cs->registerScriptFile($this->themeUrl . '/scripts/organizechart/jquery.orgchart.min.js', $cs_pos_end);

        $cs->registerScriptFile($this->themeUrl . '/scripts/treeview/jquery.treeview.js', $cs_pos_end);
        $cs->registerScriptFile($this->themeUrl . '/scripts/treeview/treeconfig.js', $cs_pos_end);
        
        $cs->registerScriptFile($this->themeUrl . '/scripts/exportimage/easel.js', $cs_pos_end);
        $cs->registerScriptFile($this->themeUrl . '/scripts/exportimage/base64.js', $cs_pos_end);
        $cs->registerScriptFile($this->themeUrl . '/scripts/exportimage/canvas2image.js', $cs_pos_end);
        $cs->registerScriptFile($this->themeUrl . '/scripts/exportimage/html2canvas.js', $cs_pos_end);

        ?>
        <?php
        $js = <<< EOD
        $("#organisation").orgChart({container: $("#orgChart")});
        $(".node").addClass("big");
        $(".adjunct").removeClass("big");
                
    
        html2canvas(document.body).then(function(canvas) {
                $("#canvaspng").html(canvas);
//            document.body.appendChild(canvas);
		// Get the canvas screenshot as PNG
		var screenshot = Canvas2Image.saveAsPNG(canvas, true);
		// This is a little trick to get the SRC attribute from the generated <img> screenshot
		canvas.parentNode.appendChild(screenshot);
		screenshot.id = "canvasimage";		
		data = $('#canvasimage').attr('src');
		canvas.parentNode.removeChild(screenshot);
		// Send the screenshot to PHP to save it on the server
		var url = 'exportpng';
		$.ajax({ 
		    type: "POST", 
		    url: url,
		    dataType: 'text',
		    data: {
		        base64data : data
		    },
                    beforeSend: function(){
                        $("#beforesend").show();
                    },
                    success: function(data){
                        $("#beforesend").hide();
                        $("#orgChart").hide();
                        $("#canvaspng").show();
                        $("#goback").show();
                        window.location.href = '$expurl'
                    }
                
		});
        });
    
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
                height: 90px !important;
            }
        </style>

    </body>
</html>
