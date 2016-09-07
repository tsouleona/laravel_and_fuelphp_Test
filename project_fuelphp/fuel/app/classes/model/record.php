<?php
namespace Model;

use Fuel\Core\Config;
use \fuel\core\DB;

date_default_timezone_set('America/New_York');

class Record extends \Model
{

    public static function insertRecord($data)
    {

        $datetime = date("Y-m-d h:i:s");
        $record_id = Record::select_SpecRecord();

        for ($i = 1; $i < 11; $i++) {
            if ($data["milk_money{$i}"] != '0') {
                $odds = Record::compute_Milk($i);
                DB::insert('record')->columns(array(
                    'record_id',
                    'play_type',
                    'input',
                    'bet_money',
                    'odds',
                    'create_time',
                    'update_time'
                ))->values(array(
                    $record_id,
                    "milk",
                    $i,
                    $data["milk_money{$i}"],
                    $odds,
                    $datetime,
                    $datetime
                ))->execute();
            }
        }
        for ($i = 1; $i < 11; $i++) {
            if ($data["odd_money{$i}"] != '0') {
                $odds = Record::compute_OddEven();
                DB::insert('record')->columns(array(
                    'record_id',
                    'play_type',
                    'input',
                    'bet_money',
                    'odds',
                    'create_time',
                    'update_time'
                ))->values(array(
                    $record_id,
                    "odd",
                    $i,
                    $data["odd_money{$i}"],
                    $odds,
                    $datetime,
                    $datetime
                ))->execute();
            }
        }
        for ($i = 1; $i < 11; $i++) {
            if ($data["even_money{$i}"] != '0') {
                $odds = Record::compute_OddEven();
                DB::insert('record')->columns(array(
                    'record_id',
                    'play_type',
                    'input',
                    'bet_money',
                    'odds',
                    'create_time',
                    'update_time'
                ))->values(array(
                    $record_id,
                    "even",
                    $i,
                    $data["even_money{$i}"],
                    $odds,
                    $datetime,
                    $datetime
                ))->execute();
            }
        }
        for ($i = 1; $i < 8; $i++) {
            if ($data["continue_money{$i}"] != '0') {
                $odds = Record::compute_ContinueBall($i);
                DB::insert('record')->columns(array(
                    'record_id',
                    'play_type',
                    'input',
                    'bet_money',
                    'odds',
                    'create_time',
                    'update_time'
                ))->values(array(
                    $record_id,
                    "continue_ball",
                    $i,
                    $data["continue_money{$i}"],
                    $odds,
                    $datetime,
                    $datetime
                ))->execute();
            }
        }

        return true;
    }

    public static function compute_Milk($balltruck)
    {


        $pro = Config::get("hole.{$balltruck}");

        $tmp = 1/$pro * 0.92;
        $final = number_format($tmp, 2);
        return $final;
    }

    public static function compute_OddEven()
    {
        $tmp = 1/0.5 * 0.92;
        $final = number_format($tmp, 2);
        return $final;
    }

    public static function compute_ContinueBall($continueballstruct)
    {

        $pro = Config::get("continue.{$continueballstruct}");

        $tmp = 1/$pro * 0.92;
        $final = number_format($tmp, 2);
        return $final;
    }
    public static function select_SpecRecord()
    {
        $date = date("Ymd");
        $result = DB::query('SELECT `record_id` FROM `record` WHERE `record_id` LIKE ' . "'" . '%' . $date . '%' . "'" . ' ORDER BY `record_id` DESC')->execute();
        if ($result[0]['record_id'] == null) {
            return $date . "001";
        }
        $id = (int)$result[0]['record_id'];
        $final = $id + 1;
        return $final;
    }

    public static function selectAllRecord()
    {
        $result = DB::query('SELECT * FROM `record` WHERE `record_id` = (SELECT MAX(`record_id`) FROM `record`)')->execute()->as_array();
        return $result;
    }

}