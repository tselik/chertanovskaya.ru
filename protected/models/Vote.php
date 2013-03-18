<?php

/**
 * This is the model class for table "vote".
 *
 * The followings are the available columns in table 'vote':
 * @property integer $textId
 * @property integer $userId
 * @property string $session
 * @property string $ip
 * @property string $dateOfCreate
 *
 * The followings are the available model relations:
 * @property Text $text
 * @property User $user
 */
class Vote extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Vote the static model class
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
		return 'vote';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('textId, session, ip, dateOfCreate', 'required'),
			array('textId, userId', 'numerical', 'integerOnly'=>true),
			array('session', 'length', 'max'=>50),
			array('ip', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('textId, userId, session, ip, dateOfCreate', 'safe', 'on'=>'search'),
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
			'text' => array(self::BELONGS_TO, 'Text', 'textId'),
			'user' => array(self::BELONGS_TO, 'User', 'userId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'textId' => 'Text',
			'userId' => 'User',
			'session' => 'Session',
			'ip' => 'Ip',
			'dateOfCreate' => 'Date Of Create',
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

		$criteria->compare('textId',$this->textId);
		$criteria->compare('userId',$this->userId);
		$criteria->compare('session',$this->session,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('dateOfCreate',$this->dateOfCreate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}