<?php

namespace Model;

use \fuel\core\DB;

date_default_timezone_set('America/New_York');

class CompareMoney extends \Model
{
    public static function updateUser($money, $data)
    {
        $result = DB::query('SELECT `balance` FROM `user` WHERE `username` = ' . "'" . $data['username'] . "'")->execute()->as_array();
        $getMoney = (float)$result[0]['balance'] + (float)$money;
        $finalMoney = floor($getMoney);
        DB::update('user')->set(array(
            'balance' => $finalMoney
        ))->where('username', $data['username'])->execute();
    }

    public static function comcuteBlance($data)
    {
        $money = 0;
        for ($i = 0; $i < count($data); $i++) {
            $money = $money + (int)$data[$i]['get_money'];
        }
        return $money;
    }

    public static function selectRecordOldOne()
    {
        $id = $result = DB::query('SELECT MAX(`record_id`) FROM `record`')->execute()->as_array();
        $id2 = (int)$id[0]['MAX(`record_id`)'] - 1;
        $result = DB::query('SELECT * FROM `record` WHERE `record_id` = ' . "'" . $id2 . "'")->execute()->as_array();
        return $result;
    }
    public static function selectGetMoney($username,$record)
    {
        $result = DB::query('SELECT `get_money` FROM `record` WHERE `record_id` = '."'".$record."'".' AND `username` = '."'".$username."'")->execute()->as_array();
        return $result;
    }
    public static function selectRecordNew($username,$record)
    {
        $result = DB::query('SELECT * FROM `record` WHERE `record_id` = '."'".$record."'".' AND `username` = '."'".$username."'")->execute()->as_array();
        return $result;
    }
}
