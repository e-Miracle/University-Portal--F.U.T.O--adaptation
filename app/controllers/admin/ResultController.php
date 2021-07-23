<?php


namespace app\controllers\admin;


use core\DB;
use core\middlewares\Auth;
use core\middlewares\Flash;
use core\middlewares\Redirect;
use core\Request;

class ResultController extends \core\Controller
{
    public function viewResult(Request $request)
    {
        if ($request->isGet())
        {
            return (new \app\controllers\ResultController)->viewResult(true);
        }

        if ($request->isPost())
        {
            $user = DB::getInstance()->select('users', ['reg_no', '=', $request->data()->reg_no]);
            if ($user->count())
            {
                return (new \app\controllers\ResultController)->showResult($request, $user->fetchOne()->id, true);
            }

            Flash::set(['danger', 'Invalid student reg no']);
            Redirect::to("/admin/result/search");
        }
    }
}