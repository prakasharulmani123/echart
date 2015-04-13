<?php

class DepartmentController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

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
                'actions' => array('index', 'view', 'create', 'update', 'delete', 'adduser', 'getchilds'),
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
        $model = new Department;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Department'])) {
            $model->attributes = $_POST['Department'];
            if ($model->save()) {
                Yii::app()->user->setFlash('green', 'Successfully Created');
                $this->redirect(array('index'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Department'])) {
            $model->attributes = $_POST['Department'];
            if ($model->save()) {
                Yii::app()->user->setFlash('green', 'Successfully Updated');
                $this->redirect(array('index'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $department = $this->loadModel($id);

        $depts = Yii::app()->db->createCommand(
                        "SELECT GetDeptTree(dept_id) as depts
            FROM app_departmets
            Where dept_id = '{$id}'")->queryRow();

        $depts = $depts['depts'] != '' ? explode(',', $depts['depts']) : array();
        $dept_count = count($depts);

        if ($dept_count > 0) {
            Yii::app()->user->setFlash('red', "This department have {$dept_count} child departments. Can't delete this department");
            $this->redirect(array("department/index"));
        } else {
            $user_count = UserProfile::model()->count("prof_department = :dept", array(':dept' => $id));
            $user_count += Users::model()->count("parent_dept_id = :dept", array(':dept' => $id));

            if ($user_count > 0) {
                Yii::app()->user->setFlash('red', "This department have {$user_count} Users. Can't delete this department");
                $this->redirect(array("department/index"));
            }
        }
        $department->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            Yii::app()->user->setFlash('green', 'Successfully Deleted');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $departments = Department::model()->findAll();

        $this->render('index', array(
            'departments' => $departments,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Department the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Department::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Department $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'Department-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAdduser($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Department'])) {
            $model->attributes = $_POST['Department'];
            if ($model->save()) {
                if ($model->dept_head_user_id != '') {
                    $user_model = Users::model()->findByPk($model->dept_head_user_id);
                    $user_model->parent_dept_id = $model->dept_parent_id;
                    $user_model->save();
                }
                Yii::app()->user->setFlash('green', 'Successfully Updated');
                $this->redirect(array('index'));
            }
        }

        $this->render('_adduser', array(
            'model' => $model,
            'id' => $id
        ));
    }
    
    public function actionGetchilds() {
        if(isset($_POST)){
            if($_POST['parent_id'] != ''){
                $dept_array = array();
                $depts = Yii::app()->db->createCommand(
                            "SELECT GetDeptTree(dept_id) as depts
                        FROM app_departmets
                        Where dept_id = '{$_POST['parent_id']}'")->queryRow();
                $depts = explode(",", $depts['depts']);
                array_push($depts, $_POST['parent_id']);
                foreach ($depts as $value) {
                    $dept_array[$value] = Department::model()->findByPk($value)->dept_name;
                }
            }else{
                $dept_array = CHtml::listData(Department::model()->isActive()->findAll(), 'dept_id', 'dept_name');
            }
            echo json_encode($dept_array);
        }
    }

}
