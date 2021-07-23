<?php


namespace app\controllers\portal;


use core\Controller;
use core\middlewares\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        Auth::isLoggedIn();

        $this->setLayout('dashboard');
    }

    public function home()
    {
        $title = 'Dashboard';
        return $this->view('portal.dashboard', compact('title'));
    }
}