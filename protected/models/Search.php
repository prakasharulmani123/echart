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
class Search extends CActiveRecord {

    public $surname;
    public $name;
    public $position;
    public $site;
    public $building;
    public $all_criteria;
    public $service;
    public $phonetical;
    public $fax;
    public $phone;
    public $mobile;
    public $office;
    public $department;
    public $company;

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
            'notSelf' => array('condition' => "$alias.user_id = '".Yii::app()->user->id."'"),
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
            array('user_email', 'email'),
            array('user_status, is_personal_staff', 'length', 'max' => 1),
            array('user_last_login, created, modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_id, user_email, user_password, user_status, user_activation_key, user_last_login, user_login_ip, created, modified, reset_password_string', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'userProfile' => array(self::HAS_ONE, 'UserProfile', 'user_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'user_id' => 'User Mdl',
            'parent_id' => 'Parent',
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
            
            'surname' => 'Sur Name',
            'name' => 'Name',
            'position' => 'Position',
            'site' => 'Site',
            'building' => 'Building',
            'fax' => 'Fax',
            'phone' => 'Phone',
            'office' => 'Office',
            'department' => 'Department',
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
    
    public function advanced_search() {
        // @todo Please modify the following code to remove attributes that should not be searched.
        $criteria = new CDbCriteria();
        $criteria->select = array('t.*');
        $criteria->with = array('userProfile');
        $criteria->compare('userProfile.prof_firstname', $this->name, true);
        $criteria->compare('userProfile.prof_lastname', $this->surname, true);
        $criteria->compare('userProfile.prof_position', $this->position, true);
        $criteria->compare('userProfile.prof_department', $this->department, true);
        $criteria->compare('userProfile.prof_phone', $this->phone, true);
        $criteria->compare('userProfile.prof_mobile', $this->mobile, true);
        $criteria->compare('userProfile.prof_fax', $this->fax, true);
        $criteria->compare('userProfile.prof_office', $this->office, true);
        $criteria->compare('userProfile.prof_site', $this->site, true);
        $criteria->compare('userProfile.prof_company', $this->company, true);
        
//        $search_conditon = "userProfile.prof_firstname = '" . $this->name . "'  "
//                . "OR userProfile.prof_lastname = '" . $this->surname . "'  ";
//        $criteria->addCondition($search_conditon);
        return self::model()->findAll($criteria);
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

//    public function beforeSave() {
//        if ($this->isNewRecord):
//            $this->created = date('Y-m-d H:i:s');
//            $this->modified = date('Y-m-d H:i:s');
//            $this->user_login_ip = Yii::app()->request->getUserHostAddress();
//            $this->user_activation_key = Myclass::getRandomString();
//            $password = Myclass::getRandomString(8);
//            $this->user_password = Myclass::encrypt($password);
//        endif;
//
//        return parent::beforeSave();
//    }

//    public function beforeValidate() {
//        $this->_photo = CUploadedFile::getInstance($this, 'user_prof_image');
//        if (!is_null($this->_photo)) {
//            $this->user_prof_image = rand(0, 9999) . "-{$this->_photo}";  // random number + file name
//        }
//
//        return parent::beforeValidate();
//    }
//
//    public function afterSave() {
//        if (!is_null($this->_photo)) {
//            $this->_photo->saveAs(USER_IMG_PATH . $this->user_prof_image);
//        }
//        return parent::afterSave();
//    }

}
