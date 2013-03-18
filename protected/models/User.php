<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $name
 * @property integer $sex
 * @property string $avatar
 * @property string $email
 * @property string $dateOfCreate
 * @property string $dataOfUpdate
 * @property string $lastIp
 * @property string $rating
 * @property string $authService
 * @property string $authId
 *
 * The followings are the available model relations:
 * @property Complaint[] $complaints
 * @property Object[] $objects
 * @property OrgUser[] $orgUsers
 * @property Task[] $tasks
 * @property Tenant[] $tenants
 * @property Text[] $texts
 * @property Vote[] $votes
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, dateOfCreate, authService, authId', 'required'),
			array('sex', 'numerical', 'integerOnly'=>true),
			array('name, authId', 'length', 'max'=>200),
			array('avatar, email, lastIp', 'length', 'max'=>45),
			array('rating', 'length', 'max'=>5),
			array('authService', 'length', 'max'=>50),
			array('dataOfUpdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, sex, avatar, email, dateOfCreate, dataOfUpdate, lastIp, rating, authService, authId', 'safe', 'on'=>'search'),
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
			'complaints' => array(self::HAS_MANY, 'Complaint', 'userId'),
			'objects' => array(self::HAS_MANY, 'Object', 'autor'),
			'orgUsers' => array(self::HAS_MANY, 'OrgUser', 'userId'),
			'tasks' => array(self::HAS_MANY, 'Task', 'executionId'),
			'tenants' => array(self::HAS_MANY, 'Tenant', 'user_id'),
			'texts' => array(self::HAS_MANY, 'Text', 'autor'),
			'votes' => array(self::HAS_MANY, 'Vote', 'userId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'sex' => 'Sex',
			'avatar' => 'Avatar',
			'email' => 'Email',
			'dateOfCreate' => 'Date Of Create',
			'dataOfUpdate' => 'Data Of Update',
			'lastIp' => 'Last Ip',
			'rating' => 'Rating',
			'authService' => 'Auth Service',
			'authId' => 'Auth',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('dateOfCreate',$this->dateOfCreate,true);
		$criteria->compare('dataOfUpdate',$this->dataOfUpdate,true);
		$criteria->compare('lastIp',$this->lastIp,true);
		$criteria->compare('rating',$this->rating,true);
		$criteria->compare('authService',$this->authService,true);
		$criteria->compare('authId',$this->authId,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}



}