<?php

    namespace Model;
    use \fuel\core\DB;
    date_default_timezone_set('America/New_York');

    class Game extends \Model
    {
        public static function time_out()
        {
            $m = date('i');
            $s = date('s');
            $time = (5 * 60) -(($m % 5) * 60 + $s) - 10;
            return $time;
        }
        public static function select_AllPinball()
        {
            $result = DB::query('SELECT `ans_id`,`ball_total` FROM `ans` WHERE `ans_id` = (SELECT MAX(`ans_id`) FROM `ans`)')->execute()->as_array();
            return $result;
        }
    }