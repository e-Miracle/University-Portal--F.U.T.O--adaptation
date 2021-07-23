<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

namespace core\middlewares;


class Token
{
    public static function generate()
    {
        //var_dump();
        return Session::set(TOKEN_NAME, (md5(uniqid())));
    }

    public static function validate($var)
    {
        $token = TOKEN_NAME;

        if (Session::exists($token) && $var === Session::get($token))
        {
            Session::unset($token);
            return true;
        }
        return false;
    }
}