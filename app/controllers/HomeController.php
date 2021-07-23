<?php


namespace app\controllers;


use core\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $this->layout = "blank";
        return $this->view("index");
    }
}