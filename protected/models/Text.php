<?php

/**
 * This is the model class for table "text".
 *
 * The followings are the available columns in table 'text':
 * @property integer $id
 * @property integer $object_id
 * @property integer $creatorId
 * @property string $value
 * @property string $dateOfCreate
 * @property string $dateOfUpdate
 * @property integer $vote_count
 * @property string $rating
 *
 * The followings are the available model relations:
 * @property Complaint[] $complaints
 * @property User $creator
 * @property Object $object
 * @property Vote[] $votes
 */
class Text extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Text the static model class
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
		return 'text';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('object_id, creatorId, dateOfCreate', 'required'),
			array('object_id, creatorId, vote_count', 'numerical', 'integerOnly'=>true),
			array('rating', 'length', 'max'=>5),
			array('value, dateOfUpdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, object_id, creatorId, value, dateOfCreate, dateOfUpdate, vote_count, rating', 'safe', 'on'=>'search'),
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
			'complaints' => array(self::HAS_MANY, 'Complaint', 'textId'),
			'creator' => array(self::BELONGS_TO, 'User', 'creatorId'),
			'object' => array(self::BELONGS_TO, 'Object', 'object_id'),
			'votes' => array(self::HAS_MANY, 'Vote', 'text_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'object_id' => 'Object',
			'creatorId' => 'Creator',
			'value' => 'Value',
			'dateOfCreate' => 'Date Of Create',
			'dateOfUpdate' => 'Date Of Update',
			'vote_count' => 'Vote Count',
			'rating' => 'Rating',
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
		$criteria->compare('object_id',$this->object_id);
		$criteria->compare('creatorId',$this->creatorId);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('dateOfCreate',$this->dateOfCreate,true);
		$criteria->compare('dateOfUpdate',$this->dateOfUpdate,true);
		$criteria->compare('vote_count',$this->vote_count);
		$criteria->compare('rating',$this->rating,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}