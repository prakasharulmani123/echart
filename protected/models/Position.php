<?php

/**
 * This is the model class for table "{{positions}}".
 *
 * The followings are the available columns in table '{{positions}}':
 * @property string $position_id
 * @property string $position_name
 * @property string $position_status
 *
 * The followings are the available model relations:
 * @property UserProfile[] $userProfiles
 */
class Position extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{positions}}';
    }

    public function scopes() {
        $alias = $this->getTableAlias(false, false);
        return array(
            'isActive' => array('condition' => "$alias.position_status = '1'"),
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('position_name', 'required'),
            array('position_name', 'length', 'max' => 150),
            array('position_status', 'length', 'max' => 1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('position_id, position_name, position_status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'userProfiles' => array(self::HAS_MANY, 'UserProfile', 'prof_position'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'position_id' => 'Position',
            'position_name' => 'Postion Name',
            'position_status' => 'Status',
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

        $criteria->compare('position_id', $this->position_id, true);
        $criteria->compare('position_name', $this->position_name, true);
        $criteria->compare('position_status', $this->position_status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Position the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function managersList() {
        return array('1', '3', '4');
    }

}
