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
            return $result[0]['balance'];
        }
        return false;
    }
    public static function getBalance($username)
    {
        $balance = DB::query('SELECT `balance` FROM `user` WHERE `username` = '."'".$username."'")->execute()->as_array();
        return $balance[0]['balance'];
    }
}