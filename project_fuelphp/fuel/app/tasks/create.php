<?php
    namespace Fuel\Tasks;

    use \Model\Game;
    use\Model\CompareMoney;
    use \fuel\core\DB;
    date_default_timezone_set('America/New_York');
    class Create
    {
        public function game()
        {
            $new_ans = Game::selectAllPinball();
            if(count($new_ans) != 0)
            {

                //輸出賽果
                $result = Game::get_random($new_ans[0]['ball_total']);
                Game::update_gamePinball($result,$new_ans[0]['ans_id']);

                //算金額
                $result = CompareMoney::selectNewRecord($new_ans[0]['ans_id']);
                if(count($result)!= 0)
                {
                    CompareMoney::comcuteMoney($result);
                    $result2 = CompareMoney::selectNewRecord($new_ans[0]['ans_id']);
                    CompareMoney::updateUser($result2);
                }
            }

            //創新局
            $result = Game::get_Total();
            Game::insert_gamePinball($result);
        }

    }