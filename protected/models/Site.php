<?php

/**
 * This is the model class for table "{{sites}}".
 *
 * The followings are the available columns in table '{{sites}}':
 * @property string $site_id
 * @property string $site_name
 * @property string $reception_mail
 * @property string $reception_phone
 * @property string $parking_phone
 * @property string $tel_security
 * @property string $address
 * @property string $restaurant
 * @property string $information
 * @property string $status
 *
 * The followings are the available model relations:
 * @property UserProfile[] $userProfiles
 * @property UserProfile[] $userProfiles1
 */
class Site extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{sites}}';
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
            array('site_name, reception_mail, reception_phone', 'required'),
            array('reception_mail', 'email'),
            array('site_name', 'length', 'max' => 150),
            array('reception_mail', 'length', 'max' => 100),
            array('reception_phone, parking_phone, tel_security', 'length', 'max' => 50),
            array('status', 'length', 'max' => 1),
            array('address, restaurant, information', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('site_id, site_name, reception_mail, reception_phone, parking_phone, tel_security, address, restaurant, information, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'userProfiles' => array(self::HAS_MANY, 'UserProfile', 'prof_site_2'),
            'userProfiles1' => array(self::HAS_MANY, 'UserProfile', 'prof_site'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'site_id' => 'Site',
            'site_name' => 'Site Name',
            'reception_mail' => 'Reception Mail',
            'reception_phone' => 'Reception Phone',
            'parking_phone' => 'Parking Phone',
            'tel_security' => 'Tel Security',
            'address' => 'Address',
            'restaurant' => 'Restaurant',
            'information' => 'Information',
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

        $criteria->compare('site_id', $this->site_id, true);
        $criteria->compare('site_name', $this->site_name, true);
        $criteria->compare('reception_mail', $this->reception_mail, true);
        $criteria->compare('reception_phone', $this->reception_phone, true);
        $criteria->compare('parking_phone', $this->parking_phone, true);
        $criteria->compare('tel_security', $this->tel_security, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('restaurant', $this->restaurant, true);
        $criteria->compare('information', $this->information, true);
        $criteria->compare('status', $this->status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Site the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
