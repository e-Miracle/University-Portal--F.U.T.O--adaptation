<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

namespace core\middlewares;


class Captcha
{
    public function __construct()
    {
        Cache::none();
    }

    public static function generate()
    {
        $operators = ['+', '-', '*', '/'];
        $one = mt_rand(1, 11);
        $two = mt_rand(1, 11);

        switch ($operators[mt_rand(0, 2)]) {
            case '+':
                $question = $one .' + '. $two;
                $answer = $one + $two;
                break;
            case '-':
                $question = $one .' - '. $two;
                $answer = $one - $two;
                break;
            case '*':
                $question = $one .' * '. $two;
                $answer = $one * $two;
                break;
            case '/':
                $question = $one .' / '. $two;
                $answer = $one / $two;
                break;
        }
        echo $question??null;

        self::emptyCaptcha();

        return Session::set(CAPTCHA_NAME, ($answer??null));
    }

    public static function validate($var)
    {
        $captcha = CAPTCHA_NAME;

        if (Session::exists($captcha) && $var === Session::get($captcha))
        {
            Session::unset($captcha);
            return true;
        }
        return false;
    }

    private static function emptyCaptcha()
    {
        return Session::unset(CAPTCHA_NAME);
    }
}