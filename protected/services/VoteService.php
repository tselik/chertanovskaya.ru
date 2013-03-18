<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander
 * Date: 18.03.13
 * Time: 5:36
 * To change this template use File | Settings | File Templates.
 */
class VoteService
{
    public function create(Text $text,User $user)
    {
        $vote = new Vote();
        $vote->ip = $_SERVER["REMOTE_ADDR"];

        $session = new CHttpSession();
        if(!$session->isStarted)$session->open();
        $vote->session=$session->sessionID;
        if($user!=null)
        {
            $vote->userId= $user->id;
        }
        $user->save();
    }
}
