<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander
 * Date: 18.03.13
 * Time: 3:10
 * To change this template use File | Settings | File Templates.
 */
class UserService
{
    public function  create(User $user,$authServer,$authId,$name, $sex)
    {
     $user->authService= $authServer;
     $user->authId=$authId;
     $user->name=$name;
     $user->sex=$sex;
     $user->dateOfCreate =  new CDbExpression('NOW()');
     $user->lastIp=$_SERVER['REMOTE_ADDR'];
     $user->rating=0;
     return $user->save(false);
    }

    public function update(User $user,array $data=null)
    {
       if($data==null)$data=$_REQUEST["User"];
       $user->attributes = CArray::extract($data,array("name","sex","email"));
       $this->dataOfUpdate = new CDbExpression('NOW()');
       $user->lastIp=$_SERVER['REMOTE_ADDR'];
       $user->save();
    }
    /* @return User */
    public function getByAuth($authService,$authId)
    {
        $criteria =new CDbCriteria();
        $criteria->compare("authService",$authService);
        $criteria->compare("authId",$authId);
        return User::model()->find($criteria);
    }


}
