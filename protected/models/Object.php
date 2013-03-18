<?php

/**
 * This is the model class for table "object".
 *
 * The followings are the available columns in table 'object':
 * @property integer $id
 * @property integer $typeId
 * @property integer $creatorId
 * @property string $name
 * @property string $dateOfCreate
 * @property string $dateOfUpdate
 *
 * The followings are the available model relations:
 * @property User $creator
 * @property Task $task
 * @property Text[] $texts
 */
class Object extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Object the static model class
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
		return 'object';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, typeId, creatorId, name, dateOfCreate', 'required'),
			array('id, typeId, creatorId', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>150),
			array('dateOfUpdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, typeId, creatorId, name, dateOfCreate, dateOfUpdate', 'safe', 'on'=>'search'),
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
			'creator' => array(self::BELONGS_TO, 'User', 'creatorId'),
			'task' => array(self::HAS_ONE, 'Task', 'objectId'),
			'texts' => array(self::HAS_MANY, 'Text', 'object_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'typeId' => 'Type',
			'creatorId' => 'Creator',
			'name' => 'Name',
			'dateOfCreate' => 'Date Of Create',
			'dateOfUpdate' => 'Date Of Update',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('typeId',$this->typeId);
		$criteria->compare('creatorId',$this->creatorId);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('dateOfCreate',$this->dateOfCreate,true);
		$criteria->compare('dateOfUpdate',$this->dateOfUpdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}