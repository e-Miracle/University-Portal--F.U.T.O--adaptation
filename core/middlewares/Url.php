<?php


namespace core\middlewares;


class Url
{
    public static function home($url = null)
    {
        return '/'.WEB_URL.$url;
    }
}