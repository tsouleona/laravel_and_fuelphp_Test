<?php
use \Model\Record;

class Controller_record extends Controller
{
    public function action_get_record()
    {
        $op = Record::insert_Record($_POST);

        if($op)
        {
            $result = Record::select_All_Record();
            return View::forge('pinball',$result);
        }
    }
}