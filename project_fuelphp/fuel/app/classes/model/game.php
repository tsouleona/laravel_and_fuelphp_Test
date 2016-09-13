<?php

    namespace Model;
    use \fuel\core\DB;
    use Fuel\Core\Config;
    date_default_timezone_set('America/New_York');

    class Game extends \Model
    {
        public static function timeOut()
        {
            $m = date('i');
            $s = date('s');
            $time = (5 * 60) -(($m % 5) * 60 + $s) - 10;
            return $time;
        }
        public static function selectAllPinball()
        {
            $result = DB::query('SELECT `ans_id`,`ball_total` FROM `ans` WHERE `ans_id` = (SELECT MAX(`ans_id`) FROM `ans`)')->execute()->as_array();
            return $result;
        }
        public  static function selectOnePinball($record_id)
        {
            $result = DB::query('SELECT * FROM `ans` WHERE `ans_id` = '."'".$record_id."'")->execute()->as_array();
            return $result;
        }

    }