<?php

use \Model\User;

class Controller_index extends Controller
{
    public function action_index()
    {
        return View::forge('login');
    }
    public function action_login()
    {
       $op = User::login($_POST);
        if($op)
        {
            return View::forge('pinball');
        }
        return View::forge('login');
    }
    public function action_logout()
    {
        \Session::destroy('username');
        \Session::destroy('balance');
        return View::forge('login');
    }
}