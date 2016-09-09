<?php
    namespace Fuel\Tasks;
    use \fuel\core\DB;
    date_default_timezone_set('America/New_York');
    class Game
    {
        public function game()
        {
            $result = Game::get_Total();
            Game::insert_gamePinball($result);
            Game::select_AllPinball();
        }

        public static function get_Total()
        {
            $number = rand() % 8 + 1;
            $option = rand() % 3 + 1;
            switch ($option) {
                case 1:
                    $total = Game::three_Commball($number);
                    $result = Game::get_random($total);
                    return $result;
                    break;
                case 2:
                    $total = Game::one_Milkball($number);
                    $result = Game::get_random($total);
                    return $result;
                    break;
                case 3:
                    $total = Game::commball_Milkball($number);
                    $result = Game::get_random($total);
                    return $result;
                    break;
            }

        }
        public static function insert_gamePinball($array)
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

            $ans_id = Game::select_SpecPinball();
            $date = date("Y-m-d H:i:s");
            DB::insert('ans')->columns(array(
                'ans_id',
                'ball_total',
                'milk_location',
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8',
                '9',
                '10',
                'create_time'
            ))->values(array(
                $ans_id,
                $count,
                $milk,
                $countball[1].'/'.$countmilk[1],
                $countball[2].'/'.$countmilk[2],
                $countball[3].'/'.$countmilk[3],
                $countball[4].'/'.$countmilk[4],
                $countball[5].'/'.$countmilk[5],
                $countball[6].'/'.$countmilk[6],
                $countball[7].'/'.$countmilk[7],
                $countball[8].'/'.$countmilk[8],
                $countball[9].'/'.$countmilk[9],
                $countball[10].'/'.$countmilk[10],
                $date
            ))->execute();
        }
        public static function select_AllPinball()
        {
            $result = DB::query('SELECT * FROM `ans` WHERE `ans_id` = (SELECT MAX(`ans_id`) FROM `ans`)')->execute()->as_array();

            return $result;
        }
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

        public static function get_random($number)
        {
            $stack = [];
            $stack = Game::while_ball($stack, 2, 10);
            $stack = Game::while_ball($stack, 2, 1);
            $stack = Game::while_ball($stack, 10, 2);
            $stack = Game::while_ball($stack, 10, 9);
            $stack = Game::while_ball($stack, 20, 3);
            $stack = Game::while_ball($stack, 20, 8);
            $stack = Game::while_ball($stack, 80, 4);
            $stack = Game::while_ball($stack, 80, 5);
            $stack = Game::while_ball($stack, 80, 6);
            $stack = Game::while_ball($stack, 80, 7);

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