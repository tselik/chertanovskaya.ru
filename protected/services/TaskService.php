<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander
 * Date: 18.03.13
 * Time: 4:21
 * To change this template use File | Settings | File Templates.
 */
class TaskService
{
    public function create(Object $object,Task $task,User $creator,Text $text)
    {

        $transaction = $object->dbConnection->beginTransaction();
        $object->attributes = CArray::extract($_REQUEST["Object"],array("name"));
        $object->creatorId=$creator->id;
        $object->typeId=1;
        $object->dateOfCreate=new CDbExpression('NOW()');
        if($object->save())
        {
            $task = new Task();
            $task->attributes = CArray::extract($_REQUEST["Task"],array("public","estateId"));
            $task->objectId= $object->id;
            $textService = new TextService();
            if($task->save() && $textService->create($text,$creatorId)){
                $transaction->commit();
                return true;
            }
        }
        $transaction->rollback();
        return false;
    }
    public function update(Object $object)
    {
        $transaction = $object->dbConnection->beginTransaction();
        $object->attributes = CArray::extract($_REQUEST["Object"],array("name"));
        $object->dateOfUpdate=new CDbExpression('NOW()');
        if($object->save())
        {
            $task = $object->task;
            $task->attributes = CArray::extract($_REQUEST["Task"],array());
            if($task->save()){
                $transaction->commit();
                return true;
            }
        }
        $transaction->rollback();
        return false;
    }
}
