<?php
    namespace Fuel\Tasks;
    use\fuel\core\Config;
    use \fuel\core\DB;
    date_default_timezone_set('America/New_York');
    class Game
    {
        public function game()
        {
            //------------------------輸出賽果----------------------------//
            $new_ans = Game::selectAllPinball();
            if(count($new_ans) != 0)
            {
                $result = Game::get_random($new_ans[0]['ball_total']);
                Game::update_gamePinball($result,$new_ans[0]['ans_id']);
                //------------------------算金額------------------------------//
                $result = Game::selectRecordNew($new_ans[0]['ans_id']);
                if(count($result)!= 0)
                {
                    Game::comcuteMoney($result);
                    $result2 = Game::selectRecordNew($new_ans[0]['ans_id']);
                    Game::updateUser($result2);
                }
            }
            //------------------------創新局------------------------------//
            $result = Game::get_Total();
            Game::insert_gamePinball($result);
        }
        public static function selectAllPinball()
        {
            $result = DB::query('SELECT `ans_id`,`ball_total` FROM `ans` WHERE `ans_id` = (SELECT MAX(`ans_id`) FROM `ans`)')->execute()->as_array();
            return $result;
        }
        public static function update_gamePinball($array, $ans_id)
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
        //------------------------算金額----------------------------------------------//
        public static function updateUser($all_user_record)
        {
            $x = count($all_user_record);
            for($i=0;$i<$x;$i++)
            {
                $money = 0;
                $balance = DB::query('SELECT `balance` FROM `user` WHERE `username` = '."'".$all_user_record[$i]['username']."'")->execute()->as_array();
                $money = (int)$balance[0]['balance'] + (int)$all_user_record[$i]['get_money']."\n";
                DB::update('user')->set(array(
                    'balance' => $money
                ))->where('username', $all_user_record[$i]['username'])->execute();
            }
        }
        public static function selectRecordNew($record)
        {
            $result = DB::query('SELECT * FROM `record` WHERE `record_id` = '."'".$record."'")->execute()->as_array();
            return $result;
        }
        public static function comcuteMoney($data)
        {
            $countrow = count($data);
            $result = DB::query('SELECT * FROM `ans` WHERE `ans_id` = ' . "'" . $data[0]['record_id'] . "'")->execute()->as_array();

            for ($m = 1; $m < 11; $m++) {
                $ball[$m] = explode('/', $result[0]["{$m}"]);
                $total[$m] = (int)$ball[$m][0] + (int)$ball[$m][1] . " ";
            }

            if ($result[0]['ball_total'] == 11 || $result[0]['ball_total'] == 14) {
                $milk = explode('/', $result[0]['milk_location']);
            }
            $milk[0] = $result[0]['milk_location'];

            for ($f = 0; $f < $countrow; $f++) {

                if ($data[$f]['play_type'] == 'continue_ball') {

                    $op = Game::continue_ball($data[$f]['input'], $total);
                    $date = date("Y-m-d H:i:s");
                    if ($op) {
                        $getMoney = (float)$data[$f]['bet_money'] * (float)$data[$f]['odds'];
                        $finalMoney = floor($getMoney);
                        DB::update('record')->set(array(
                            'answer' => 'win',
                            'get_money' => $finalMoney,
                            'update_time' => $date
                        ))->where('record_id', $data[$f]['record_id'])->and_where('id', $data[$f]['id'])->execute();
                    } else {
                        $finalMoney = -(int)$data[$f]['bet_money'];
                        DB::update('record')->set(array(
                            'answer' => 'lose',
                            'get_money' => $finalMoney,
                            'update_time' => $date
                        ))->where('record_id', $data[$f]['record_id'])->and_where('id', $data[$f]['id'])->execute();
                    }

                }
                if ($data[$f]['play_type'] == 'milk') {
                    $op2 = Game::milk($data[$f]['input'], $result[0]['ball_total'], $milk);
                    $date2 = date("Y-m-d H:i:s");
                    if ($op2) {
                        $getMoney = (float)$data[$f]['bet_money'] * (float)$data[$f]['odds'];
                        $finalMoney = floor($getMoney);;
                        DB::update('record')->set(array(
                            'answer' => 'win',
                            'get_money' => $finalMoney,
                            'update_time' => $date2
                        ))->where('record_id', $data[$f]['record_id'])->and_where('id', $data[$f]['id'])->execute();
                    } else {
                        $finalMoney = -(int)$data[$f]['bet_money'];
                        DB::update('record')->set(array(
                            'answer' => 'lose',
                            'get_money' => $finalMoney,
                            'update_time' => $date2
                        ))->where('record_id', $data[$f]['record_id'])->and_where('id', $data[$f]['id'])->execute();
                    }
                }
                if ($data[$f]['play_type'] == 'odd') {
                    $op3 = Game::odd($data[$f]['input'], $total);
                    $date3 = date("Y-m-d H:i:s");
                    if ($op3) {
                        $getMoney = (float)$data[$f]['bet_money'] * (float)$data[$f]['odds'];
                        $finalMoney = floor($getMoney);;
                        DB::update('record')->set(array(
                            'answer' => 'win',
                            'get_money' => $finalMoney,
                            'update_time' => $date3
                        ))->where('record_id', $data[$f]['record_id'])->and_where('id', $data[$f]['id'])->execute();
                    } else {
                        $finalMoney = -(int)$data[$f]['bet_money'];
                        DB::update('record')->set(array(
                            'answer' => 'lose',
                            'get_money' => $finalMoney,
                            'update_time' => $date3
                        ))->where('record_id', $data[$f]['record_id'])->and_where('id', $data[$f]['id'])->execute();
                    }
                }
                if ($data[$f]['play_type'] == 'even') {
                    $op4 = Game::even($data[$f]['input'], $total);
                    $date4 = date("Y-m-d H:i:s");
                    if ($op4) {
                        $getMoney = (float)$data[$f]['bet_money'] * (float)$data[$f]['odds'];
                        $finalMoney = floor($getMoney);;
                        DB::update('record')->set(array(
                            'answer' => 'win',
                            'get_money' => $finalMoney,
                            'update_time' => $date4
                        ))->where('record_id', $data[$f]['record_id'])->and_where('id', $data[$f]['id'])->execute();
                    } else {
                        $finalMoney = -(int)$data[$f]['bet_money'];
                        DB::update('record')->set(array(
                            'answer' => 'lose',
                            'get_money' => $finalMoney,
                            'update_time' => $date4
                        ))->where('record_id', $data[$f]['record_id'])->and_where('id', $data[$f]['id'])->execute();
                    }
                }
            }
        }

        public static function odd($input, $ball)
        {
            if ($ball[$input] == 1 || $ball[$input] == 3 || $ball[$input] == 5) {
                return true;
            }
            return false;
        }

        public static function even($input, $ball)
        {
            if ($ball[$input] == 2 || $ball[$input] == 4 || $ball[$input] == 6) {
                return true;
            }
            return false;
        }

        public static function milk($input, $ball_total, $milk)
        {
            if ($ball_total == 11 || $ball_total == 14) {
                if ($input == $milk[0] || $input == $milk[1]) {
                    return true;
                }
            } else {
                if ($input == $milk[0]) {
                    return true;
                }
            }


            return false;
        }

        public static function continue_ball($record, $ansBall)
        {
            switch ($record) {
                case 1:
                    if ($ansBall[1] == 0 || $ansBall[2] == 0 || $ansBall[3] == 0 || $ansBall[4] == 0) {
                        return false;
                    }
                    return true;
                    break;
                case 2:
                    if ($ansBall[2] == 0 || $ansBall[3] == 0 || $ansBall[4] == 0 || $ansBall[5] == 0) {
                        return false;
                    }
                    return true;
                    break;
                case 3:
                    if ($ansBall[3] == 0 || $ansBall[4] == 0 || $ansBall[5] == 0 || $ansBall[6] == 0) {
                        return false;
                    }
                    return true;
                    break;
                case 4:
                    if ($ansBall[4] == 0 || $ansBall[5] == 0 || $ansBall[6] == 0 || $ansBall[7] == 0) {
                        return false;
                    }
                    return true;
                    break;
                case 5:
                    if ($ansBall[5] == 0 || $ansBall[6] == 0 || $ansBall[7] == 0 || $ansBall[8] == 0) {
                        return false;
                    }
                    return true;
                    break;
                case 6:
                    if ($ansBall[6] == 0 || $ansBall[7] == 0 || $ansBall[8] == 0 || $ansBall[9] == 0) {
                        return false;
                    }
                    return true;
                    break;
                case 7:
                    if ($ansBall[7] == 0 || $ansBall[8] == 0 || $ansBall[9] == 0 || $ansBall[10] == 0) {
                        return false;
                    }
                    return true;
                    break;
            }
        }
        //------------------------創新一局--------------------------------------------//
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
                'create_time',
                'update_time'
            ))->values(array(
                $ans_id,
                $count,
                $date,
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