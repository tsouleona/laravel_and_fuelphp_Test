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
        }

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

        public static function insert_gamePinball($count)
        {
            $ans_id = Game::select_SpecPinball();
            $date = date("Y-m-d H:i:s");
            DB::insert('ans')->columns(array(
                'ans_id',
                'ball_total',
                'create_time'
            ))->values(array(
                $ans_id,
                $count,
                $date
            ))->execute();
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