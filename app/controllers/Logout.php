<?php


namespace app\controllers;


use core\Controller;
use core\middlewares\Auth;
use core\middlewares\Cookie;
use core\middlewares\Redirect;

class Logout extends Controller
{
    public function __construct()
    {
        $this->logout();
    }

    public function logout()
    {
        if (!Auth::guest()) {
            Cookie::dCookie();
            session_unset();
            session_destroy();
            return Redirect::to('/login');
        }
        else {
            return Redirect::to('/login');
        }
    }
}