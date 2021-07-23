<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

namespace core\middlewares;


use app\controllers\Logout;
use core\DB;

class Auth
{
    public static function set($user_id)
    {
        $token = self::addAuth($user_id);
        session_regenerate_id(true);

        if (Session::set('VALIDATION_TOKEN', $token) && Session::set('LAST_TIME', Time::now())) {
            return true;
        }

        return false;
    }

    private function check()
    {
        if (!Session::exists('VALIDATION_TOKEN') OR !Session::exists('LAST_TIME')) {
            return false;
        }

        if (!$this->checkWithDatabase()) {
            return false;
        }
        /**
         * now we are sure that data is contained in the checkWithDatabse method
         * so we go ahead to assign the method
         */
        $data = $this->checkWithDatabase();

        if ((strtotime(date("Y-m-d H:i:s", Session::get('LAST_TIME') + 30*60))) < Time::now()) {
            return false;
        }

        if ($data->ip != Ip::getIp()) {
            return false;
        }

        if ($data->user_agent != Ip::getAgent()) {
            return false;
        }

        Session::set('LAST_TIME', Time::now());

        return true;
    }

    private function checkWithDatabase()
    {
        $s = DB::getInstance()->select('session', ['hash', '=', Session::get('VALIDATION_TOKEN')]);
        if ($s->count()) {
            return $s->fetchOne();
        }
        return false;
    }

    public static function guest()
    {
        if ((new Auth)->check()) {
            return false;
        }
        return true;
    }

    public static function user($user_id = null){
        ($user_id === null && (new self)->checkWithDatabase())? $id = (new self)->checkWithDatabase()->user_id : $id = $user_id;
        return ($id != null) ? (new self)->checkWithDatabaseForUSer($id) : false;
    }

    private function checkWithDatabaseForUSer($id)
    {
        $s = DB::getInstance()->select('users', ['id', '=', $id]);
        if ($s->count()) {
            return $s->fetchOne();
        }
        return false;
    }

    private static function addAuth($id)
    {
        $token = Hash::unique();
        $add = DB::getInstance()->select('session', ['user_id', '=', $id]);
        if ($add->count()) {
            $add = DB::getInstance()->update('session', ['hash' => $token, 'user_agent' => Ip::getAgent(), 'ip' => Ip::getIp()], ['user_id' => $id]);
        }else{
            $add = DB::getInstance()->insert('session', ['user_id' => $id, 'hash' => $token, 'user_agent' => Ip::getAgent(), 'ip' => Ip::getIp()]);
        }
        return $token;
    }

    public static function isLoggedIn()
    {
        if (!(new Auth)->check())
        {
            return (new Logout())->logout();
        }
        return true;
    }

    public static function isStudent($flag = false)
    {
        if ((new Auth())->check())
        {
            if (self::user()->type != 'student')
            {
                if ($flag)
                {
                    return false;
                }
                throw new \Exception("You should'nt be here", 500);
            }
        }
        return true;
    }

    public static function isLecturer($flag = false)
    {
        if ((new Auth())->check())
        {
            if (self::user()->type != 'lecturer')
            {
                if ($flag)
                {
                    return false;
                }
                throw new \Exception("You should'nt be here", 500);
            }
        }
        return true;
    }

    public static function isAdmin($flag = false)
    {
        if ((new Auth())->check())
        {
            if (self::user()->type != 'admin')
            {
                if ($flag)
                {
                    return false;
                }
                throw new \Exception("You should'nt be here", 500);
            }
        }
        return true;
    }
}