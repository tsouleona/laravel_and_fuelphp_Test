<?php
namespace Model;

class User extends \Model
{
    public static function login($data)
    {

        $query = DB::query('SELECT * FROM `user` WHERE `username` = '.$data['username'].'AND `password` ='.$data['password']);
        if($query != null)
        {
            Session::set('username', $data['username']);
            return true;
        }
        return false;
    }
}