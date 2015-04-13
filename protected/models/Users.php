<?php

/**
 * This is the model class for table "journal_users".
 *
 * The followings are the available columns in table 'journal_users':
 * @property string $user_id
 * @property string $user_email
 * @property string $user_password
 * @property string $user_status
 * @property string $user_activation_key
 * @property string $user_last_login
 * @property string $user_login_ip
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Diary[] $diaries
 * @property MoodReport[] $moodReports
 * @property TmpDiary[] $tmpDiaries
 */
class Users extends CActiveRecord {

    public $currentpassword;
    public $new_password;
    public $confirm_password;
    public $_photo;
    public $print;
    
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{users}}';
    }

    public function scopes() {
        $alias = $this->getTableAlias(false, false);
        return array(
            'isActive' => array('condition' => "$alias.user_status = '1'"),
            'isParent' => array('condition' => "$alias.parent_id = '0'"),
            'isNotAssistnant' => array('condition' => "$alias.is_personal_staff <> '1'"),
            'isAssistnant' => array('condition' => "$alias.is_personal_staff = '1'"),
            'notSelf' => array('condition' => "$alias.user_id = '" . Yii::app()->user->id . "'"),
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_name, user_email, user_status', 'required'),
            array('user_prof_image', 'required', 'on' => 'create'),
            array('user_email, user_password, user_activation_key, user_login_ip', 'length', 'max' => 250),
            array('user_name, user_email', 'required', 'on' => 'update'),
            array('user_email', 'unique', 'message' => "user email already exists"),
            array('user_name', 'unique', 'message' => "user name already exists"),
            array(
                'user_name',
                'match', 'pattern' => '/^[\-_a-z0-9]{6,14}$/',
                'message' => 'Username should be lowercase characters, numbers(0-9), underscore(_) and hyphen(-). Minimum 6 characters and Maximum 14 characters allowed',
            ),
            array('user_email', 'email'),
            array('user_status, is_personal_staff', 'length', 'max' => 1),
            array('user_last_login, created, modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_id, parent_dept_id, user_email, user_password, user_status, user_activation_key, user_last_login, user_login_ip, created, modified, reset_password_string', 'safe'),
        );
    }

    public function equalPasswords($attribute, $params) {
        if ($this->$attribute) {
            $user = Users::model()->findByPk(Yii::app()->user->id);
            if ($this->$attribute != "" && $user->user_password != Myclass::encrypt($this->$attribute)) {
                $this->addError($attribute, 'Current password is incorrect.');
            }
        }
    }

//    public function forgot($attribute, $params) {
//        if (!$this->hasErrors()) {
//            echo '<pre>';
//            print_r($this->user_email);
//            exit;
//
//            $this->_identity = new UserIdentity($this->username, $this->password);
//            if (!$this->_identity->authenticate())
//                $this->addError('password', 'Incorrect username or password.');
//        }
//    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'userProfile' => array(self::HAS_ONE, 'UserProfile', 'user_id'),
            'parent' => array(self::BELONGS_TO, 'Users', 'parent_id'),
            'parentDept' => array(self::BELONGS_TO, 'Department', 'parent_dept_id'),
            'children' => array(self::HAS_MANY, 'Users', 'parent_id', 'order' => 'user_name', 'condition' => "is_personal_staff <> '1'"),
            'childCount' => array(self::STAT, 'Users', 'parent_id'),
        );
    }

//    public function behaviors() {
//        return array(
//            'TreeBehavior' => array(
//                'class' => 'ext.behaviors.XTreeBehavior',
//                'treeLabelMethod' => 'getTreeLabel',
//                'treeLabelMethod2' => 'getTreeLabel2',
////                'menuUrlMethod' => 'getMenuUrl',
//            ),
//        );
//    }

    public function getTreeLabel2() {
        return CHtml::link($this->userProfile->profDepartment->dept_name, Yii::app()->createAbsoluteUrl('site/default/index?userid='.$this->user_id));
    }
    
    //organize chart label
    public function getTreeLabel() {
        $label = '';
        $label .= '<span id="orgainzeImage'.$this->user_id.'">';
        if (!isset($_GET['organization'])) {
            $label .= '<em>' . $this->userProfile->prof_firstname . '</em><br>';
        }
        $label .= '<a class="dialog_button" data-dialog="prof_' . $this->user_id . '" href="javascript:popup(' . $this->user_id . ')">
    <img class="orgainzeImage" src="' . Yii::app()->createAbsoluteUrl('uploads/user/' . $this->user_prof_image) . '" title="' . $this->user_name . '" />
    </a>';
        
        $label .= '</span>';
        
        $label .= '<div class="orgDept"><p>' . $this->userProfile->profDepartment->dept_name . '</p></div>';
        
        //get child count
        $childs = Yii::app()->db->createCommand(
                        'SELECT GetFamilyTree(user_id) as childs
                FROM app_users
                Where user_id = "' . $this->user_id . '"')->queryRow();
        
        $staff_count = '';
        if($childs['childs'] != ''){
            $child_exp = explode(',', $childs['childs']);
            $staff_count = count($child_exp);
        }
        //end
        
        if (isset($_GET['staff']) && $_GET['staff'] == true) {
            $label .= '<div class="orgStaff"><p>' . $staff_count . '</p></div>';
        }
        
        $ext_link = '';
        if(isset($_GET['staff'])){
            $ext_link .= '&staff=true';
        }elseif(isset($_GET['organization'])){
            $ext_link .= '&organization=true';
        }elseif(isset($_GET['manager'])){
            $ext_link .= '&manager=true';
        }
        
        $move_img = ($staff_count != '' && $this->parent_id != '0') ? CHtml::link(
                CHtml::image(Yii::app()->createAbsoluteUrl('themes/site/images/interface/navidown.gif')),
                Yii::app()->createAbsoluteUrl('site/default/index?userid='.$this->user_id.$ext_link), array('title' => 'Up in hierarchy')) : '';
        
        if (isset($_GET['userid']) && $_GET['userid'] != '') {
            if($_GET['userid'] == $this->user_id && $this->parent_id != '0'){
                $move_img = CHtml::link(
                        CHtml::image(Yii::app()->createAbsoluteUrl('themes/site/images/interface/naviup.gif')),
                        Yii::app()->createAbsoluteUrl('site/default/index?userid='.$this->parent_id.$ext_link), array('title' => 'Down in hierarchy'));
            }
        }
        
        if(!isset($_GET['staff'])){
            $this->userProfile->prof_phone != '' ? $label .= '<div class="orgPhone"><p>' . $this->userProfile->prof_phone . '</p></div>' : '';
            $this->user_email != '' ? $label .= '<div class="orgEmail"><p>' . $this->user_email.'</p></div>' : '';
            $label .= '<div class="hire_img">'.$move_img. '</div>';
        }
//        if (isset($_GET['phone']) && $_GET['phone'] == true) {
//            $label .= '<p class="orgDept">' . $this->userProfile->prof_phone . '</p>';
//        }

        return $label;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'user_id' => 'User Mdl',
            'parent_id' => 'Parent User',
            'parent_dept_id' => 'Parent Dept',
            'user_name' => 'User Name',
            'user_email' => 'Email',
            'user_password' => 'User Password',
            'user_prof_image' => 'Profile Image',
            'user_status' => 'User Status',
            'user_activation_key' => 'User Activation Key',
            'user_last_login' => 'User Last Login',
            'user_login_ip' => 'User Login Ip',
            'created' => 'Created',
            'modified' => 'Modified',
            'confirm_password' => 'Confirm Password',
            'new_password' => 'New Password',
            'reset_password_string' => 'Password Reset String',
            'is_personal_staff' => 'User Type',
            'print' => 'Generate with format'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('user_id', $this->user_id, true);
        $criteria->compare('user_email', $this->user_email, true);
        $criteria->compare('user_password', $this->user_password, true);
        $criteria->compare('user_status', $this->user_status, true);
        $criteria->compare('user_activation_key', $this->user_activation_key, true);
        $criteria->compare('user_last_login', $this->user_last_login, true);
        $criteria->compare('user_login_ip', $this->user_login_ip, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {
        if ($this->isNewRecord):
            $this->created = date('Y-m-d H:i:s');
            $this->modified = date('Y-m-d H:i:s');
            $this->user_login_ip = Yii::app()->request->getUserHostAddress();
            $this->user_activation_key = Myclass::getRandomString();
            $password = Myclass::getRandomString(8);
            $this->user_password = Myclass::encrypt($password);
        endif;

        return parent::beforeSave();
    }

    public function beforeValidate() {
        $this->_photo = CUploadedFile::getInstance($this, 'user_prof_image');
        if (!is_null($this->_photo)) {
            $this->user_prof_image = rand(0, 9999) . "-{$this->_photo}";  // random number + file name
        }

        return parent::beforeValidate();
    }

    public function afterSave() {
        if (!is_null($this->_photo)) {
            $this->_photo->saveAs(USER_IMG_PATH . $this->user_prof_image);
        }
        return parent::afterSave();
    }

}
