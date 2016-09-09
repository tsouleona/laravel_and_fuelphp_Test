<?php

use \Model\CompareMoney;

class Controller_Compare extends Controller
{
    public function action_compareAns()
    {
        $result = CompareMoney::selectRecordNew();
        CompareMoney::comcuteMoney($result);
        $result2 = CompareMoney::selectRecordNew();
        $money = CompareMoney::comcuteblance($result2);
        CompareMoney::updateUser($money, $_POST);
        $result3 = CompareMoney::selectRecordNew();
        $data['totalAns'] = $result3;
        return View::forge('pinball_compare', $data);
    }
}