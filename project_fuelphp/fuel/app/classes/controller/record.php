<?php
use \Model\Record;

class Controller_record extends Controller
{
    public function action_getRecord()
    {
        $op = Record::insertRecord($_POST);

        if($op)
        {
            $data = array();
            $data['total'] = Record::selectAllRecord();
            return View::forge('pinball_rows',$data);
        }
    }
}