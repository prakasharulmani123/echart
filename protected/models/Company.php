<?php

/**
 * This is the model class for table "{{companies}}".
 *
 * The followings are the available columns in table '{{companies}}':
 * @property string $company_id
 * @property string $company_name
 * @property string $company_address
 * @property string $status
 *
 * The followings are the available model relations:
 * @property UserProfile[] $userProfiles
 */
class Company extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{companies}}';
    }

    public function scopes() {
        $alias = $this->getTableAlias(false, false);
        return array(
            'isActive' => array('condition' => "$alias.status = '1'"),
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('company_name, status', 'required'),
            array('company_name', 'length', 'max' => 150),
            array('status', 'length', 'max' => 1),
            array('company_address', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('company_id, company_name, company_address, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'userProfiles' => array(self::HAS_MANY, 'UserProfile', 'prof_company'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'company_id' => 'Company',
            'company_name' => 'Company Name',
            'company_address' => 'Company Address',
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

        $criteria->compare('company_id', $this->company_id, true);
        $criteria->compare('company_name', $this->company_name, true);
        $criteria->compare('company_address', $this->company_address, true);
        $criteria->compare('status', $this->status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Company the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
