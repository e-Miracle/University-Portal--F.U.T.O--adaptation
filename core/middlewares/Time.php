<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

namespace core\middlewares;


class Time
{
    public static function now($param = 'now')
    {
        return strtotime($param);
    }

    public static function today()
    {
        return date("Y-m-d H:i:s");
    }
}