<?php

namespace Model;

use \fuel\core\DB;

date_default_timezone_set('America/New_York');

class Ans
{
    /**
     *搜尋最新局的期數與總球數
     *
     * @return mixed
     * 回傳期數與總球數
     */
    public static function selectNewPinball()
    {
        $id = DB::query('SELECT `ans_id` FROM `ans` ORDER BY `ans_id` DESC LIMIT 0,1')->execute()->as_array();
        $result = DB::query('SELECT `ans_id`,`ball_total` FROM `ans` WHERE `ans_id` = ' . "'" . $id[0]['ans_id'] . "'")->execute()->as_array();
        return $result;
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
        $date = date("Y-m-d H:i:s");
        DB::update('ans')->set(array(
            'milk_location' => $milk,
            '1' => $countball[1] . '/' . $countmilk[1],
            '2' => $countball[2] . '/' . $countmilk[2],
            '3' => $countball[3] . '/' . $countmilk[3],
            '4' => $countball[4] . '/' . $countmilk[4],
            '5' => $countball[5] . '/' . $countmilk[5],
            '6' => $countball[6] . '/' . $countmilk[6],
            '7' => $countball[7] . '/' . $countmilk[7],
            '8' => $countball[8] . '/' . $countmilk[8],
            '9' => $countball[9] . '/' . $countmilk[9],
            '10' => $countball[10] . '/' . $countmilk[10],
            'update_time' => $date,
        ))->where('ans_id', $ans_id)->execute();
    }

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