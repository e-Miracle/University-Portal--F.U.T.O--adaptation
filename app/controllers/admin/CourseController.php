<?php


namespace app\controllers\admin;


use core\DB;
use core\middlewares\Auth;
use core\middlewares\Flash;
use core\middlewares\Redirect;
use core\Request;

class CourseController extends \core\Controller
{
    public function __construct()
    {
        Auth::isLoggedIn();
        Auth::isAdmin();
    }

    public function editCourse(Request $request)
    {
        $course = null;
        ($request->isGet())? $id = $request->data()->course : $id = null;
        if ($request->isPost())
        {
            if ($request->validate([
                'title'=>'required',
                'code'=>'required',
                'load'=>'required',
                'level'=>'required',
                'semester'=>'required',
                'type'=>'required'
            ]))
            {
                $request = $request->data();
                $data = [
                    'title'=>$request->title,
                    'code'=>$request->code,
                    'load'=>$request->load,
                    'semester'=>$request->semester,
                    'type'=>$request->type,
                    'level'=>$request->level
                ];

                if(DB::getInstance()->insert('courses', $data))
                {
                    Flash::set(['success', 'Course added successfully']);
                }
                Redirect::to("/admin/course/view:all");
            }
        }
        else
        {
            $course = DB::getInstance()->select('courses', ['id', '=', $request->data()->course])->fetchOne();
        }
        $title = "Add Course";
        $top = "Add Course";
        return $this->view('admin.addCourse', compact('title', 'top', 'id', 'course'));
    }

    public function deleteCourse(Request $request)
    {
        $sql = "DELETE FROM courses WHERE id = ?";
        if (DB::getInstance()->query($sql, [1]))
        {
            Flash::set(['success', 'Course deleted successfully']);
        }
        Redirect::to("/admin/course/view:all");
    }

    public function addCourse(Request $request)
    {
        $id = null;
        if ($request->isPost())
        {
            if ($request->validate([
                'title'=>'required',
                'code'=>'required',
                'load'=>'required',
                'level'=>'required',
                'semester'=>'required',
                'type'=>'required'
            ]))
            {
                $request = $request->data();
                $data = [
                    'title'=>$request->title,
                    'code'=>$request->code,
                    'load'=>$request->load,
                    'semester'=>$request->semester,
                    'type'=>$request->type,
                    'level'=>$request->level
                ];

                if(DB::getInstance()->update('courses', $data, ['id'=>$request->id]))
                {
                    Flash::set(['success', 'Course updated successfully']);
                }
                Redirect::to("/admin/course/view:all");
            }
        }
        $title = "Edit Course";
        $top = "Edit Course";
        return $this->view('admin.addCourse', compact('title', 'top', $id));
    }

    public function viewCourses()
    {
        $title = "Course List";
        $courses = DB::getInstance()->select('courses', ['id', '!=', 0])->fetch();
        return $this->view('admin.viewCourses', compact('title', 'courses'));
    }
}