<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander
 * Date: 18.03.13
 * Time: 4:51
 * To change this template use File | Settings | File Templates.
 */
class TextService
{
    public function create(Text $text,User $creator)
    {
       $text->dateOfCreate=new CDbExpression('NOW()');
       $text->creatorId= $creator->id;
       $text->attributes=attributes = CArray::extract($_REQUEST["Text"],array("value","objectId"));
       $text->save();
    }
    public function update(Text $text)
    {
        $text->dateOfUpdate=new CDbExpression('NOW()');
        $text->attributes=attributes = CArray::extract($_REQUEST["Text"],array("value"));
        $text->save();
    }
}
