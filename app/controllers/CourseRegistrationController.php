<?php


namespace app\controllers;


use core\DB;
use core\middlewares\Auth;
use core\middlewares\Flash;
use core\middlewares\Redirect;
use core\Request;

class CourseRegistrationController extends \core\Controller
{
    use BasicSettings;
    public function __construct()
    {
        $this->setLayout('dashboard');
        $this->session = $this->getSession();
        Auth::isLoggedIn();
        if(!Auth::isStudent(true) AND !Auth::isAdmin(true))
        {
            return Redirect::to('/logout');
        }
    }

    public function viewCourses(Request $request, $user = null)
    {
        $user = (!is_null($user))? Auth::user($user) : Auth::user();
        $title = "Portal || Course Registration";
        $session = $this->session;
        $courses = DB::getInstance()->select('courses', ['semester', '=', $this->session->semester_code, 'level', '=', Auth::user()->level])->fetch();
        $sql = "SELECT * FROM course_reg WHERE user_id = ? AND faculty_id = ? AND department_id = ? AND level_id = ? AND semester_id = ? AND session_id = ? AND status = ?";
        $param = [
            $user->id,
            $user->faculty,
            $user->department,
            $user->level,
            $session->semester_code,
            $session->id,
            1
        ];
        $creg = DB::getInstance()->query($sql, $param)->fetch();
        return $this->view('course.register', compact('title', 'courses', 'session', 'creg', 'user'));
    }

    public function storeCourses(Request $request, $user = null, $redirect = null)
    {
        $user = (isset($user))? Auth::user($user) : Auth::user();
        $request = $request->data();

        foreach ($request as $key => $value)
        {
            $data = [
                'course_id'=>$key,
                'user_id'=>$user->id,
                'faculty_id'=>$user->faculty,
                'department_id'=>$user->department,
                'level_id'=>$user->level,
                'semester_id'=>$this->session->semester_code,
                'session_id'=>$this->session->id
            ];

            /**
             * first is to delete all inserted data already
             */
            $sql = "DELETE FROM course_reg WHERE course_id = ? AND user_id = ? AND faculty_id = ? AND department_id = ? AND level_id = ? AND semester_id = ? AND session_id = ?";
            $param = [
                $key,
                $user->id,
                $user->faculty,
                $user->department,
                $user->level,
                $this->session->semester_code,
                $this->session->id
            ];

            DB::getInstance()->query($sql, $param);
            DB::getInstance()->insert('course_reg', $data);
        }

        Flash::set(['success', 'Operation successful']);
        return Redirect::to($redirect??'/portal/course:register');
    }
}