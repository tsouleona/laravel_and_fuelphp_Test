<?php

use \Model\User;
use \Model\Record;

class Controller_index extends Controller
{
    public function action_index()
    {
        return View::forge('login');
    }
    public function action_login()
    {
       $balance = User::login($_POST);
        if($balance != null)
        {
            $data['balance'] = $balance;
            return View::forge('pinball', $data);
        }
        return View::forge('login');
    }
    public function action_getBalance()
    {
        $balance = User::getBalance($_POST['username']);
        return $balance;
    }
    public function action_logout()
    {
        \Session::destroy('username');
        \Session::destroy('balance');
        return View::forge('login');
    }
}