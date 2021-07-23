<?php


namespace app\helpers;


use core\Controller;
use core\DB;

class App extends Controller
{
    public static function getFaculty($id)
    {
        return DB::getInstance()->select('faculty', ['id', '=', $id])->fetchOne();
    }

    public static function getDepartment($id)
    {
        return DB::getInstance()->select('department', ['id', '=', $id])->fetchOne();
    }

    public static function getCourse($id)
    {
        return DB::getInstance()->select('courses', ['id', '=', $id])->fetchOne();
    }

    public static function getLevel($id)
    {
        return DB::getInstance()->select('level', ['id', '=', $id])->fetchOne();
    }

    public static function getSession($id)
    {
        return DB::getInstance()->select('school_session', ['id', '=', $id])->fetchOne();
    }
}