<?php


namespace app\controllers\admin;


use app\controllers\AjaxController;
use app\controllers\BasicSettings;
use app\controllers\CourseRegistrationController;
use core\DB;
use core\middlewares\Auth;
use core\middlewares\File;
use core\middlewares\Flash;
use core\middlewares\Redirect;
use core\Request;

class StudentController extends \core\Controller
{
    use BasicSettings;
    public function __construct()
    {
        Auth::isLoggedIn();
        //Auth::isAdmin();
    }
    use AdminSettings;

    public function viewStudentList(Request $request)
    {
        if ($request->isPost())
        {
            $is_set = true;
            $students = DB::getInstance()->select('users', ['type', '=', 'student', 'level', '=', $request->data()->level])->fetch();
        }else
        {
            $is_set = false;
            $students = [];
        }
        $title = "Student List";
        return $this->view('admin.studentList', compact('title', 'students', 'is_set'));
    }

    public function editStudent(Request $request)
    {
        $title = "Admin || Edit STudent";
        $user = Auth::user($request->data()->student);
        $faculty = DB::getInstance()->select('faculty', ['id', '=', $user->faculty])->fetchOne();
        $state = AjaxController::getState(1);
        $department = DB::getInstance()->select('department', ['id', '=', $user->department])->fetchOne();
        return $this->view('portal.profile_edit', compact('title', 'user', 'faculty', 'department', 'state'));
    }

    public function submitEditStudent(Request $request)
    {
        if($validate = $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'sex'=>'required',
            'dob'=>'required',
            'rel'=>'required',
            'country'=>'required',
            'state'=>'required',
            'lga'=>'required',
            'res_address'=>'required',
            'pam_address'=>'required',
            'faculty'=>'required',
            'department'=>'required',
            'level'=>'required',
            'blood_group'=>'required',
            'genotype'=>'required',
            'sname'=>'required',
            'srel'=>'required',
            'semail'=>'required',
            'sphone'=>'required',
            'saddress'=>'required',
            'nokname'=>'required',
            'nokrel'=>'required',
            'nokemail'=>'required',
            'nokphone'=>'required',
            'nokaddress'=>'required'
        ]))
        {
            /**
             * go ahead and update the database
             */
            $request = $request->data();
            $field =[
                'fname'=>$request->firstname,
                'lname'=>$request->lastname,
                'mname'=>$request->middlename,
                'email'=>$request->email,
                'sex'=>$request->sex,
                'dob'=>$request->dob,
                'address1'=>$request->res_address,
                'address2'=>$request->pam_address,
                'nationality'=>$request->country,
                'state'=>$request->state,
                'local_government'=>$request->lga,
                'blood_group'=>$request->blood_group,
                'genotype'=>$request->genotype,
                'faculty'=>$request->faculty,
                'department'=>$request->dept,
                'level'=>$request->level,
                'phone1'=>$request->phone,
                'sponsor_name'=>$request->sname,
                'sponsor_email'=>$request->semail,
                'sponsor_phone'=>$request->sphone,
                'sponsor_address'=>$request->saddress,
                'sponsor_relationship'=>$request->srel,
                'nok_name'=>$request->nokname,
                'nok_email'=>$request->nokemail,
                'nok_phone'=>$request->nokphone,
                'nok_address'=>$request->nokaddress,
                'nok_relationship'=>$request->nokrel,
                'medical_record'=>$request->med_record
            ];

            $where = [
                'id'=>$request->id
            ];

            DB::getInstance()->update('users', $field, $where);

            /**
             * after the insertions, check if there is file to upload
             */

            if (isset($_FILES['userfile']) && $_FILES['userfile']['size'] != 0)
            {
                $check = [
                    'max_size'=>'5',
                    'type'=>['jpeg', 'jpg'],
                ];

                $file = new File($_FILES, $check);
                if ($img = $file->upload())
                {
                    DB::getInstance()->update('users', ['photo'=>$img], ['id'=>$request->id]);
                }
                else
                {
                    Flash::set(['warning', $file->errors()]);
                }
            }
            Flash::set(['success', 'Update successful']);
        }
        else
        {
            Flash::set(['warning', $validate[0]]);
        }
        return Redirect::to('/admin/student/list');
    }

    public function viewStudent(Request $request)
    {
        $user = Auth::user($request->data()->student);
        $edit = "/admin/edit/student?student=".$request->data()->student;
        $title = "Admin || View Student";
        $department = DB::getInstance()->select('department', ['id', '=', $user->department])->fetchOne();
        return $this->view('portal.profile_view', compact('title', 'department', 'user', 'edit'));
    }

    public function showId(Request $request)
    {
        $this->setLayout('blank');
        $user = Auth::user($request->data()->student);
        $title = "Student || ID card";
        return $this->view('admin.idCard', compact('title', 'user'));
    }

    public function deleteStudent(Request $request)
    {
        if (DB::getInstance()->delete('users', ['id', '=', $request->data()->student]))
        {
            Flash::set(['success', 'Student removed successfully']);
        }else
        {
            Flash::set(['error', 'Error in removing student']);
        }
        return Redirect::to('/admin/student/list');
    }

    public function courseReg(Request $request)
    {
        return (new CourseRegistrationController)->viewCourses($request->data()->student);
    }

    public function courseRegAdd(Request $request)
    {
        $user = $request->data()->id;
        $reidect = "/admin/register_course/student?student=".$user;
        return (new CourseRegistrationController)->storeCourses($request, $user, $reidect);
    }

    public function addStudent()
    {
        $title = "Admin || Add Student";
        $faculty = DB::getInstance()->select('faculty', ['status', '=', 1])->fetch();
        $department = DB::getInstance()->select('department', ['status', '=', 1])->fetch();
        $level = DB::getInstance()->select('level', ['id', '!=', 0])->fetch();
        return $this->view('admin.addStudent', compact('title', "faculty", "department", "level"));
    }

    public function submitAddStudent(Request $request)
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
            'level'=>'required',
            'reg'=>'required',
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
                'reg_no'=>$request->reg,
                'password'=>password_hash($request->reg, PASSWORD_DEFAULT),
                'address1'=>'NULL',
                'address2'=>'NULL',
                'nationality'=>'NULL',
                'state'=>'NULL',
                'local_government'=>'NULL',
                'blood_group'=>'NULL',
                'genotype'=>'NULL',
                'faculty'=>$request->faculty,
                'department'=>$request->department,
                'level'=>$request->level,
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
                Flash::set(['success', 'Student added successfully']);
            else:
                Flash::set(['error', 'Error in adding student']);
            endif;
        }

        return Redirect::to('/admin/add/student');
    }
}