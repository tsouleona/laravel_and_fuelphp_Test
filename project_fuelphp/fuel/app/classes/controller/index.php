<?php

use \Model\User;

class Controller_index extends Controller
{
    /**
     * 開啟登入頁面
     *
     * @return mixed
     * 將值回傳至login顯示
     */
    public function action_index()
    {
        return View::forge('login');
    }

    /**
     * 登入判斷有沒有這個人，並搜尋該對象的餘額
     *
     * @return mixed
     * 將值回傳至pinball顯示
     */
    public function action_login()
    {
        $balance = User::login($_POST);
        if ($balance != null) {
            $data['balance'] = $balance;
            return View::forge('pinball', $data);
        }
        return View::forge('login');
    }

    /**
     * 搜尋該帳號的餘額
     *
     * @return mixed
     * 回傳user的餘額
     */
    public function action_getBalance()
    {
        $balance = User::getBalance($_POST['username']);
        return $balance;
    }

    /**
     * 摧毀session
     *
     * @return mixed
     * 導頁至login
     */
    public function action_logout()
    {
        \Session::destroy('username');
        return View::forge('login');
    }
}