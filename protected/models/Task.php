<?php

/**
 * This is the model class for table "task".
 *
 * The followings are the available columns in table 'task':
 * @property integer $objectId
 * @property integer $public
 * @property integer $executionId
 * @property integer $estateId
 *
 * The followings are the available model relations:
 * @property Estate $estate
 * @property Object $object
 * @property User $execution
 */
class Task extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Task the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('objectId, public', 'required'),
			array('objectId, public, executionId, estateId', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('objectId, public, executionId, estateId', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'estate' => array(self::BELONGS_TO, 'Estate', 'estateId'),
			'object' => array(self::BELONGS_TO, 'Object', 'objectId'),
			'execution' => array(self::BELONGS_TO, 'User', 'executionId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'objectId' => 'Object',
			'public' => 'Public',
			'executionId' => 'Execution',
			'estateId' => 'Estate',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('objectId',$this->objectId);
		$criteria->compare('public',$this->public);
		$criteria->compare('executionId',$this->executionId);
		$criteria->compare('estateId',$this->estateId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}