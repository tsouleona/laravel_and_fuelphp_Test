<?php

use \Model\CompareMoney;

class Controller_Compare extends Controller
{
    public function action_compareAns()
    {
        $result = CompareMoney::selectRecordNew($_POST['username'], $_POST['record']);
        if(count($result)!= 0)
        {
            $result3 = CompareMoney::selectRecordNew($_POST['username'], $_POST['record']);
            $data['totalAns'] = $result3;
            return View::forge('pinball_compare', $data);
        }
    }
}