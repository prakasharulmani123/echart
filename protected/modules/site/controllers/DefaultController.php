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
        $rend = $this->renderPartial('print', array(), true, true);
        echo '<pre>';
        print_r($rend);
    }
    
    public function actionDownload() {
        $mPDF1 = Yii::app()->ePdf->mpdf();

        # Load a stylesheet
//        $stylesheet1 = file_get_contents( Yii::getPathOfAlias('webroot.css').'/styles/adminica/reset.css');
//        $stylesheet2 = file_get_contents( Yii::getPathOfAlias('webroot.css').'/styles/plugins/all/plugins.css');
//        $stylesheet3 = file_get_contents( Yii::getPathOfAlias('webroot.css').'/styles/adminica/all.css');
//        $stylesheet4 = file_get_contents( Yii::getPathOfAlias('webroot.css').'/styles/themes/switcher.css');
//        $stylesheet5 = file_get_contents( Yii::getPathOfAlias('webroot.css').'/styles/themes/nav_top.css');
//        $stylesheet6 = file_get_contents( Yii::getPathOfAlias('webroot.css').'/styles/themes/theme_blue.css');
//        $stylesheet7 = file_get_contents( Yii::getPathOfAlias('webroot.css').'/styles/adminica/colours.css');
//        $stylesheet8 = file_get_contents( Yii::getPathOfAlias('webroot.css').'/styles/custom.css');
//        $stylesheet9 = file_get_contents( Yii::getPathOfAlias('webroot.css').'/styles/plugins/organizechart/jquery.orgchart.css');
//        $stylesheet10 = file_get_contents( Yii::getPathOfAlias('webroot.css').'/styles/plugins/treeview/jquery.treeview.css');
//        $mPDF1->WriteHTML($stylesheet1, 1);
//        $mPDF1->WriteHTML($stylesheet2, 2);
//        $mPDF1->WriteHTML($stylesheet3, 3);
//        $mPDF1->WriteHTML($stylesheet4, 4);
//        $mPDF1->WriteHTML($stylesheet5, 5);
//        $mPDF1->WriteHTML($stylesheet6, 6);
//        $mPDF1->WriteHTML($stylesheet7, 7);
//        $mPDF1->WriteHTML($stylesheet8, 8);
//        $mPDF1->WriteHTML($stylesheet9, 9);
//        $mPDF1->WriteHTML($stylesheet10, 10);
        $rend = $this->renderPartial('print', array(), true, true);
        $mPDF1->WriteHTML($rend);

        # Renders image
//        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));

        # Outputs ready PDF
        $mPDF1->Output();
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
