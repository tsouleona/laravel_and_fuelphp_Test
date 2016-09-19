<?php

namespace Model;

use \fuel\core\DB;

date_default_timezone_set('America/New_York');

class Ans
{
    /**
     * 新的一局(新增球數及期數)
     *
     * @param $count
     * @throws \FuelException
     */
    public static function insertGamePinball($count)
    {
        $ans_id = Ans::getNewAnsId();
        $date = date("Y-m-d H:i:s");
        DB::insert('ans')->columns(array(
            'ans_id',
            'ball_total',
            'create_time',
            'update_time'
        ))->values(array(
            $ans_id,
            $count,
            $date,
            $date
        ))->execute();
    }

    /**
     *搜尋最新局的期數與總球數
     *
     * @return mixed
     * 回傳期數與總球數
     */
    public static function selectNewPinball()
    {
        $id = DB::query('SELECT `ans_id` FROM `ans` ORDER BY `ans_id` DESC LIMIT 0,1')->execute()->as_array();
        if (count($id) != 0) {
            $result = DB::query('SELECT `ans_id`,`ball_total` FROM `ans` WHERE `ans_id` = ' . "'" . $id[0]['ans_id'] . "'")->execute()->as_array();
            return $result;
        }
        return false;
    }

    /**
     * 搜尋上一期的答案
     * @return mixed
     */
    public static function selectOnePinball()
    {
        $result = DB::query('SELECT * FROM `ans` ORDER BY `ans_id` DESC LIMIT 1,1')->execute()->as_array();
        return $result;
    }

    /**
     * 更新上一期賽果到答案資料表
     *
     * @param $ball_location 球的位置資料
     * @param $ans_id
     */
    public static function updateGamePinball($ball_location, $ans_id)
    {
        $count = count($ball_location);
        for ($i = 1; $i < 11; $i++) {
            $countmilk[$i] = 0;
            $countball[$i] = 0;
        }

        if (count($ball_location) == 11 || count($ball_location) == 14) {

            $countmilk[$ball_location[0]] = $countmilk[$ball_location[0]] + 1;
            $countmilk[$ball_location[1]] = $countmilk[$ball_location[1]] + 1;

            $milk = $ball_location[0] . '/' . $ball_location[1];

            for ($i = 2; $i < $count; $i++) {
                $countball[$ball_location[$i]] = $countball[$ball_location[$i]] + 1;
            }
        } else {

            $countmilk[$ball_location[0]] = $countmilk[$ball_location[0]] + 1;

            $milk = $ball_location[0];

            for ($i = 1; $i < $count; $i++) {
                $countball[$ball_location[$i]] = $countball[$ball_location[$i]] + 1;
            }
        }

        for ($i = 1; $i < 11; $i++) {
            $tmp[$i] = (int)$countball[$i] + (int)$countmilk[$i];
        }

        $continue_json = Ans::continue_ball($tmp);
        $json_array = json_encode($tmp);
        $date = date("Y-m-d H:i:s");
        DB::update('ans')->set(array(
            'milk_location' => $milk,
            'pinball_ans' => $json_array,
            'continue_ans' => $continue_json,
            'update_time' => $date,
        ))->where('ans_id', $ans_id)->execute();
    }

    public static function continue_ball($tmp)
    {
        if ($tmp[1] == 0 || $tmp[2] == 0 || $tmp[3] == 0 || $tmp[4] == 0) {

            $continue_tmp[1] = 0;
        }
        else
        {
            $continue_tmp[1] = 1;
        }
        if ($tmp[2] == 0 || $tmp[3] == 0 || $tmp[4] == 0 || $tmp[5] == 0) {

            $continue_tmp[2] = 0;
        }
        else
        {
            $continue_tmp[2] = 1;
        }
        if ($tmp[3] == 0 || $tmp[4] == 0 || $tmp[5] == 0 || $tmp[6] == 0) {

            $continue_tmp[3] = 0;
        }
        else
        {
            $continue_tmp[3] = 1;
        }
        if ($tmp[4] == 0 || $tmp[5] == 0 || $tmp[6] == 0 || $tmp[7] == 0) {

            $continue_tmp[4] = 0;
        }
        else
        {
            $continue_tmp[4] = 1;
        }
        if ($tmp[5] == 0 || $tmp[6] == 0 || $tmp[7] == 0 || $tmp[8] == 0) {

            $continue_tmp[5] = 0;
        }
        else
        {
            $continue_tmp[5] = 1;
        }
        if ($tmp[6] == 0 || $tmp[7] == 0 || $tmp[8] == 0 || $tmp[9] == 0) {

            $continue_tmp[6] = 0;
        }
        else
        {
            $continue_tmp[6] = 1;
        }
        if ($tmp[7] == 0 || $tmp[8] == 0 || $tmp[9] == 0 || $tmp[10] == 0) {

            $continue_tmp[7] = 0;
        }
        else
        {
            $continue_tmp[7] = 1;
        }

        $continue_json = json_encode($continue_tmp);
        return $continue_json;
    }

    /**
     * 搜尋最新的答案期數
     *
     * @return mixed
     * 回傳期數
     */
    public static function selectNewAnsId()
    {
        $result = DB::query('SELECT `ans_id` FROM `ans` ORDER BY `ans_id` DESC LIMIT 0,1')->execute()->as_array();
        return $result[0]['ans_id'];
    }

    /**
     * 計算新局的期數
     *
     * @return int|string
     * 回傳期數
     */
    public static function getNewAnsId()
    {
        $date = date("Ymd");
        $result = DB::query('SELECT `ans_id` FROM `ans` WHERE `ans_id` LIKE ' . "'" . '%' . $date . '%' . "'" . ' ORDER BY `ans_id` DESC')->execute();
        if ($result[0]['ans_id'] == null) {
            return $date . "001";
        }
        $id = (int)$result[0]['ans_id'];
        $final = $id + 1;
        return $final;
    }
}