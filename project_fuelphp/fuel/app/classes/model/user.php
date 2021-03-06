<?php
namespace Model;
use \fuel\core\DB;

class User extends \Model
{
    /**
     * 查詢是否有該使用者
     *
     * @param $data 帳號及密碼資料
     * @return bool
     * 有就回傳餘額，沒有就回傳false
     */
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

    /**
     * 取得該使用者的帳號
     *
     * @param $username 使用者帳號
     * @return mixed
     * 回傳餘額
     */
    public static function getBalance($username)
    {
        $balance = DB::query('SELECT `balance` FROM `user` WHERE `username` = '."'".$username."'")->execute()->as_array();
        return $balance[0]['balance'];
    }

    /**
     *更新所有使用者的餘額
     *
     * @param $all_user_record 最新的下注資料（所有使用者）
     */
    public static function updateUser($all_user_balance)
    {
        foreach($all_user_balance as $user_balance){
            DB::update('user')->set(array(
                'balance'=> $user_balance['balance'],
            ))->where('username',$user_balance['username'])->execute();
        }
    }
}