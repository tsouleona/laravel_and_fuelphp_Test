<?php

use \Model\Game;

class Controller_Pinball extends Controller
{
    public function action_view()
    {
        return View::forge('pinball');
    }
    public function action_getTime()
    {
        $time = Game::timeOut();
        return $time;
    }
    public function action_game()
    {
        $result = Game::selectAllPinball();
        $data['ans'] = $result[0]['ans_id'];
        $data['ball_total'] = $result[0]['ball_total'];
        return View::forge('pinball_ans', $data);
    }
    public function action_selectOneAns()
    {
        $result = Game::selectOnePinball($_POST['record_id']);
        if(count($result) != 0)
        {
            $data['total'] = $result;
            return View::forge('pinball_total', $data);
        }
    }
}