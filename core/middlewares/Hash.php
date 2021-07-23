<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

namespace core\middlewares;


class Hash
{
    public static function make($string, $salt='')
    {
        return hash('sha256', $string, $salt);
    }

    public static function salt($length)
    {
        return random_bytes($length);
    }

    public static function unique($param = [])
    {
        return self::make(random_bytes(mt_rand($param['min']??10,$param['max']??99)));
    }

    public static function encrypt($string = null)
    {
        if (in_array(CIPHER, openssl_get_cipher_methods())) {

            $ivlen = openssl_cipher_iv_length(CIPHER);

            $iv = openssl_random_pseudo_bytes($ivlen);

            $chiphertext = openssl_encrypt($string, CIPHER, ENCRYPTION_KEY, $option = 0, $iv, $tag);

            $obj = new \stdClass();
            $obj->ciphertext = $chiphertext;
            $obj->iv = bin2hex($iv);
            $obj->tag = bin2hex($tag);

            return $obj;
        }else {
            throw new \Exception("invalid cipher method", 500);
        }
    }

    public static function decrypt($chiphertext, $iv, $tag)
    {
        if($string = openssl_decrypt($chiphertext, CIPHER, ENCRYPTION_KEY, $option = 0, hex2bin($iv), hex2bin($tag))){
            return $string;
        }
        return false;
    }

    public static function createID($param = [])
    {
        return bin2hex(random_bytes(mt_rand($param['min']??5,$param['max']??5)));
    }
}