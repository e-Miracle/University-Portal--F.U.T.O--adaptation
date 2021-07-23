<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

namespace core\middlewares;


class Session
{
    public static function set($var1, $var2)
    {
        return $_SESSION[$var1] = $var2;
    }

    public static function exists($var)
    {
        return isset($_SESSION[$var]);
    }

    public static function unset($var)
    {
        if(self::exists($var)==TRUE)
        {
            unset($_SESSION[$var]);
        }

        return true;
    }

    public static function get($var)
    {
        return $_SESSION[$var]??'';
    }
}