<?php
class HelpIdentification
{
    public $model;
    public function __construct(CActiveRecord $model,User $user)
    {
        $model->ip = $_SERVER["REMOTE_ADDR"];
        $session = new CHttpSession();
        if(!$session->isStarted)$session->open();
        $model->session=$session->sessionID;
        if($user!=null)
        {
            $model->userId= $user->id;
        }
        $this->model=  $model;
    }
    public function  valid()
    {
        return true;
    }

}
