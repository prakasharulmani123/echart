<?php

class UserController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
//	public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
//            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'changestatus', 'deletemultiple', 'create', 'update', 'admin', 'delete'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Users();
        $model->setScenario('create');
        $profModel = new UserProfile();
        // Uncomment the following line if AJAX validation is needed
         $this->performAjaxValidation($model);
        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            $model->setAttribute('parent_id', $_POST['Users']['parent_id']);
            $profModel->attributes = $_POST['UserProfile'];

            $valid = $model->validate();
            $valid = $profModel->validate() && $valid;
            if ($valid):
                $model->save(false);
                $profModel->user_id = $model->user_id;
                $profModel->save(false);

//                if (!empty($model->useremail)):
//                    $mail = new Sendmail();
//                    $nextstep_url = Yii::app()->createAbsoluteUrl('/site/default/index');
//                    $subject = "Registraion Mail From - " . SITENAME;
//                    $trans_array = array(
//                        "{USERNAME}" => ucwords(trim("$profModel->prof_firstname $profModel->prof_lastname")),
////                        "{EMAIL_ID}" => $model->user_email,
////                        "{STAFF_PASSWORD}" => $password,
//                        "{NEXTSTEPURL}" => $nextstep_url,
//                    );
//                    $message = $mail->getMessage('registration', $trans_array);
//                    $mail->send($model->useremail, $subject, $message);
//                    $this->redirect(array('index'));
//                endif;
                $this->redirect(array('index'));
            endif;
        }

        $this->render('create', compact('model', 'profModel'));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $profModel = UserProfile::model()->find("user_id = '$id'");

        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            $model->setAttribute('parent_id', $_POST['Users']['parent_id']);
            $profModel->attributes = $_POST['UserProfile'];
            $valid = $model->validate();
            $valid = $profModel->validate() && $valid;

            if ($valid) {
                $model->save(false);
                $profModel->save(false);
                Yii::app()->user->setFlash('green', 'user account has been updated Successfully');
                $this->redirect(array('index'));
            }
        }

        $this->render('update', compact('model', 'profModel'));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $user = $this->loadModel($id);

        if (empty($user))
            throw new CHttpException(404, 'The requested page does not exist.');

        $user->delete();
        Yii::app()->user->setFlash('green', 'You have deleted successfully');
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
//        }else{
//            Yii::app()->user->setFlash('error', 'Faield to delete');
//        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $Criteria = new CDbCriteria();
        $Criteria->condition = "user_status != '2'";
        $Criteria->order = 'created DESC';
        $users = Users::model()->findAll($Criteria);

        $this->render('index', array(
            'users' => $users,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Users::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionChangestatus($id) {
        $user = $this->loadModel($id);
        $user->user_status = ($user->user_status == 0) ? 1 : 0;
        if ($user->save(false)) {
            $user->user_status == 0 ? $status = 'In-Active' : $status = 'Active';
            echo '"' . $user->user_name . '" status: ' . $status;
        } else {
            echo 'Error while changing status !!!';
        }
    }

    public function actionDeletemultiple() {
        $return = array();
        foreach ($_POST['id'] as $id) {
            $user = $this->loadModel($id);
            Diary::model()->deleteAll("diary_user_id = $id");
            Entry::model()->deleteAll("temp_activation_key = '$user->user_activation_key'");

            if ($user->delete()) {
                $return['sts'] = 'green';
                $return['text'] = 'Selected Users deleted successfully';
            } else {
                $return['sts'] = 'fail';
                $return['text'] = 'Failed to delete this user: ' . $user->user_name;
                echo json_encode($return);
                exit;
            }
        }
        echo json_encode($return);
    }

}
