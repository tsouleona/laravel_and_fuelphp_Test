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
     * 跑出球的位置
     *
     * @param $ball_total 總球數
     * @return array
     * 回傳球的位置資料
     */
    public static function getRandom($ball_total)
    {
        $stack = [];
        for ($i = 1; $i < 11; $i++) {
            $pro = Config::get("ball.{$i}");
            $stack = Game::pushBall($stack, $pro, $i);
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
                Game::getRandom($ball_total);
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
    public static function pushBall($stack, $count, $number)
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
    public static function getTotal()
    {
        $number = rand() % 8 + 1;
        $option = rand() % 3 + 1;
        switch ($option) {
            case 1:
                $total = Game::threeCommBall($number);
                return $total;
                break;
            case 2:
                $total = Game::oneMilkBall($number);
                return $total;
                break;
            case 3:
                $total = Game::commBallAndMilkBall($number);
                return $total;
                break;
        }

    }

    /**
     * 加碼三顆普通球
     *
     * @param $number 隨機取的亂數
     * @return int
     * 回傳球數
     */
    public static function threeCommBall($number)
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
    public static function oneMilkBall($number)
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
    public static function commBallAndMilkBall($number)
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