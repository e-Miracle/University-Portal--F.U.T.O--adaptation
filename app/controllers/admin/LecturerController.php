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

    public function addLecturer()
    {
        $title = "Admin || Add Lecturer";
        $faculty = DB::getInstance()->select('faculty', ['status', '=', 1])->fetch();
        $department = DB::getInstance()->select('department', ['status', '=', 1])->fetch();
        $level = DB::getInstance()->select('level', ['id', '!=', 0])->fetch();
        $course = DB::getInstance()->select('courses', ['id', '!=', 0])->fetch();
        return $this->view('admin.addLecturer', compact('title', "faculty", "department", "level", "course"));
    }

    public function submitAddLecturer(Request $request)
    {
        if($validate = $request->validate([
            'fname'=>'required',
            'lname'=>'required',
            'mname'=>'required',
            'email'=>'required',
            'sex'=>'required',
            'dob'=>'required',
            'faculty'=>'required',
            'department'=>'required',
        ]))
        {
            $request = $request->data();
            $data = [
                'fname'=>$request->fname,
                'lname'=>$request->lname,
                'mname'=>$request->mname,
                'email'=>$request->email,
                'sex'=>$request->sex,
                'dob'=>$request->dob,
                'password'=>password_hash($request->email, PASSWORD_DEFAULT),
                'type'=>"lecturer",
                'address1'=>'NULL',
                'address2'=>'NULL',
                'nationality'=>'NULL',
                'state'=>'NULL',
                'local_government'=>'NULL',
                'blood_group'=>'NULL',
                'genotype'=>'NULL',
                'faculty'=>$request->faculty,
                'department'=>$request->department,
                'phone1'=>'NULL',
                'sponsor_name'=>'NULL',
                'sponsor_email'=>'NULL',
                'sponsor_phone'=>'NULL',
                'sponsor_address'=>'NULL',
                'sponsor_relationship'=>'NULL',
                'nok_name'=>'NULL',
                'nok_email'=>'NULL',
                'nok_phone'=>'NULL',
                'nok_address'=>'NULL',
                'nok_relationship'=>'NULL',
                'medical_record'=>'NULL'
            ];

            if(DB::getInstance()->insert("users", $data)):
                /**
                 * lecturer has been added so we add lecturer role
                 */
                $id = DB::getInstance()->lastID();
                $data = [
                    'user_id'=>$id,
                    'faculty'=>$request->lfaculty,
                    "department"=>$request->ldepartment,
                    "level_id"=>$request->llevel,
                    "course_id"=>$request->course
                ];
                if (DB::getInstance()->insert("lecturer_role", $data)):
                    Flash::set(['success', 'Student added successfully']);
                endif;
            else:
                Flash::set(['error', 'Error in adding student']);
            endif;
        }

        return Redirect::to('/admin/add/student');
    }
}