<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander
 * Date: 18.03.13
 * Time: 2:09
 * To change this template use File | Settings | File Templates.
 */
class userTest extends CTestCase
{
    public function testApprove()
   {
       $s= User::model()->count();
       $this->assertEmpty($s,2);
   }
}
