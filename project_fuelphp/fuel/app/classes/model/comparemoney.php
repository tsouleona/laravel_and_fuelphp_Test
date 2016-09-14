<?php

namespace Model;

use \fuel\core\DB;

date_default_timezone_set('America/New_York');

class CompareMoney extends \Model
{
    /**
     *更新所有使用者的餘額
     *
     * @param $all_user_record 最新的下注資料（所有使用者）
     */
    public static function updateUser($all_user_record)
    {
        $x = count($all_user_record);
        for ($i = 0; $i < $x; $i++) {
            $money = 0;
            $balance = DB::query('SELECT `balance` FROM `user` WHERE `username` = ' . "'" . $all_user_record[$i]['username'] . "'")->execute()->as_array();
            $money = (int)$balance[0]['balance'] + (int)$all_user_record[$i]['get_money'] . "\n";
            DB::update('user')->set(array(
                'balance' => $money
            ))->where('username', $all_user_record[$i]['username'])->execute();
        }
    }

    /**
     * 搜尋所有最新下注紀錄（所有使用者）
     *
     * @param $record  最新期數
     * @return mixed
     * 回傳所有最新下注清單
     */
    public static function selectNewRecord($record)
    {
        $result = DB::query('SELECT * FROM `record` WHERE `record_id` = ' . "'" . $record . "'")->execute()->as_array();
        return $result;
    }

    /**
     * 計算金額（所有最新下注）
     *
     * @param $data 最新的下注資料
     */
    public static function computeMoney($data)
    {
        $count_row = count($data);
        $result = DB::query('SELECT * FROM `ans` WHERE `ans_id` = ' . "'" . $data[0]['record_id'] . "'")->execute()->as_array();

        for ($m = 1; $m < 11; $m++) {
            $ball[$m] = explode('/', $result[0]["{$m}"]);
            $total[$m] = (int)$ball[$m][0] + (int)$ball[$m][1] . " ";
        }

        if ($result[0]['ball_total'] == 11 || $result[0]['ball_total'] == 14) {
            $milk = explode('/', $result[0]['milk_location']);
        } else {
            $milk[0] = $result[0]['milk_location'];
        }


        for ($f = 0; $f < $count_row; $f++) {

            if ($data[$f]['play_type'] == 'continue_ball') {

                $op = CompareMoney::continueBall($data[$f]['input'], $total);
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

    /**
     * 比對奇數答案是否正確
     *
     * @param $input 球道
     * @param $ball_total  所有球道總球數
     * @return bool
     * 對的話回傳true,錯的話回傳false
     */
    public static function odd($input, $ball_total)
    {
        if ($ball_total[$input] == 1 || $ball_total[$input] == 3 || $ball_total[$input] == 5) {
            return true;
        }
        return false;
    }

    /**
     * 比對偶數答案是否正確
     *
     * @param $input 球道
     * @param $ball_total  所有球道總球數
     * @return bool
     * 對的話回傳true,錯的話回傳false
     */
    public static function even($input, $ball_total)
    {
        if ($ball_total[$input] == 2 || $ball_total[$input] == 4 || $ball_total[$input] == 6) {

            return true;
        }

        return false;
    }

    /**
     * 比對牛奶球是否正確
     *
     * @param $input 球道
     * @param $ball_total 所有球道總球數
     * @param $milk 牛奶球位置
     * @return bool
     * 對的話回傳true,錯的話回傳false
     */
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

    /**
     * 比對連續球是否正確
     *
     * @param $input 哪種連續球
     * @param $ball_total 所有球道球數
     * @return bool
     */
    public static function continueBall($input, $ball_total)
    {
        switch ($input) {
            case 1:
                if ($ball_total[1] == 0 || $ball_total[2] == 0 || $ball_total[3] == 0 || $ball_total[4] == 0) {

                    return false;
                }

                return true;
                break;
            case 2:
                if ($ball_total[2] == 0 || $ball_total[3] == 0 || $ball_total[4] == 0 || $ball_total[5] == 0) {

                    return false;
                }

                return true;
                break;
            case 3:
                if ($ball_total[3] == 0 || $ball_total[4] == 0 || $ball_total[5] == 0 || $ball_total[6] == 0) {

                    return false;
                }

                return true;
                break;
            case 4:
                if ($ball_total[4] == 0 || $ball_total[5] == 0 || $ball_total[6] == 0 || $ball_total[7] == 0) {

                    return false;
                }

                return true;
                break;
            case 5:
                if ($ball_total[5] == 0 || $ball_total[6] == 0 || $ball_total[7] == 0 || $ball_total[8] == 0) {

                    return false;
                }

                return true;
                break;
            case 6:
                if ($ball_total[6] == 0 || $ball_total[7] == 0 || $ball_total[8] == 0 || $ball_total[9] == 0) {

                    return false;
                }

                return true;
                break;
            case 7:
                if ($ball_total[7] == 0 || $ball_total[8] == 0 || $ball_total[9] == 0 || $ball_total[10] == 0) {

                    return false;
                }

                return true;
                break;
        }
    }
}
