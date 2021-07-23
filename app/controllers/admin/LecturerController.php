<?php


namespace app\controllers\admin;


use app\controllers\lecturer\ProfileController;
use core\DB;
use core\middlewares\Auth;
use core\middlewares\Flash;
use core\middlewares\Redirect;
use core\Request;

class LecturerController extends \core\Controller
{
    public function __construct()
    {
        Auth::isLoggedIn();
        Auth::isAdmin();
    }

    use AdminSettings;

    public function viewLecturers()
    {
        $title = "Lecturer list";
        $lecturers = $this->getAllLecturers();
        $roles = $this->allLecturerRole();
        return $this->view('admin.lecturerList', compact('title', 'lecturers', 'roles'));
    }

    public function viewLecturer(Request $request)
    {
        $user = Auth::user($request->data()->lecturer);
        $edit = "/admin/edit/student?student=".$request->data()->lecturer;
        $title = "Admin || View Lecturer";
        $department = DB::getInstance()->select('department', ['id', '=', $user->department])->fetchOne();
        return $this->view('portal.profile_view', compact('title', 'department', 'user', 'edit'));
    }

    public function deleteLecturer(Request $request)
    {
        if (DB::getInstance()->delete('users', ['id', '=', $request->data()->lecturer]))
        {
            Flash::set(['success', 'Student removed successfully']);
        }else
        {
            Flash::set(['error', 'Error in removing student']);
        }
        return Redirect::to('/admin/lecturer/list');
    }

    public function editLecturer(Request $request)
    {
        $url = "/admin/lecturer/list";
        if ($request->isPost())
        {
            return (new ProfileController)->submitEditedProfile($request, $request->data()->lecturer, $url);
        }
        return (new ProfileController)->editProfile($request->data()->lecturer);
    }
}