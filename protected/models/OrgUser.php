<?php

/**
 * This is the model class for table "org_user".
 *
 * The followings are the available columns in table 'org_user':
 * @property integer $id
 * @property integer $userId
 * @property integer $orgId
 * @property integer $access
 * @property integer $positionId
 * @property string $invitation
 * @property string $note
 *
 * The followings are the available model relations:
 * @property Position $position
 * @property Org $org
 * @property User $user
 */
class OrgUser extends CActiveRecord
{
    const AccessRated=0;
    const AccessAdmin=1;

    public static function  accesses(){
        return array(
            OrgUser::AccessRated=>"Номинальный",
            OrgUser::AccessAdmin=>"Администратор"
        );
    }
    public function  accessString()
    {
        $accesses =  OrgUser::accesses();
        return  $accesses[$this->access];
    }
    public function beforeValidate()
    {
        if(!parent::beforeValidate())return false;
        $this->invitation=uniqid(rand());
        if(!in_array($this->access,array(OrgUser::AccessRated,OrgUser::AccessAdmin)))
        {
            return false;
        }
        if($this->position!=null && $this->position->orgId!==$this->orgId){
            return false;
        }
        return false;
    }
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrgUser the static model class
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
		return 'org_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orgId, invitation', 'required'),
			array('userId, orgId, access, positionId', 'numerical', 'integerOnly'=>true),
			array('invitation, note', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userId, orgId, access, positionId, invitation, note', 'safe', 'on'=>'search'),
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
			'position' => array(self::BELONGS_TO, 'Position', 'positionId'),
			'org' => array(self::BELONGS_TO, 'Org', 'orgId'),
			'user' => array(self::BELONGS_TO, 'User', 'userId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'userId' => 'User',
			'orgId' => 'Org',
			'access' => 'Access',
			'positionId' => 'Position',
			'invitation' => 'Invitation',
			'note' => 'Note',
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
		$criteria->compare('userId',$this->userId);
		$criteria->compare('orgId',$this->orgId);
		$criteria->compare('access',$this->access);
		$criteria->compare('positionId',$this->positionId);
		$criteria->compare('invitation',$this->invitation,true);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}