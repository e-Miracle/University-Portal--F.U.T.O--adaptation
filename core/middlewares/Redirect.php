<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

namespace core\middlewares;


class Redirect
{

    public static function to($url = null)
    {
        if (!is_null($url)) {
            return header("location: $url");
        }else {
            return header("location: /");
        }
    }

    public function external()
    {
        $external = true;
        return $this;
    }
}