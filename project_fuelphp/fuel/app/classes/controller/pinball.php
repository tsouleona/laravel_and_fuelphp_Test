<?php

use \Model\Game;

class Controller_Pinball extends Controller
{
    public function action_index()
    {
        return View::forge('pinball');
    }
    public function action_game()
    {
        $results = Game::get_Total();
//        Game::insert_gamePinball($results);
//        $final = Game::select_AllPinball();
        $data['ans'] = $results;
        return View::forge('pinball_ans', $data);
    }

}