<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander
 * Date: 13.03.13
 * Time: 21:57
 * To change this template use File | Settings | File Templates.
 */
class TestController  extends Controller
{
   public function actionIndex()
   {

       $session=new CHttpSession;
       $session->open();
       $session->clear();
       echo  $session->sessionID;
   }
   public function actionAvatar()
   {
      $avatar = new Avatar();
      if(isset($_POST["Avatar"]) && isset($_POST["newAvatar"]))
      {
        if($avatar->upload($_POST["Avatar"]["image"]))
        {

        }
      }
       print_r($avatar->errors);
      $this->render("avatar",array("avatar"=>$avatar));
   }
}
