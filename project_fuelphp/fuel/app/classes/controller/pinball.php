<?php

use \Model\Game;

class Controller_Pinball extends Controller
{
    /**
     * 開啟彈珠台的頁面
     *
     * @return mixed
     * view頁面
     */
    public function action_view()
    {
        return View::forge('pinball');
    }

    /**
     * 取得現在系統美東時間的秒數以五分鐘為單位顯示
     *
     * @return int
     * 秒數
     */
    public function action_getTime()
    {
        $time = Game::timeOut();
        return $time;
    }

    /**
     * 取得新局的期數及總球數
     *
     * @return mixed
     * 將值回傳至pinball_ans顯示
     */
    public function action_game()
    {
        $result = Game::selectNewPinball();
        if (count($result) != 0) {
            $data['ans'] = $result[0]['ans_id'];
            $data['ball_total'] = $result[0]['ball_total'];
            return View::forge('pinball_ans', $data);
        }
        $data['error'] = '新的開始，請稍後...';
        return View::forge('pinball_error', $data);
    }

    /**
     * 取得上一期的答案
     *
     * @return mixed
     * 將值回傳至pinball_total顯示
     */
    public function action_selectOneAns()
    {
        $result = Game::selectOnePinball();

        if (count($result) != 0) {
            $data['total'] = $result;
            return View::forge('pinball_total', $data);
        }
        $data['error'] = '新的開始，請稍後...';
        return View::forge('pinball_error', $data);
    }
}