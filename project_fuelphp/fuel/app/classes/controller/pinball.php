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
        if(count($result) != 0)
        {
            $data['ans'] = $result[0]['ans_id'];
            $data['ball_total'] = $result[0]['ball_total'];
            return View::forge('pinball_ans', $data);
        }
        $data['error'] = '新的開始，請稍後...';
        return View::forge('pinball_error',$data);
    }
    public function action_selectOneAns()
    {
        $result = Game::selectOnePinball();

        if(count($result) != 0)
        {
            $data['total'] = $result;
            return View::forge('pinball_total', $data);
        }
        $data['error'] = '新的開始，請稍後...';
        return View::forge('pinball_error',$data);
    }
}