<?php

class DefaultController extends Controller {

    public function actionIndex() {
        $userid = isset($_GET['userid']) ? $_GET['userid'] : '1';
        $depth = isset($_GET['depth']) ? $_GET['depth'] : 5;
        
        $this->render('index', array(
            'userid' => $userid,
            'phone' => $phone,
            'organization' => $organization,
            'depth' => $depth,
            'manager' => $manager,
            'staff' => $staff
            ));
    }
    
    public function actionPrint() {
//        $rend = $this->renderPartial('print', array(), true, true);
        $this->renderPartial('print', array(), false, true);
    }
    
    public function actionDownload() {
        require 'pdfcrowd/pdfcrowd.php';
        $client = new Pdfcrowd("prakasharulmani", "716b089f7ec811d7cec8156f399dd472");
        // convert a web page and store the generated PDF into a $pdf variable
        $pdf = $client->convertURI(Yii::app()->createAbsoluteUrl('site/default/print'));

        $date = strtotime(date('Y-m-d h:i:s'));
        // set HTTP response headers
        header("Content-Type: application/pdf");
        header("Cache-Control: max-age=0");
        header("Accept-Ranges: none");
        header("Content-Disposition: attachment; filename=\"chart_{$date}.pdf\"");

        // send the generated PDF 
        echo $pdf;
        exit;
        $mPDF1 = Yii::app()->ePdf->HTML2PDF();

        # Load a stylesheet
//        $stylesheet = file_get_contents(Yii::app()->createAbsoluteUrl('themes/site/styles/adminica/reset.css'));
//        $stylesheet .= file_get_contents(Yii::app()->createAbsoluteUrl('themes/site/styles/plugins/all/plugins.css'));
//        $stylesheet .= file_get_contents(Yii::app()->createAbsoluteUrl('themes/site/styles/adminica/all.css'));
//        $stylesheet .= file_get_contents(Yii::app()->createAbsoluteUrl('themes/site/styles/themes/switcher.css'));
//        $stylesheet .= file_get_contents(Yii::app()->createAbsoluteUrl('themes/site/styles/themes/nav_top.css'));
//        $stylesheet .= file_get_contents(Yii::app()->createAbsoluteUrl('themes/site/styles/adminica/colours.css'));
//        $stylesheet .= file_get_contents(Yii::app()->createAbsoluteUrl('themes/site/styles/custom.css'));
//        $stylesheet .= file_get_contents(Yii::app()->createAbsoluteUrl('themes/site/styles/plugins/organizechart/jquery.orgchart.css'));
//        $stylesheet .= file_get_contents(Yii::app()->createAbsoluteUrl('themes/site/styles/plugins/treeview/jquery.treeview.css'));
//        $mPDF1->WriteHTML($stylesheet, 1);
        $render = $this->renderPartial('print', array(), true, true);
//        echo ($render); exit;
        $mPDF1->WriteHTML($render);
//print $render;
//        exit;
        # Renders image
//        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
        # Outputs ready PDF
        $mPDF1->Output('doc.pdf','I');
    }

    public function actionUnderdevelopment() {
        $this->layout = '//layouts/frontinner';
        $this->render('underdevelopment');
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'signup') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
