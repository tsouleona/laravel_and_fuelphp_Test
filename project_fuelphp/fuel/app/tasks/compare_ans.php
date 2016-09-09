<?php
    namespace Fuel\Tasks;
    use \fuel\core\DB;
    date_default_timezone_set('America/New_York');

    class Compare
        {
            function compareAns()
            {
                $result = Compare::selectRecordNew();
                Compare::comcuteMoney($result);
                $result = Compare::selectRecordNew();
                Compare::comcuteblance($result);
            }
            public static function comcuteblance($data)
            {
                for($i=0;$i<count($data);$i++)
                {
                    for($j=1;$j<$i;$j++)
                    $money = $data[$i]['get_money'] + $data[$j]['get_money'];

                }
            }
            public static function selectRecordNew()
            {
                $date = date("Ymd");
                $max = DB::select('SELECT MAX(`record_id`) FROM `record`');
                $result = DB::select("SELECT * FROM `record` WHERE `record_id` =  {$max}")->execute()->as_array();
                return $result;
            }
            public static function comcuteMoney($data)
            {
                $countrow = count($data);
                $result = DB::select('SELECT * FROM `ans` WHERE `ans_id` = '."'".$data[0]['record_id']."'")->execute()->as_array();

                    for($m=1;$m<11;$m++)
                    {
                        $ball[$m] = explode('/', $result["{$m}"]);
                        $total[$m] = (int)$ball[$m][0] + (int)$ball[$m][1];
                    }

                    if($result['ball_total'] == 11 || $result['ball_total'] == 14)
                    {
                        $milk = explode('/', $result['milk_location']);
                    }
                    $milk = $result['milk_location'];

                for($f=0;$f<$countrow;$f++)
                {

                    if($data[$f]['play_type'] == 'continue_ball')
                    {

                        $op = Compare::continue_ball($data[$f], $total);
                        if($op)
                        {
                            $getMoney = (int)$data[$f]['bet_money'] * (double)$data[$f]['odds'];
                            DB::update('record')->set(array(
                                'anser'=> 'win',
                                'get_money' => $getMoney
                            ))->where('record_id',$data[$f]['record_id'])->execute();
                        }
                        else{
                            $getMoney2 = (int)$data[$f]['bet_money'] * (double)$data[$f]['odds'];
                            $getMoney2 = -$getMoney2;
                            DB::update('record')->set(array(
                                'anser'=> 'win',
                                'get_money' => $getMoney2
                            ))->where('record_id',$data[$f]['record_id'])->execute();
                        }

                    }
                    if($data[$f]['play_type'] == 'milk')
                    {
                        $op2 = Compare::milk($data[$f],$milk);

                        if($op)
                        {
                            $getMoney = (int)$data[$f]['bet_money'] * (double)$data[$f]['odds'];
                            DB::update('record')->set(array(
                                'anser'=> 'win',
                                'get_money' => $getMoney
                            ))->where('record_id',$data[$f]['record_id'])->execute();
                        }
                        else{
                            $getMoney2 = (int)$data[$f]['bet_money'] * (double)$data[$f]['odds'];
                            $getMoney2 = -$getMoney2;
                            DB::update('record')->set(array(
                                'anser'=> 'win',
                                'get_money' => $getMoney2
                            ))->where('record_id',$data[$f]['record_id'])->execute();
                        }
                    }
                    if($data[$f]['play_type'] == 'odd')
                    {
                        $op3 = Compare::odd($data[$f],$total);

                        if($op3)
                        {
                            $getMoney = (int)$data[$f]['bet_money'] * (double)$data[$f]['odds'];
                            DB::update('record')->set(array(
                                'anser'=> 'win',
                                'get_money' => $getMoney
                            ))->where('record_id',$data[$f]['record_id'])->execute();
                        }
                        else{
                            $getMoney2 = (int)$data[$f]['bet_money'] * (double)$data[$f]['odds'];
                            $getMoney2 = -$getMoney2;
                            DB::update('record')->set(array(
                                'anser'=> 'win',
                                'get_money' => $getMoney2
                            ))->where('record_id',$data[$f]['record_id'])->execute();
                        }
                    }
                    if($data[$f]['play_type'] == 'even')
                    {
                        $op4 = Compare::even($data[$f],$total);

                        if($op4)
                        {
                            $getMoney = (int)$data[$f]['bet_money'] * (double)$data[$f]['odds'];
                            DB::update('record')->set(array(
                                'anser'=> 'win',
                                'get_money' => $getMoney
                            ))->where('record_id',$data[$f]['record_id'])->execute();
                        }
                        else{
                            $getMoney2 = (int)$data[$f]['bet_money'] * (double)$data[$f]['odds'];
                            $getMoney2 = -$getMoney2;
                            DB::update('record')->set(array(
                                'anser'=> 'win',
                                'get_money' => $getMoney2
                            ))->where('record_id',$data[$f]['record_id'])->execute();
                        }
                    }

                }
            }
        public static function even($data, $ball)
        {
            if($ball[$data['input']] == 1 || $ball[$data['input']] == 3 || $ball[$data['input']] == 5)
            {
                return true;
            }
            return false;
        }
            public static function odd($data, $ball)
            {
                if($ball[$data['input']] == 2 || $ball[$data['input']] == 4 || $ball[$data['input']] == 6)
                {
                    return true;
                }
                return false;
            }
            public static function milk($data, $milk)
            {
                for($h=0;$h<count($milk);$h++)
                {
                    if($data['input'] == $milk[$h])
                    {
                        return true;
                    }
                }
                return false;
            }
            public static function continue_ball($recod, $ansBall)
            {
                switch($recod['input'])
                {
                    case 1:
                        if($ansBall[1]== null || $ansBall[2]== null || $ansBall[3]== null || $ansBall[4]== null)
                        {
                            return false;
                        }
                        return true;
                    break;
                    case 2:
                        if($ansBall[2]== null || $ansBall[3]== null || $ansBall[4]== null || $ansBall[5]== null)
                        {
                            return false;
                        }
                        return true;
                        break;
                    case 3:
                        if($ansBall[3]== null || $ansBall[4]== null || $ansBall[5]== null || $ansBall[6]== null)
                        {
                            return false;
                        }
                        return true;
                        break;
                    case 4:
                        if($ansBall[4]== null || $ansBall[5]== null || $ansBall[6]== null || $ansBall[7]== null)
                        {
                            return false;
                        }
                        return true;
                        break;
                    case 5:
                        if($ansBall[5]== null || $ansBall[6]== null || $ansBall[7]== null || $ansBall[8]== null)
                        {
                            return false;
                        }
                        return true;
                        break;
                    case 6:
                        if($ansBall[6]== null || $ansBall[7]== null || $ansBall[8]== null || $ansBall[9]== null)
                        {
                            return false;
                        }
                        return true;
                        break;
                    case 7:
                        if($ansBall[7]== null || $ansBall[8]== null || $ansBall[9]== null || $ansBall[10]== null)
                        {
                            return false;
                        }
                        return true;
                        break;
                }
            }

        }