<?php


namespace app\controllers\admin;


use app\controllers\BasicSettings;
use core\DB;
use core\middlewares\Auth;
use core\middlewares\Flash;
use core\middlewares\Redirect;
use core\Request;

class DepartmentController extends \core\Controller
{
    use BasicSettings;
    public function __construct()
    {
        Auth::isLoggedIn();
        //Auth::isAdmin();
    }
    use AdminSettings;

    public function showAddFaculty()
    {
        $title = "Admin || Add Department";
        $faculty = DB::getInstance()->select('faculty', ['status', '=', 1])->fetch();
        return $this->view('admin.addDepartment', compact('title', 'faculty'));
    }

    public function submitAddFaculty(Request $request)
    {
        if($validate = $request->validate([
            'faculty'=>'required',
            'name'=>'required',
            'abbrev'=>'required',
        ]))
        {
            $request = $request->data();
            $data = [
                'faculty'=>$request->faculty,
                'name'=>$request->name,
                'abbrev'=>$request->abbrev
            ];

            if(DB::getInstance()->insert("department", $data)):
                Flash::set(['success', 'Department added successfully']);
            else:
                Flash::set(['error', 'Error in adding department']);
            endif;
        }
        return Redirect::to('/admin/add/department');
    }
}