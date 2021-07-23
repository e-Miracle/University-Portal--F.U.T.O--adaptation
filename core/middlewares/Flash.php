<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

namespace core\middlewares;


class Flash
{
    public static function message(string $var = FLASH_MESSAGE)
    {
        if (Session::exists($var)) {
            $message = Session::get($var);
            echo "
                <div class=\"alert alert-$message[0] alert-dismissible fade show\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                    $message[1].
                </div>
            ";
            Session::unset($var);
        }
    }

    public static function set(array $message, string $var = FLASH_MESSAGE)
    {
        Session::set($var, $message);
    }
}