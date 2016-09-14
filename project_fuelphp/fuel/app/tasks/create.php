<?php
namespace Fuel\Tasks;

use \Model\Game;
use\Model\CompareMoney;
use \fuel\core\DB;

date_default_timezone_set('America/New_York');

class Create
{
    /**
     * 遊戲流程：跑上一期賽果 -> 計算上一期的賽果 -> 開新局
     */
    public function game()
    {
        $new_ans = Game::selectNewPinball();
        if (count($new_ans) != 0) {

            //輸出賽果
            $result = Game::getRandom($new_ans[0]['ball_total']);
            Game::updateGamePinball($result, $new_ans[0]['ans_id']);

            //算金額
            $result = CompareMoney::selectNewRecord($new_ans[0]['ans_id']);
            if (count($result) != 0) {
                CompareMoney::computeMoney($result);
                $result2 = CompareMoney::selectNewRecord($new_ans[0]['ans_id']);
                CompareMoney::updateUser($result2);
            }
        }

        //創新局
        $result = Game::getTotal();
        Game::insertGamePinball($result);
    }

}