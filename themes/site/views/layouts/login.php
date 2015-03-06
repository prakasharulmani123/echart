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
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700">
        <!-- Styles -->
        <?php
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($this->themeUrl . '/styles/adminica/reset.css');
        $cs->registerCssFile($this->themeUrl . '/styles/plugins/all/plugins.css');
        $cs->registerCssFile($this->themeUrl . '/styles/adminica/all.css');
        $cs->registerCssFile($this->themeUrl . '/styles/themes/switcher.css');
        $cs->registerCssFile($this->themeUrl . '/styles/themes/nav_top.css');
        $cs->registerCssFile($this->themeUrl . '/styles/adminica/colours.css');
        ?>
    </head>
    <body>
        <div id="wrapper">
            <?php echo $content; ?>
        </div>
    </body>
</html>