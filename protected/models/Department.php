<?php

/**
 * This is the model class for table "{{departmets}}".
 *
 * The followings are the available columns in table '{{departmets}}':
 * @property string $dept_id
 * @property string $dept_name
 * @property string $status
 *
 * The followings are the available model relations:
 * @property UserProfile[] $userProfiles
 * @property UserProfile[] $userProfiles1
 */
class Department extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{departmets}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('dept_name', 'required'),
            array('dept_name', 'length', 'max' => 150),
            array('dept_parent_id, dept_head_user_id', 'length', 'max' => 20),
            array('status', 'length', 'max' => 1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('dept_id, dept_parent_id, dept_name, status, dept_head_user_id, dept_head_user_id', 'safe', 'on' => 'search'),
        );
    }

    public function scopes() {
        $alias = $this->getTableAlias(false, false);
        return array(
            'isActive' => array('condition' => "$alias.status = '1'"),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'userProfiles' => array(self::HAS_MANY, 'UserProfile', 'prof_department'),
            'userProfiles1' => array(self::HAS_MANY, 'UserProfile', 'prof_department_2'),
            'children' => array(self::HAS_MANY, 'Department', 'dept_parent_id', 'order' => 'dept_name'),
            'childCount' => array(self::STAT, 'Department', 'dept_parent_id'),
            'deptHead' => array(self::BELONGS_TO, 'Users', 'dept_head_user_id'),
            'deptParent' => array(self::BELONGS_TO, 'Department', 'dept_parent_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'dept_id' => 'Dept',
            'dept_parent_id' => 'Parent Dept',
            'dept_head_user_id' => 'Dept Head',
            'dept_name' => 'Dept Name',
            'status' => 'Status',
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

        $criteria->compare('dept_id', $this->dept_id, true);
        $criteria->compare('dept_name', $this->dept_name, true);
        $criteria->compare('status', $this->status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Department the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
