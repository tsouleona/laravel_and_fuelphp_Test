<?php

namespace Model;
use \fuel\core\DB;
date_default_timezone_set('America/New_York');

class CompareMoney extends \Model
{
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
    public static function updateUser($all_user_record)
    {
        $x = count($all_user_record);
        for($i=0;$i<$x;$i++)
        {
            $money = 0;
            $balance = DB::query('SELECT `balance` FROM `user` WHERE `username` = '."'".$all_user_record[$i]['username']."'")->execute()->as_array();
            $money = (int)$balance[0]['balance'] + (int)$all_user_record[$i]['get_money']."\n";
            DB::update('user')->set(array(
                'balance' => $money
            ))->where('username', $all_user_record[$i]['username'])->execute();
        }
    }
    public static function selectNewRecord($record)
    {
        $result = DB::query('SELECT * FROM `record` WHERE `record_id` = '."'".$record."'")->execute()->as_array();
        return $result;
    }
    public static function comcuteMoney($data)
    {
        $countrow = count($data);
        $result = DB::query('SELECT * FROM `ans` WHERE `ans_id` = ' . "'" . $data[0]['record_id'] . "'")->execute()->as_array();

        for ($m = 1; $m < 11; $m++) {
            $ball[$m] = explode('/', $result[0]["{$m}"]);
            $total[$m] = (int)$ball[$m][0] + (int)$ball[$m][1] . " ";
        }

        if ($result[0]['ball_total'] == 11 || $result[0]['ball_total'] == 14) {
            $milk = explode('/', $result[0]['milk_location']);
        }
        $milk[0] = $result[0]['milk_location'];

        for ($f = 0; $f < $countrow; $f++) {

            if ($data[$f]['play_type'] == 'continue_ball') {

                $op = CompareMoney::continue_ball($data[$f]['input'], $total);
                $date = date("Y-m-d H:i:s");
                if ($op) {
                    $getMoney = (float)$data[$f]['bet_money'] * (float)$data[$f]['odds'];
                    $finalMoney = floor($getMoney);
                    DB::update('record')->set(array(
                        'answer' => 'win',
                        'get_money' => $finalMoney,
                        'update_time' => $date
                    ))->where('record_id', $data[$f]['record_id'])->and_where('id', $data[$f]['id'])->execute();
                } else {
                    $finalMoney = -(int)$data[$f]['bet_money'];
                    DB::update('record')->set(array(
                        'answer' => 'lose',
                        'get_money' => $finalMoney,
                        'update_time' => $date
                    ))->where('record_id', $data[$f]['record_id'])->and_where('id', $data[$f]['id'])->execute();
                }

            }
            if ($data[$f]['play_type'] == 'milk') {
                $op2 = CompareMoney::milk($data[$f]['input'], $result[0]['ball_total'], $milk);
                $date2 = date("Y-m-d H:i:s");
                if ($op2) {
                    $getMoney = (float)$data[$f]['bet_money'] * (float)$data[$f]['odds'];
                    $finalMoney = floor($getMoney);;
                    DB::update('record')->set(array(
                        'answer' => 'win',
                        'get_money' => $finalMoney,
                        'update_time' => $date2
                    ))->where('record_id', $data[$f]['record_id'])->and_where('id', $data[$f]['id'])->execute();
                } else {
                    $finalMoney = -(int)$data[$f]['bet_money'];
                    DB::update('record')->set(array(
                        'answer' => 'lose',
                        'get_money' => $finalMoney,
                        'update_time' => $date2
                    ))->where('record_id', $data[$f]['record_id'])->and_where('id', $data[$f]['id'])->execute();
                }
            }
            if ($data[$f]['play_type'] == 'odd') {
                $op3 = CompareMoney::odd($data[$f]['input'], $total);
                $date3 = date("Y-m-d H:i:s");
                if ($op3) {
                    $getMoney = (float)$data[$f]['bet_money'] * (float)$data[$f]['odds'];
                    $finalMoney = floor($getMoney);;
                    DB::update('record')->set(array(
                        'answer' => 'win',
                        'get_money' => $finalMoney,
                        'update_time' => $date3
                    ))->where('record_id', $data[$f]['record_id'])->and_where('id', $data[$f]['id'])->execute();
                } else {
                    $finalMoney = -(int)$data[$f]['bet_money'];
                    DB::update('record')->set(array(
                        'answer' => 'lose',
                        'get_money' => $finalMoney,
                        'update_time' => $date3
                    ))->where('record_id', $data[$f]['record_id'])->and_where('id', $data[$f]['id'])->execute();
                }
            }
            if ($data[$f]['play_type'] == 'even') {
                $op4 = CompareMoney::even($data[$f]['input'], $total);
                $date4 = date("Y-m-d H:i:s");
                if ($op4) {
                    $getMoney = (float)$data[$f]['bet_money'] * (float)$data[$f]['odds'];
                    $finalMoney = floor($getMoney);;
                    DB::update('record')->set(array(
                        'answer' => 'win',
                        'get_money' => $finalMoney,
                        'update_time' => $date4
                    ))->where('record_id', $data[$f]['record_id'])->and_where('id', $data[$f]['id'])->execute();
                } else {
                    $finalMoney = -(int)$data[$f]['bet_money'];
                    DB::update('record')->set(array(
                        'answer' => 'lose',
                        'get_money' => $finalMoney,
                        'update_time' => $date4
                    ))->where('record_id', $data[$f]['record_id'])->and_where('id', $data[$f]['id'])->execute();
                }
            }
        }
    }

    public static function odd($input, $ball)
    {
        if ($ball[$input] == 1 || $ball[$input] == 3 || $ball[$input] == 5) {
            return true;
        }
        return false;
    }

    public static function even($input, $ball)
    {
        if ($ball[$input] == 2 || $ball[$input] == 4 || $ball[$input] == 6) {
            return true;
        }
        return false;
    }

    public static function milk($input, $ball_total, $milk)
    {
        if ($ball_total == 11 || $ball_total == 14) {
            if ($input == $milk[0] || $input == $milk[1]) {
                return true;
            }
        } else {
            if ($input == $milk[0]) {
                return true;
            }
        }


        return false;
    }

    public static function continue_ball($record, $ansBall)
    {
        switch ($record) {
            case 1:
                if ($ansBall[1] == 0 || $ansBall[2] == 0 || $ansBall[3] == 0 || $ansBall[4] == 0) {
                    return false;
                }
                return true;
                break;
            case 2:
                if ($ansBall[2] == 0 || $ansBall[3] == 0 || $ansBall[4] == 0 || $ansBall[5] == 0) {
                    return false;
                }
                return true;
                break;
            case 3:
                if ($ansBall[3] == 0 || $ansBall[4] == 0 || $ansBall[5] == 0 || $ansBall[6] == 0) {
                    return false;
                }
                return true;
                break;
            case 4:
                if ($ansBall[4] == 0 || $ansBall[5] == 0 || $ansBall[6] == 0 || $ansBall[7] == 0) {
                    return false;
                }
                return true;
                break;
            case 5:
                if ($ansBall[5] == 0 || $ansBall[6] == 0 || $ansBall[7] == 0 || $ansBall[8] == 0) {
                    return false;
                }
                return true;
                break;
            case 6:
                if ($ansBall[6] == 0 || $ansBall[7] == 0 || $ansBall[8] == 0 || $ansBall[9] == 0) {
                    return false;
                }
                return true;
                break;
            case 7:
                if ($ansBall[7] == 0 || $ansBall[8] == 0 || $ansBall[9] == 0 || $ansBall[10] == 0) {
                    return false;
                }
                return true;
                break;
        }
    }
}
