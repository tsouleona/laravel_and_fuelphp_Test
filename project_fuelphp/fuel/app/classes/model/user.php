<?php
namespace Model;
use \fuel\core\DB;

class User extends \Model
{
    public static function login($data)
    {

        $result = DB::query('SELECT * FROM `user` WHERE `username` = '."'".$data['username']."'".' AND `password` ='."'".$data['password']."'")->execute()->as_array();
        if($result != null)
        {
            \Session::set('username', $data['username']);
            \Session::set('balance', $result[0]['balance']);
            return true;
        }
        return false;
    }
}