<?php

use \Model\User;

class Controller_index extends Controller
{
    public function action_index()
    {
        return View::forge('login');
    }
    public function login()
    {
       $op = User::login($_POST);
        if($op)
        {
            return View::forge('pinball');
        }
        return '查無此人';
    }

}