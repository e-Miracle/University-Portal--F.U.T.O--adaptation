<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

namespace core\form;


use core\form\fields\Field;
use core\middlewares\Token;
use core\Model;

class Form
{
    public static function start($action, $method, $encryption = '')
    {
        echo sprintf('<form action ="%s" method ="%s" enctype="%s">', $action, $method, $encryption);

        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute) {
        return new Field($model, $attribute);
    }
}