<?php
namespace Model;

use Fuel\Core\Config;
use \fuel\core\DB;

date_default_timezone_set('America/New_York');

class Record extends \Model
{
    /**
     * 將下注資料寫入紀錄的表單內
     *
     * @param $data 使用者下注資料
     * @return bool 都輸入完回傳true
     * @throws \FuelException sql沒執行成功的錯誤訊息
     */
    public static function insertRecord($data)
    {
        $datetime = date("Y-m-d h:i:s");
        $record_id = Ans::selectNewAnsId();
        $username = \Session::get('username');

        $query = DB::insert('record')->columns(array(
            'record_id',
            'username',
            'play_type',
            'input',
            'bet_money',
            'odds',
            'create_time',
            'update_time'
        ));

        for ($i = 1; $i < 11; $i++) {
            if ($data["milk_money{$i}"] != '0') {
                $odds = Record::computeMilk($i);
                $query->values(array(
                    $record_id,
                    $username,
                    "milk",
                    $i,
                    $data["milk_money{$i}"],
                    $odds,
                    $datetime,
                    $datetime
                ))->execute();
            }
            if ($data["odd_money{$i}"] != '0') {
                $odds = Record::computeOddEven();
                $query->values(array(
                    $record_id,
                    $username,
                    "odd",
                    $i,
                    $data["odd_money{$i}"],
                    $odds,
                    $datetime,
                    $datetime
                ))->execute();
            }
            if ($data["even_money{$i}"] != '0') {
                $odds = Record::computeOddEven();
                $query->values(array(
                    $record_id,
                    $username,
                    "even",
                    $i,
                    $data["even_money{$i}"],
                    $odds,
                    $datetime,
                    $datetime
                ))->execute();
            }
        }
        for ($i = 1; $i < 8; $i++) {
            if ($data["continue_money{$i}"] != '0') {
                $odds = Record::computeContinueBall($i);
                $query->values(array(
                    $record_id,
                    $username,
                    "continue_ball",
                    $i,
                    $data["continue_money{$i}"],
                    $odds,
                    $datetime,
                    $datetime
                ))->execute();
            }
        }

        return true;
    }

    /**
     * 計算牛奶球的錢
     *
     * @param $ball_truck 球道
     * @return string
     * 回傳計算後的錢
     */
    public static function computeMilk($ball_truck)
    {
        $pro = Config::get("hole.{$ball_truck}");

        $tmp = 1 / $pro * 0.92;
        $final = number_format($tmp, 2);
        return $final;
    }

    /**
     * 計算單雙注的錢
     *
     * @return string
     * 回傳計算後的錢
     */
    public static function computeOddEven()
    {
        $tmp = 1 / 0.5 * 0.92;
        $final = number_format($tmp, 2);
        return $final;
    }

    /**
     * 計算連續球的錢
     *
     * @param $continue_balls_truck 連續球的球道
     * @return string
     * 回傳計算後的錢
     */
    public static function computeContinueBall($continue_balls_truck)
    {

        $pro = Config::get("continue.{$continue_balls_truck}");

        $tmp = 1 / $pro * 0.92;
        $final = number_format($tmp, 2);
        return $final;
    }

    /**
     *尋找該帳號最新的所有下注單
     *
     * @return mixed
     * 回傳最新清單
     */
    public static function selectAllRecord()
    {
        $username = \Session::get('username');
        $id = DB::query('SELECT `record_id` FROM `record` ORDER BY `record_id` DESC LIMIT 0,1')->execute()->as_array();
        if(count($id)!= 0)
        {
            $result = DB::query('SELECT * FROM `record` WHERE `record_id` = ' . "'" . $id[0]['record_id'] . "'" . ' AND `username` = ' . "'" . $username . "'")->execute()->as_array();
            return $result;
        }
    }

    /**
     * 尋找該帳號前37筆下注單
     *
     * @return mixed
     * 回傳37筆下注單
     */
    public static function selectOneRecord()
    {
        $username = \Session::get('username');
        $result = DB::query('SELECT * FROM `record` WHERE `username` = ' . "'" . $username . "'" . ' ORDER BY `record_id` DESC LIMIT 0,37')->execute()->as_array();
        return $result;
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
     * 計算所有下注資料
     *
     * @param $data 最新所有下注資料
     * @return array
     * 回傳每個使用者的餘額
     */
    public static function computeMoney($data)
    {
        $count_row = count($data);
        $result = DB::query('SELECT * FROM `ans` WHERE `ans_id` = ' . "'" . $data[0]['record_id'] . "'")->execute()->as_array();
        $users = DB::query('SELECT * FROM `user`')->execute()->as_array();
        $pinball = json_decode($result[0]['pinball_ans'], true);
        $continue = json_decode($result[0]['continue_ans'], true);
        if ($result[0]['ball_total'] == 11 || $result[0]['ball_total'] == 14) {
            $milk = explode('/', $result[0]['milk_location']);
        } else {
            $milk[0] = $result[0]['milk_location'];
        }

        for ($f = 0; $f < $count_row; $f++) {
            $date = date("Y-m-d H:i:s");
            if ($data[$f]['play_type'] == 'continue_ball') {
                if ($continue[$data[$f]['input']]) {
                    $getMoney = (float)$data[$f]['bet_money'] * (float)$data[$f]['odds'];
                    $finalMoney = floor($getMoney);
                    $status = 'win';
                } else {
                    $finalMoney = (-1) * (int)$data[$f]['bet_money'];
                    $status = 'lose';
                }
            }
            if ($data[$f]['play_type'] == 'milk') {
                $op2 = Record::milk($data[$f]['input'], $result[0]['ball_total'], $milk);
                if ($op2) {
                    $getMoney = (float)$data[$f]['bet_money'] * (float)$data[$f]['odds'];
                    $finalMoney = floor($getMoney);
                    $status = 'win';
                } else {
                    $finalMoney = (-1) * (int)$data[$f]['bet_money'];
                    $status = 'lose';
                }
            }
            if ($data[$f]['play_type'] == 'odd') {
                $op3 = Record::odd($data[$f]['input'], $pinball);

                if ($op3) {
                    $getMoney = (float)$data[$f]['bet_money'] * (float)$data[$f]['odds'];
                    $finalMoney = floor($getMoney);;
                    $status = 'win';
                } else {
                    $finalMoney = (-1) * (int)$data[$f]['bet_money'];
                    $status = 'lose';
                }
            }
            if ($data[$f]['play_type'] == 'even') {
                $op4 = Record::even($data[$f]['input'], $pinball);
                if ($op4) {
                    $getMoney = (float)$data[$f]['bet_money'] * (float)$data[$f]['odds'];
                    $finalMoney = floor($getMoney);;
                    $status = 'win';
                } else {
                    $finalMoney = (-1) * (int)$data[$f]['bet_money'];
                    $status = 'lose';
                }
            }
            $tmp_users = [];
            foreach($users as $user)
            {
                if($user['username'] == $data[$f]['username'])
                {
                    $user['balance'] = $user['balance'] + $finalMoney;
                }
                $tmp_users[] = $user;
            }
            Record::updategGetMoney($status, $finalMoney, $date, $data[$f]['record_id'], $data[$f]['id']);
        }
        return $tmp_users;
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
     * 更新到紀錄表的下注得到的錢
     *
     * @param $status 輸贏
     * @param $money  得到的錢
     * @param $date   更新時間
     * @param $record_id 期數
     * @param $id 注單id
     */
    public static function updategGetMoney($status, $money, $date, $record_id, $id)
    {
        DB::update('record')->set(array(
            'answer' => $status,
            'get_money' => $money,
            'update_time' => $date
        ))->where('record_id', $record_id)->and_where('id', $id)->execute();
    }
}