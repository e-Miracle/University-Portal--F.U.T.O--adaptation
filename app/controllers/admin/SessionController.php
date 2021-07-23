<?php


namespace app\controllers\admin;


use core\Controller;
use core\DB;
use core\middlewares\Auth;
use core\middlewares\Flash;
use core\middlewares\Redirect;
use core\Request;

class SessionController extends Controller
{

    public function __construct()
    {
        Auth::isLoggedIn();
        Auth::isAdmin();
    }

    public function activateSession(Request $request)
    {
        if ($request->isGet() && isset($request->data()->session))
        {
            /**
             * first move is to disable all session
             * then we can proceed to update the main sessino
             */

            $sql = "UPDATE school_session SET status = ?";
            DB::getInstance()->query($sql, [0]);

            DB::getInstance()->update('school_session', ['status'=>'1'], ['id'=>$request->data()->session]);

            Flash::set(['success', 'Session updated successfully']);
        }
        return Redirect::to('/admin/session/view:all');
    }

    public function addSession(Request $request)
    {
        $title = "Add Session";
        if ($request->isPost())
        {
            $semester = [
                'FIRST SEMESTER'=>1,
                'SECOND SEMESTER'=>2
            ];
            foreach ($semester as $key=>$value)
            {
                $data = [
                    'name'=>$request->data()->session,
                    'semester'=>$key,
                    'semester_code'=>$value
                ];
                DB::getInstance()->insert('school_session', $data);
            }
            Flash::set(['success', 'Session added successfully']);
        }
        return $this->view('admin.addSession', compact('title'));
    }

    public function viewSessions()
    {
        $title = "Session List";
        $sessions = DB::getInstance()->select('school_session', ['status', '!=', 4])->fetch();
        return $this->view('admin.viewSessions', compact('title', 'sessions'));
    }

    public function deleteSession(Request $request)
    {
        Flash::set(['danger', 'An error occurred']);
        $sql = "DELETE FROM school_session WHERE id = ?";
        if (DB::getInstance()->query($sql, [$request->data()->session]))
        {
            Flash::set(['success', 'Session deleted successfully']);
        }
        return Redirect::to('/admin/session/view:all');
    }

    public function editSession(Request $request)
    {
        $title = "Session Edit";
        if ($request->isPost())
        {
            DB::getInstance()->update('school_session', ['name'=>$request->data()->session], ['id'=>$request->data()->id]);
            Flash::set(['success', 'Session updated successfully']);
            return Redirect::to('/admin/session/view:all');
        }
        $session = DB::getInstance()->select('school_session', ['id', '=', $request->data()->session])->fetchOne();
        return $this->view('admin.editSession', compact('title', 'session'));
    }
}