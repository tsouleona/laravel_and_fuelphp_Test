<?php
namespace Model;
use \fuel\core\DB;
date_default_timezone_set('America/New_York');
class Record extends \Model
{

    public static function insert_Record($data)
    {
        $datetime = date("Y-m-d h:i:s");
        $record_id = Record::select_Spec_Record();
        if($data['milk_number']!= null && $data['milk_money']!= '0')
        {
            $milk_number = $data['milk_number'];
            $milk_money = $data['milk_money'];

            DB::insert('record')->columns(array(
                'record_id', 'play_type', 'input', 'money', 'time'
            ))->values(array(
                $record_id,"milk",$milk_number,$milk_money,$datetime
            ))->execute();
        }
        if($data['one_odd_money']!= '0')
        {
            $one_odd_money = $data['one_odd_money'];
            $record_id = Record::select_Spec_Record();
            DB::insert('record')->columns(array(
                'record_id', 'play_type', 'input', 'money', 'time'
            ))->values(array(
                $record_id,"odd",1,$one_odd_money,$datetime
            ))->execute();
        }
        if($data['two_odd_money']!= '0')
        {
            $two_odd_money = $data['one_odd_money'];
            $record_id = Record::select_Spec_Record();
            DB::insert('record')->columns(array(
                'record_id', 'play_type', 'input', 'money', 'time'
            ))->values(array(
                $record_id,"odd",2,$two_odd_money,$datetime
            ))->execute();
        }
        if($data['three_odd_money']!= '0')
        {
            $three_odd_money = $data['one_odd_money'];
            $record_id = Record::select_Spec_Record();
            DB::insert('record')->columns(array(
                'record_id', 'play_type', 'input', 'money', 'time'
            ))->values(array(
                $record_id,"odd",3,$three_odd_money,$datetime
            ))->execute();
        }
        if($data['four_odd_money']!= '0')
        {
            $four_odd_money = $data['one_odd_money'];
            $record_id = Record::select_Spec_Record();
            DB::insert('record')->columns(array(
                'record_id', 'play_type', 'input', 'money', 'time'
            ))->values(array(
                $record_id,"odd",4,$four_odd_money,$datetime
            ))->execute();
        }
        if($data['five_odd_money']!= '0')
        {
            $five_odd_money = $data['one_odd_money'];
            $record_id = Record::select_Spec_Record();
            DB::insert('record')->columns(array(
                'record_id', 'play_type', 'input', 'money', 'time'
            ))->values(array(
                $record_id,"odd",5,$five_odd_money,$datetime
            ))->execute();
        }
        if($data['six_odd_money']!= '0')
        {
            $six_odd_money = $data['one_odd_money'];
            $record_id = Record::select_Spec_Record();
            DB::insert('record')->columns(array(
                'record_id', 'play_type', 'input', 'money', 'time'
            ))->values(array(
                $record_id,"odd",6,$six_odd_money,$datetime
            ))->execute();
        }

        return false;


    }
    public static function select_Spec_Record()
    {
        $date = date("Ymd");
        $result = DB::query('SELECT `record_id` FROM `record` WHERE `record_id` LIKE '."'".'%'.$date.'%'."'".' ORDER BY `record_id` DESC')->execute();
        if($result == null)
        {
            return $date.'001';
        }
        $id = (int)$result[0]['record_id'];
        $final = $id + 1;
        return $final;
    }
    public static function select_All_Record()
    {
        $result = DB::query('SELECT * FROM `record`');
        return $result;
    }

}