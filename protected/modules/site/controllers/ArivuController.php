<?php

class ArivuController extends Controller {
    public function actionPrint() {
        $rend = $this->renderPartial('print', array(), true, true);
        echo '<pre>';
        print_r($rend);
    }
}
