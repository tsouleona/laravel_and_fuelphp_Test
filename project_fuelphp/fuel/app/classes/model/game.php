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
        public static function insert_gamePinball($array, $ans_id)
        {
            $count = count($array);
            for($i=1;$i<11;$i++)
            {
                $countmilk[$i] = 0;
                $countball[$i] = 0;
            }

            if (count($array) == 11 || count($array) == 14) {

                $countmilk[$array[0]] = $countmilk[$array[0]] + 1;
                $countmilk[$array[1]] = $countmilk[$array[1]] + 1;

                $milk = $array[0].'/'.$array[1];

                for ($i = 2; $i < $count; $i++) {
                    $countball[$array[$i]] = $countball[$array[$i]] + 1 ;
                }
            }
            else{

                $countmilk[$array[0]] = $countmilk[$array[0]] + 1;

                $milk = $array[0];

                for ($i = 1; $i < $count; $i++) {
                    $countball[$array[$i]] = $countball[$array[$i]] + 1 ;
                }
            }
            $date = date("Y-m-d H:i:s");
            DB::update('ans')->set(array(
                'milk_location' => $milk,
                '1' => $countball[1].'/'.$countmilk[1],
                '2' => $countball[2].'/'.$countmilk[2],
                '3' => $countball[3].'/'.$countmilk[3],
                '4' => $countball[4].'/'.$countmilk[4],
                '5' => $countball[5].'/'.$countmilk[5],
                '6' => $countball[6].'/'.$countmilk[6],
                '7' => $countball[7].'/'.$countmilk[7],
                '8' => $countball[8].'/'.$countmilk[8],
                '9' => $countball[9].'/'.$countmilk[9],
                '10' => $countball[10].'/'.$countmilk[10],
                'update_time' => $date,
            ))->where('ans_id', $ans_id)->execute();
        }

        public static function get_random($number)
        {
            $stack = [];
            for($i=1;$i<11;$i++)
            {
                $pro = Config::get("ball.{$i}");
                $stack = Game::while_ball($stack, $pro, $i);
            }

            shuffle($stack);
            $random = [];
            $random = array_rand($stack, $number);
            foreach ($random as $value) {
                $ans[] = $stack[$value];
            }
            $check_ans = [];
            $check_ans = array_count_values($ans);
            foreach ($check_ans as $key => $value) {
                if ($value >= 6) {
                    Game::get_random($number);
                }
            }
            return $ans;
        }

        public static function while_ball($stack, $count, $number)
        {
            $i = 0;
            while ($i < $count) {
                array_push($stack, $number);
                $i++;
            }
            return $stack;
        }
    }