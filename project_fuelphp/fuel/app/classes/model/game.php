<?php

namespace Model;

class Game extends \Model
{
    public static function get_Total()
    {
        $number = rand() % 8 + 1;
        $option = rand() % 3 + 1;
        switch ($option) {
            case 1:
                $total = Game::three_Commball($number);
                return $total;
                break;
            case 2:
                $total = Game::one_Milkball($number);
                return $total;
                break;
            case 3:
                $total = Game::commball_Milkball($number);
                return $total;
                break;
        }

    }

    public static function get_random($number)
    {
        $stack = [];
        $stack = Game::while_ball($stack, 2, 0);
        $stack = Game::while_ball($stack, 2, 1);
        $stack = Game::while_ball($stack, 10, 2);
        $stack = Game::while_ball($stack, 10, 9);
        $stack = Game::while_ball($stack, 20, 3);
        $stack = Game::while_ball($stack, 20, 8);
        $stack = Game::while_ball($stack, 80, 4);
        $stack = Game::while_ball($stack, 80, 5);
        $stack = Game::while_ball($stack, 80, 6);
        $stack = Game::while_ball($stack, 80, 7);

        shuffle($stack);
        $random = [];
        $random = array_rand($stack, $number);
        foreach ($random as $value) {
            $ans[] = $stack[$value];
        }
        $check_ans = [];
        $check_ans = array_count_values($ans);
        foreach($check_ans as $key => $value){
            if($value >= 6){
                Game::get_random($number);
            }

        }

        return $ans;
    }

    public static function while_ball($stack, $count, $number)
    {
        $i = 0;
        while ($i < $count) {
            array_push($stack, $number);
            $i++;
        }
        return $stack;
    }

    public static function three_Commball($number)
    {
        $ans = rand() % 2 + 1;
        if ($number == $ans) {
            $total = 13;
            return $total;
        }
        $total = 10;
        return $total;
    }

    public static function one_Milkball($number)
    {
        $ans = rand() % 4 + 1;
        if ($number == $ans) {
            $total = 11;
            return $total;
        }
        $total = 10;
        return $total;
    }

    public static function commball_Milkball($number)
    {
        $ans = rand() % 8 + 1;
        if ($number == $ans) {
            $total = 14;
            return $total;
        }
        $total = 10;
        return $total;
    }

}