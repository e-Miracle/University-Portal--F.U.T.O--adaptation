<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

namespace core\middlewares;


class Cookie
{
    public static function exists($name = COOKIE_NAME)
    {
        return isset($_COOKIE[$name]);
    }

    public static function get($name = COOKIE_NAME)
    {
        if (self::exists($name)) {
            return $_COOKIE[$name];
        }
        return false;
    }

    public static function set($value, $name = COOKIE_NAME, $expiry = COOKIE_EXPIRY)
    {
        if (setCookie($name, $value, Time::now() + intVal($expiry), '/')) {
            return true;
        }

        return false;
    }

    public static function dCookie($name = COOKIE_NAME)
    {
        self::set('', $name, time()-1);
    }
}