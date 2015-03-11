<?php

class DefaultController extends Controller {

    public function actionIndex() {
        $userid = isset($_GET['userid']) ? $_GET['userid'] : '1';
        $depth = isset($_GET['depth']) ? $_GET['depth'] : 5;

        $this->render('index', array(
            'userid' => $userid,
            'depth' => $depth
        ));
    }

    public function actionPrint() {
        $model = new Users;

        if (Yii::app()->request->isPostRequest) {
            if ($_POST['Users']['print'] == 'pdf') {
                $this->redirect('download');
            } elseif ($_POST['Users']['print'] == 'png') {
                $this->redirect('printpng');
            }
        }
        $this->render('print', array('model' => $model));
    }

    public function actionPrintpdf() {
        $this->renderPartial('printpdf', array(), false, true);
    }

    public function actionPrintpng() {
        $this->renderPartial('printpng', array(), false, true);
    }

    public function actionExportpng() {
        if (isset($_REQUEST['base64data'])) {
            $data = $_REQUEST['base64data'];
            $image = explode('base64,', $data);
            file_put_contents('uploads/exportpng/chart.png', base64_decode($image[1]));
        } else {
            $filePath = 'uploads/exportpng/chart.png';
            $myfile = Yii::app()->file->set($filePath, true);

            if (Yii::app()->file->set($filePath)->exists) {
                $myfile->download();
            } else {

                echo Translate::__('File Not Found');
            }
            exit;

        }
    }

    public function actionDownload() {
        require 'pdfcrowd/pdfcrowd.php';
        $client = new Pdfcrowd("prakasharulmani", "716b089f7ec811d7cec8156f399dd472");
        // convert a web page and store the generated PDF into a $pdf variable
        $pdf = $client->convertURI(Yii::app()->createAbsoluteUrl('site/default/printpdf'));

        $date = strtotime(date('Y-m-d h:i:s'));
        // set HTTP response headers
        header("Content-Type: application/pdf");
        header("Cache-Control: max-age=0");
        header("Accept-Ranges: none");
        header("Content-Disposition: attachment; filename=\"chart_{$date}.pdf\"");

        // send the generated PDF 
        echo $pdf;
        exit;
        //MPDF not used
        $mPDF1 = Yii::app()->ePdf->HTML2PDF();
        # Load a stylesheet
//        $stylesheet = file_get_contents(Yii::app()->createAbsoluteUrl('themes/site/styles/adminica/reset.css'));
        $render = $this->renderPartial('print', array(), true, true);
//        echo ($render); exit;
        $mPDF1->WriteHTML($render);
//        exit;
        # Renders image
//        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
        # Outputs ready PDF
        $mPDF1->Output('doc.pdf', 'I');
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
