<?php
use \Model\Record;

class Controller_record extends Controller
{
    /**
     * insert到下注紀錄的資料表，並搜出最新下注資料
     *
     * @return mixed
     * 將值回傳至pinball_rows顯示
     */
    public function action_getRecord()
    {
        $op = Record::insertRecord($_POST);

        if($op)
        {
            $data['total'] = Record::selectAllRecord();
            return View::forge('pinball_rows', $data);
        }
    }

    /**
     * 取得最新下注資料
     *
     * @return mixed
     * 將值回傳至pinball_rows顯示
     */
    public function action_getOneRecord()
    {
        $data['total'] = Record::selectAllRecord();
        return View::forge('pinball_rows', $data);
    }

    /**
     * 取得一筆比對好的最新下注資料
     *
     * @return mixed
     * 將值回傳至pinball_compare顯示
     */
    public function action_getNewRecord()
    {
        $result = Record::selectOneRecord();
        if(count($result))
        {
            $data['totalAns'] = $result;
            return View::forge('pinball_compare', $data);
        }
        $data['error'] = '重新開始，沒有球局';
        return View::forge('pinball_error', $data);
    }
}