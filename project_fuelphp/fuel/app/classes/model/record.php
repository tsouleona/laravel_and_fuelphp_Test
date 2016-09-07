<?php
namespace Model;

use \fuel\core\DB;

date_default_timezone_set('America/New_York');

class Record extends \Model
{

    public static function insertRecord($data)
    {
        $datetime = date("Y-m-d h:i:s");
        $record_id = Record::select_Spec_Record();
        for ($i = 1; $i < 11; $i++) {
            if ($data["milk_money{$i}"] != '0') {
                DB::insert('record')->columns(array(
                    'record_id',
                    'play_type',
                    'input',
                    'bet_money',
                    'create_time',
                    'update_time'
                ))->values(array(
                    $record_id,
                    "milk",
                    $i,
                    $data["milk_money{$i}"],
                    $datetime,
                    $datetime
                ))->execute();
            }
        }
        for ($i = 1; $i < 11; $i++) {
            if ($data["odd_money{$i}"] != '0') {
                DB::insert('record')->columns(array(
                    'record_id',
                    'play_type',
                    'input',
                    'bet_money',
                    'create_time',
                    'update_time'
                ))->values(array(
                    $record_id,
                    "odd",
                    $i,
                    $data["odd_money{$i}"],
                    $datetime,
                    $datetime
                ))->execute();
            }
        }
        for ($i = 1; $i < 11; $i++) {
            if ($data["even_money{$i}"] != '0') {
                DB::insert('record')->columns(array(
                    'record_id',
                    'play_type',
                    'input',
                    'bet_money',
                    'create_time',
                    'update_time'
                ))->values(array(
                    $record_id,
                    "even",
                    $i,
                    $data["even_money{$i}"],
                    $datetime,
                    $datetime
                ))->execute();
            }
        }
        for ($i = 1; $i < 8; $i++) {
            if ($data["continue_money{$i}"] != '0') {
                DB::insert('record')->columns(array(
                    'record_id',
                    'play_type',
                    'input',
                    'bet_money',
                    'create_time',
                    'update_time'
                ))->values(array(
                    $record_id,
                    "continue_ball",
                    $i,
                    $data["continue_money{$i}"],
                    $datetime,
                    $datetime
                ))->execute();
            }
        }

        return true;
    }

    public static function select_Spec_Record()
    {
        $date = date("Ymd");
        $result = DB::query('SELECT `record_id` FROM `record` WHERE `record_id` LIKE ' . "'" . '%' . $date . '%' . "'" . ' ORDER BY `record_id` DESC')->execute();
        if ($result[0]['record_id'] == null) {
            return $date."001";
        }
        $id = (int)$result[0]['record_id'];
        $final = $id + 1;
        return $final;
    }

    public static function selectAllRecord()
    {
        $date = date("Ymd");
        $result = DB::query('SELECT * FROM `record` WHERE `record_id` = (SELECT MAX(`record_id`) FROM `record`)')->execute()->as_array();
        return $result;
    }

}