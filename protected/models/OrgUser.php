<?php

/**
 * This is the model class for table "org_user".
 *
 * The followings are the available columns in table 'org_user':
 * @property integer $id
 * @property integer $userId
 * @property integer $orgId
 * @property integer $access
 * @property integer $position
 * @property string $invitation
 * @property string $note
 *
 * The followings are the available model relations:
 * @property Org $org
 * @property User $user
 */
class OrgUser extends CActiveRecord
{
    const AccessRated=0;
    const AccessAdmin=1;
    public static function  orgsByUserId($userId=null)
    {
        if($userId==null)$userId=YII::app()->user->id;
        if($userId==null)return array();
        $criteria = new CDbCriteria();
        $criteria->compare("userId",YII::app()->user->id);
        $orgs = array();
        foreach(OrgUser::model()->findAll($criteria) as $item)
        {
            $orgs[] = $item->org;
        }
        return   $orgs;
    }
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
        $this->invitation=md5(uniqid(rand(),true));
        if(!in_array($this->access,array(OrgUser::AccessRated,OrgUser::AccessAdmin)))
        {
            return false;
        }
        return parent::beforeValidate();
    }
    public function restartInvitation()
    {
        $this->invitation=md5(uniqid(rand(),true));
        $this->save();
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
            array('userId, orgId, access, position', 'numerical', 'integerOnly'=>true),
            array('invitation, note', 'length', 'max'=>50),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, userId, orgId, access, position, note', 'safe', 'on'=>'search'),
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
            'position' => 'Position',
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
        $criteria->compare('position',$this->position);
        $criteria->compare('invitation',$this->invitation,true);
        $criteria->compare('note',$this->note,true);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}