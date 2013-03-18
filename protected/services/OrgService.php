<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander
 * Date: 18.03.13
 * Time: 4:15
 * To change this template use File | Settings | File Templates.
 */
class OrgService
{
     public function Create(Org $org)
     {
        $org->attributes = CArray::extract($_SERVER["Org"],array("name"));
        $org->save();
     }
     public function Update(Org $org)
     {
        $org->attributes = CArray::extract($_SERVER["Org"],array("name"));
        $org->save();
     }
}
