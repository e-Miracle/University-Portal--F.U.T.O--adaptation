<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

namespace core;


class View
{
    public static function yield($path)
    {
        $position = strpos($path, ".");
        if ($position){
            $path = str_replace(".", "/", $path);
        }
        require_once BASE_URL."/views/$path.php";
    }

    public static function extend($layout)
    {
        $position = strpos($layout, ".");
        if ($position){
            $layout = str_replace(".", "/", $layout);
        }
        (new self)->setLayout($layout);
    }
}