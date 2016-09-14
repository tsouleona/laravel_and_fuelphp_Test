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
        $record_id = Record::select_NewAnsId();
        $username = \Session::get('username');
        for ($i = 1; $i < 11; $i++) {
            if ($data["milk_money{$i}"] != '0') {
                $odds = Record::compute_Milk($i);
                DB::insert('record')->columns(array(
                    'record_id',
                    'username',
                    'play_type',
                    'input',
                    'bet_money',
                    'odds',
                    'create_time',
                    'update_time'
                ))->values(array(
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
        }
        for ($i = 1; $i < 11; $i++) {
            if ($data["odd_money{$i}"] != '0') {
                $odds = Record::compute_OddEven();
                DB::insert('record')->columns(array(
                    'record_id',
                    'username',
                    'play_type',
                    'input',
                    'bet_money',
                    'odds',
                    'create_time',
                    'update_time'
                ))->values(array(
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
        }
        for ($i = 1; $i < 11; $i++) {
            if ($data["even_money{$i}"] != '0') {
                $odds = Record::compute_OddEven();
                DB::insert('record')->columns(array(
                    'record_id',
                    'username',
                    'play_type',
                    'input',
                    'bet_money',
                    'odds',
                    'create_time',
                    'update_time'
                ))->values(array(
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
                $odds = Record::compute_ContinueBall($i);
                DB::insert('record')->columns(array(
                    'record_id',
                    'username',
                    'play_type',
                    'input',
                    'bet_money',
                    'odds',
                    'create_time',
                    'update_time'
                ))->values(array(
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
    public static function compute_Milk($ball_truck)
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
    public static function compute_OddEven()
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
    public static function compute_ContinueBall($continue_balls_truck)
    {

        $pro = Config::get("continue.{$continue_balls_truck}");

        $tmp = 1 / $pro * 0.92;
        $final = number_format($tmp, 2);
        return $final;
    }

    /**
     * 搜尋最新的期數
     *
     * @return mixed
     */
    public static function select_NewAnsId()
    {
        $result = DB::query('SELECT `ans_id` FROM `ans` ORDER BY `ans_id` DESC LIMIT 0,1')->execute();
        return $result[0]["MAX(`ans_id`)"];
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
        $id = Record::select_NewAnsId();
        $result = DB::query('SELECT * FROM `record` WHERE `record_id` = ' . "'" . $id . "'" . ' AND `username` = ' . "'" . $username . "'")->execute()->as_array();
        return $result;
    }

    /**
     * 尋找該帳號前37筆下注單
     *
     * @return mixed
     * 回傳37筆下注單
     */
    public static function selectOneRecord()
    {
        $date = date("Ymd");
        $username = \Session::get('username');
        $result = DB::query('SELECT * FROM `record` WHERE `record_id` LIKE ' . "'" . '%' . $date . '%' . "'" . ' AND `username` = ' . "'" . $username . "'" . ' ORDER BY `record_id` DESC LIMIT 0,37')->execute()->as_array();
        return $result;
    }
}