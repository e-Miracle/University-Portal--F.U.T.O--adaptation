<?php


namespace app\controllers;


use core\Controller;
use core\DB;
use core\middlewares\Auth;
use core\middlewares\Redirect;
use core\Request;

class ResultController extends Controller
{
    use BasicSettings;
    public function __construct()
    {
        $this->setLayout('dashboard');
        Auth::isLoggedIn();
        if(!Auth::isStudent(true) AND !Auth::isAdmin(true))
        {
            return Redirect::to('/logout');
        }
    }

    public function viewResult($addedRegNo = false)
    {
        $title = 'Result || View';
        $session = DB::getInstance()->select('school_session', ['status', '!=', 2])->fetch();
        $level = DB::getInstance()->query("SELECT * FROM level")->fetch();
        return $this->view('result.view', compact('title', 'session', 'level', 'addedRegNo'));
    }

    public function showResult(Request $request, $user = null, $addedRegNo = false)
    {
        $title = "Result || View";
        $session = $this->getAllSession();
        $sess = DB::getInstance()->select('school_session', ['id', '=', $request->data()->session])->fetchOne();
        $level = $this->getAllLevel();
        $lev = $request->data()->level;
        $department = DB::getInstance()->select('department', ['id', '=', Auth::user()->department])->fetchOne();
        $user = Auth::user($user) ?? Auth::user();
        $sql = "SELECT 
                courses.title,
                courses.code,
                courses.load,
                results.score,
                results.grade
                FROM ((results
                 INNER JOIN courses ON courses.id =  results.user_id)
                 INNER JOIN course_reg ON results.user_id = course_reg.user_id 
                    AND results.course_reg_id = course_reg.course_id 
                    AND results.level_id = course_reg.level_id 
                    AND results.session_id = course_reg.session_id)
                    WHERE results.user_id = ? AND results.level_id = ? AND results.session_id  = ?";
        $param = [
            $user->id,
            $request->data()->level,
            $request->data()->session,
        ];
        $results = DB::getInstance()->query($sql, $param)->fetch();
        return $this->view('result.view', compact('title', 'session', 'level', 'department', 'results', 'sess', 'lev', 'user', 'addedRegNo'));
    }
}