<?php


namespace app\controllers\lecturer;


use core\DB;
use core\middlewares\Auth;

trait LecturerSetting
{

    public function lecturerRole()
    {
        return DB::getInstance()->select('lecturer_role', ['user_id', '=', Auth::user()->id])->fetch();
    }
}