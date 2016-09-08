<?php

use \Model\Game;

class Controller_Pinball extends Controller
{
    public function action_view()
    {
        return View::forge('pinball');
    }
    public function action_game()
    {
        $result = Game::get_Total();
        Game::insert_gamePinball($result);
        $final = Game::select_AllPinball();
        $data['ans'] = $final;
        return View::forge('pinball_ans', $data);
    }
    public function action_getTime()
    {
        $time = Game::time_out();
        return $time;
    }
}