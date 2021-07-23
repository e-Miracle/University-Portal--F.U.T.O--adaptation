<?php


namespace app\controllers\admin;


use core\DB;

trait AdminSettings
{
    public function allLecturerRole()
    {
        return DB::getInstance()->select('lecturer_role', ['status', '=', 1])->fetch();
    }

    public function getAllLecturers()
    {
        return DB::getInstance()->select('users', ['type', '=', 'lecturer'])->fetch();
    }
}