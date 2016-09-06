<?php

use \Model\Game;

class Controller_Pinball extends Controller
{
    public function action_index()
    {
        return View::forge('pinball');
    }
    public function game()
    {
        $results = Game::get_Total();
        $ball['number'] = $results;
        return View::forge('pinball', $ball);
    }

    public function get_Total()
    {

    }
    public function get_Ans()
    {
        $row = Game::get_random();
    }
}