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
        $time = Game::time_out();
        return $time;
    }
    public function action_game()
    {
        $result = Game::select_AllPinball();
        $data['ans'] = $result[0]['ans_id'];
        $data['ball_total'] = $result[0]['ball_total'];
        return View::forge('pinball_ans', $data);
    }
}