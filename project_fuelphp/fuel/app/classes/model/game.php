<?php

namespace Model;

use \fuel\core\DB;
use Fuel\Core\Config;

date_default_timezone_set('America/New_York');

class Game extends \Model
{
    /**
     * 計算離五分鐘還有多久
     *
     * @return int
     * 回傳秒數
     */
    public static function timeOut()
    {
        $m = date('i');
        $s = date('s');
        $time = (5 * 60) - (($m % 5) * 60 + $s) - 10;
        return $time;
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
        $result = DB::query('SELECT `ans_id`, `ball_total` FROM `ans` WHERE `ans_id` = ' . "'" . $id . "'")->execute()->as_array();
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
    public static function update_gamePinball($ball_location, $ans_id)
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

    /**
     * 跑出球的位置
     *
     * @param $ball_total 總球數
     * @return array
     * 回傳球的位置資料
     */
    public static function get_random($ball_total)
    {
        $stack = [];
        for ($i = 1; $i < 11; $i++) {
            $pro = Config::get("ball.{$i}");
            $stack = Game::push_ball($stack, $pro, $i);
        }
        shuffle($stack);
        $random = [];
        $random = array_rand($stack, $ball_total);
        foreach ($random as $value) {
            $ans[] = $stack[$value];
        }
        $check_ans = [];
        $check_ans = array_count_values($ans);
        foreach ($check_ans as $key => $value) {
            if ($value > 6) {
                Game::get_random($ball_total);
            }
        }
        return $ans;
    }

    /**
     * 把球推進陣列
     *
     * @param $stack 暫存陣列
     * @param $count 要推幾次
     * @param $number 第幾球道
     * @return mixed
     * 回傳推完的陣列
     */
    public static function push_ball($stack, $count, $number)
    {
        $i = 0;
        while ($i < $count) {
            array_push($stack, $number);
            $i++;
        }
        return $stack;
    }

    /**
     * 取得總球數
     *
     * @return int
     * 回傳球數
     */
    public static function get_Total()
    {
        $number = rand() % 8 + 1;
        $option = rand() % 3 + 1;
        switch ($option) {
            case 1:
                $total = Game::three_Commball($number);
                return $total;
                break;
            case 2:
                $total = Game::one_Milkball($number);
                return $total;
                break;
            case 3:
                $total = Game::commball_Milkball($number);
                return $total;
                break;
        }

    }

    /**
     * 新的一局(新增球數及期數)
     *
     * @param $count
     * @throws \FuelException
     */
    public static function insert_gamePinball($count)
    {
        $ans_id = Game::select_SpecPinball();
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
     * 計算新局的期數
     *
     * @return int|string
     * 回傳期數
     */
    public static function select_SpecPinball()
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

    /**
     * 加碼三顆普通球
     *
     * @param $number 隨機取的亂數
     * @return int
     * 回傳球數
     */
    public static function three_Commball($number)
    {
        $ans = rand() % 2 + 1;
        if ($number == $ans) {
            $total = 13;
            return $total;
        }
        $total = 10;
        return $total;
    }

    /**
     * 加碼一顆牛奶球
     *
     * @param $number 隨機取的亂數
     * @return int
     * 回傳球數
     */
    public static function one_Milkball($number)
    {
        $ans = rand() % 4 + 1;
        if ($number == $ans) {
            $total = 11;
            return $total;
        }
        $total = 10;
        return $total;
    }

    /**
     * 加碼三顆普通球一顆牛奶球
     *
     * @param $number 隨機取的亂數
     * @return int
     * 回傳球數
     */
    public static function commball_Milkball($number)
    {
        $ans = rand() % 8 + 1;
        if ($number == $ans) {
            $total = 14;
            return $total;
        }
        $total = 10;
        return $total;
    }
}