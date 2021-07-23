<?php


namespace app\controllers;


use core\DB;

trait BasicSettings
{
    /**
     * @var mixed
     */
    protected $session, $AllSession, $AllLevel;

    /**
     * first thing to do here is to set the active session
     */

    public function getSession()
    {
        return $this->session = DB::getInstance()->select('school_session', ['status', '=', 1])->fetchOne();
    }

    public function getAllSession()
    {
        return $this->AllSession = DB::getInstance()->query("SELECT * FROM school_session")->fetch();
    }

    public static function schoolDecision()
    {
        return DB::getInstance()->select('school_decision', ['status', '=', 1])->fetchOne();
    }

    public function getAllLevel()
    {
        return $this->AllLevel = DB::getInstance()->query("SELECT * FROM level")->fetch();
    }
}