<?php


namespace app\controllers;


use core\Controller;
use core\DB;
use core\middlewares\Auth;
use core\middlewares\Flash;
use core\middlewares\Redirect;
use core\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        if (!Auth::guest())
        {
            /**
             * if it's not a guest please send him to the dashboard
             */
            Redirect::to('/portal');
        }

        $this->setLayout('sisu');
    }

    public function viewLoginForm()
    {
        $title = 'Login';
        return $this->view('portal.auth.login', compact('title'));
    }

    public function logUserIn(Request $request)
    {
        if($request->validate([
            'username'=>'required',
            'password'=>'required',
        ]))
        {
            /**
             * the request is clean we can proceed to log user in
             */
            /**
             * first thing first will be to check our database for a related user
             */

            $user = DB::getInstance()->select('users', ['email', '=', $request->data()->username]);

            if ($user->count())
            {
                $user = $user->fetchOne();
                /**
                 * here we are sure the user email exist in the database, next thing is to verify if password match
                 * the given password then, we proceed to authenticate him with a session
                 */
                if (password_verify($request->data()->password, $user->password))
                {
                    if (Auth::set($user->id))
                    {
                        Flash::set(['success', 'Login Successful']);
                        /*if (Auth::user()->type == 'student')
                        {
                            $url = '/portal';
                        }
                        if (Auth::user()->type == 'lecturer')
                        {
                            $url = '/lecturer';
                        }*/
                        return Redirect::to('/portal');
                    }
                }
            }
        }
        Flash::set(['danger', 'Invalid Credentials']);
        return Redirect::to('/login');
    }
}