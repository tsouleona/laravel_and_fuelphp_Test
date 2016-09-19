<?php
namespace Fuel\Tasks;

use \Model\Game;
use \Model\Ans;
use \Model\Record;
use \Model\user;

date_default_timezone_set('America/New_York');

class Create
{
    /**
     * 遊戲流程：跑上一期賽果 -> 計算上一期的賽果 -> 開新局
     */
    public function game()
    {
        $new_ans = Ans::selectNewPinball();
        if ($new_ans) {
            //輸出賽果
            $result = Game::getRandom($new_ans[0]['ball_total']);
            Ans::updateGamePinball($result, $new_ans[0]['ans_id']);

            //算金額
            $result = Record::selectNewRecord($new_ans[0]['ans_id']);
            if (count($result) != 0) {
                $result2  = Record::computeMoney($result);
                user::updateUser($result2);
            }
        }
        //創新局
        $result = Game::getTotal();
        Ans::insertGamePinball($result);
    }

}