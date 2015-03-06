<?php

/**
 * This is the model class for table "{{user_profile}}".
 *
 * The followings are the available columns in table '{{user_profile}}':
 * @property string $prof_id
 * @property string $user_id
 * @property string $prof_firstname
 * @property string $prof_lastname
 * @property string $prof_position
 * @property string $prof_department
 * @property string $prof_personal_staff
 * @property string $prof_phone
 * @property string $prof_mobile
 * @property string $prof_fax
 * @property string $prof_office
 * @property string $prof_site
 * @property string $prof_sheet_position
 * @property string $prof_site_2
 * @property string $prof_phone_2
 * @property string $prof_structure_code
 * @property string $prof_department_2
 * @property string $prof_company
 * @property string $prof_hierarchy
 * @property string $prof_code_site
 * @property string $prof_sheet_structrure
 *
 * The followings are the available model relations:
 * @property Sites $profSite2
 * @property Companies $profCompany
 * @property Departmets $profDepartment
 * @property Departmets $profDepartment2
 * @property Positions $profPosition
 * @property Sites $profSite
 */
class UserProfile extends CActiveRecord {

    public $_doc_1;
    public $_doc_2;
    public $assitants;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{user_profile}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('prof_firstname, prof_position, prof_department, prof_mobile, prof_site, prof_company', 'required'),
            array('user_id, prof_position, prof_department, prof_personal_staff, prof_site, prof_site_2, prof_department_2, prof_company, prof_code_site', 'length', 'max' => 20),
            array('prof_firstname, prof_lastname, prof_phone_2, prof_hierarchy', 'length', 'max' => 100),
            array('prof_phone, prof_mobile, prof_fax, prof_office, prof_structure_code', 'length', 'max' => 50),
            array('prof_sheet_position, prof_sheet_structrure', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('prof_id, user_id, prof_firstname, prof_lastname, prof_position, prof_department, prof_personal_staff, prof_phone, prof_mobile, prof_fax, prof_office, prof_site, prof_sheet_position, prof_site_2, prof_phone_2, prof_structure_code, prof_department_2, prof_company, prof_hierarchy, prof_code_site, prof_sheet_structrure', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'profCodeSite' => array(self::BELONGS_TO, 'Site', 'prof_code_site'),
            'profSite2' => array(self::BELONGS_TO, 'Site', 'prof_site_2'),
            'profCompany' => array(self::BELONGS_TO, 'Company', 'prof_company'),
            'profDepartment' => array(self::BELONGS_TO, 'Department', 'prof_department'),
            'profDepartment2' => array(self::BELONGS_TO, 'Department', 'prof_department_2'),
            'profPosition' => array(self::BELONGS_TO, 'Position', 'prof_position'),
            'profSite' => array(self::BELONGS_TO, 'Site', 'prof_site'),
            'profPersonalStaff' => array(self::BELONGS_TO, 'Users', 'prof_personal_staff'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'prof_id' => 'Prof',
            'user_id' => 'User Profile',
            'prof_firstname' => 'Firstname',
            'prof_lastname' => 'Lastname',
            'prof_position' => 'Position',
            'prof_department' => 'Department',
            'prof_personal_staff' => 'Personal Staff',
            'prof_phone' => 'Phone',
            'prof_mobile' => 'Mobile',
            'prof_fax' => 'Fax',
            'prof_office' => 'Office',
            'prof_site' => 'Site',
            'prof_sheet_position' => 'Sheet Position',
            'prof_site_2' => 'Site 2',
            'prof_phone_2' => 'Phone 2',
            'prof_structure_code' => 'Structure Code',
            'prof_department_2' => 'Department 2',
            'prof_company' => 'Company',
            'prof_hierarchy' => 'Hierarchy',
            'prof_code_site' => 'Code Site',
            'prof_sheet_structrure' => 'Sheet Structrure',
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

        $criteria->compare('prof_id', $this->prof_id, true);
        $criteria->compare('user_id', $this->user_id, true);
        $criteria->compare('prof_firstname', $this->prof_firstname, true);
        $criteria->compare('prof_lastname', $this->prof_lastname, true);
        $criteria->compare('prof_position', $this->prof_position, true);
        $criteria->compare('prof_department', $this->prof_department, true);
        $criteria->compare('prof_personal_staff', $this->prof_personal_staff, true);
        $criteria->compare('prof_phone', $this->prof_phone, true);
        $criteria->compare('prof_mobile', $this->prof_mobile, true);
        $criteria->compare('prof_fax', $this->prof_fax, true);
        $criteria->compare('prof_office', $this->prof_office, true);
        $criteria->compare('prof_site', $this->prof_site, true);
        $criteria->compare('prof_sheet_position', $this->prof_sheet_position, true);
        $criteria->compare('prof_site_2', $this->prof_site_2, true);
        $criteria->compare('prof_phone_2', $this->prof_phone_2, true);
        $criteria->compare('prof_structure_code', $this->prof_structure_code, true);
        $criteria->compare('prof_department_2', $this->prof_department_2, true);
        $criteria->compare('prof_company', $this->prof_company, true);
        $criteria->compare('prof_hierarchy', $this->prof_hierarchy, true);
        $criteria->compare('prof_code_site', $this->prof_code_site, true);
        $criteria->compare('prof_sheet_structrure', $this->prof_sheet_structrure, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return UserProfile the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeValidate() {
        $this->_doc_1 = CUploadedFile::getInstance($this, 'prof_sheet_position');
        $this->_doc_2 = CUploadedFile::getInstance($this, 'prof_sheet_structrure');
        if (!is_null($this->_doc_1)) {
            $this->prof_sheet_position = rand(0, 9999) . "-{$this->_doc_1}";  // random number + file name
        }
        if (!is_null($this->_doc_2)) {
            $this->prof_sheet_structrure = rand(0, 9999) . "-{$this->_doc_2}";  // random number + file name
        }

        return parent::beforeValidate();
    }

    public function afterSave() {
        if (!is_null($this->_doc_1)) {
            $this->_doc_1->saveAs(USER_IMG_PATH . $this->prof_sheet_position);
        }
        if (!is_null($this->_doc_2)) {
            $this->_doc_2->saveAs(USER_IMG_PATH . $this->prof_sheet_structrure);
        }
        return parent::afterSave();
    }

    public static function getAssitants() {
        $criteria = new CDbCriteria;
        $criteria->select = array("GROUP_CONCAT(prof_personal_staff SEPARATOR ',') as assitants");
        $criteria->condition = "prof_personal_staff <> 0";

        $result = self::model()->find($criteria);
        if ($result)
            return $result->assitants;

        return false;
    }

}
