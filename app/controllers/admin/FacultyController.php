<?php


namespace app\controllers\admin;


use app\controllers\BasicSettings;
use core\DB;
use core\middlewares\Auth;
use core\middlewares\Flash;
use core\middlewares\Redirect;
use core\Request;

class FacultyController extends \core\Controller
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
        $title = "Admin || Add Faculty";
        return $this->view('admin.addFaculty', compact('title'));
    }

    public function submitAddFaculty(Request $request)
    {
        if($validate = $request->validate([
            'name'=>'required',
            'abbrev'=>'required',
        ]))
        {
            $request = $request->data();
            $data = [
                'name'=>$request->name,
                'abbrev'=>$request->abbrev
            ];

            if(DB::getInstance()->insert("faculty", $data)):
                Flash::set(['success', 'Faculty added successfully']);
            else:
                Flash::set(['error', 'Error in adding faculty']);
            endif;
        }
        return Redirect::to('/admin/add/faculty');
    }
}