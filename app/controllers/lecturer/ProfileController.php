<?php


namespace app\controllers\lecturer;


use app\controllers\AjaxController;
use core\Controller;
use core\DB;
use core\middlewares\Auth;
use core\middlewares\File;
use core\middlewares\Flash;
use core\middlewares\Mail;
use core\middlewares\Redirect;
use core\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->setLayout('dashboard');
        Auth::isLoggedIn();
        if(!Auth::isLecturer(true) AND !Auth::isAdmin(true))
        {
            return Redirect::to('/logout');
        }
    }

    public function viewProfile()
    {
        $user = Auth::user();
        $title = "Lecturer || Profile";
        $department = DB::getInstance()->select('department', ['id', '=', $user->department])->fetchOne();
        $faculty = DB::getInstance()->select('faculty', ['id', '=', $user->faculty])->fetchOne();
        return $this->view('lecturer.viewProfile', compact('title', 'department', 'faculty'));
    }

    public function editProfile($user = null)
    {
        $title = "Lecturer || Edit";
        $user = (!is_null($user)) ? Auth::user($user) : Auth::user();
        $faculty = DB::getInstance()->select('faculty', ['id', '=', $user->faculty])->fetchOne();
        $state = AjaxController::getState(1);
        $department = DB::getInstance()->select('department', ['id', '=', $user->department])->fetchOne();
        return $this->view('lecturer.editProfile', compact('title', 'user', 'faculty', 'department', 'state'));
    }

    public function submitEditedProfile(Request $request, $user = null, $redirect = null)
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
            'blood_group'=>'required',
            'genotype'=>'required',
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
                'phone1'=>$request->phone,
                'nok_name'=>$request->nokname,
                'nok_email'=>$request->nokemail,
                'nok_phone'=>$request->nokphone,
                'nok_address'=>$request->nokaddress,
                'nok_relationship'=>$request->nokrel,
                'medical_record'=>$request->med_record
            ];

            $user = (!is_null($user))? Auth::user($user) : Auth::user();
            $where = [
                'id'=>$user->id
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
                    DB::getInstance()->update('users', ['photo'=>$img], ['id'=>$user->id]);
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
        return Redirect::to($redirect??'/lecturer/profile/edit');
    }

    public function changePassword()
    {
        $title = "Lecturer || Change password";
        return $this->view('portal.auth.changep', compact('title'));
    }

    public function submitPassword(Request $request)
    {
        $user = Auth::user();
        if($request->validate([
            'npass'=>'required',
            'opass'=>'required',
        ]))
        {
            $request = $request->data();

            if (password_verify($request->opass, Auth::user()->password))
            {
                /**
                 * send the user an activation code and return the page for the activation code verify
                 */
                try {
                    $hash = bin2hex(random_bytes(5));
                } catch (\Exception $e) {
                    $hash = mt_rand(6, 10);
                }

                $data = [
                    'user_id'=>$user->id,
                    'hash'=>$hash,
                    'p_hash'=>password_hash($request->npass, PASSWORD_DEFAULT, ['cost'=>12])
                ];
                if (DB::getInstance()->insert('password_reset', $data))
                {
                    $title = 'CONFIRM PIN';
                    $url = "/lecturer/password/change/n";
                    $message = [
                        'subject'=>"CHANGE PASSWORD",
                        'message'=>"\"USE THIS TO RESET YOUR PASSWORD -> {$hash}\"",
                    ];
                    try {
                        Mail::send($user->email, $message);
                    } catch (\Exception $e) {
                    }
                    Flash::set(['success', 'Please check your mail for an acitivation code']);
                    return $this->view('portal.auth.vchangep', compact('title', 'url'));
                }
            }

            Flash::set(['danger', 'Password do not match old password']);
            $title = "Lecturer || Change password";
            return $this->view('portal.auth.changep', compact('title'));
        }
    }

    public function updatePassword(Request $request)
    {
        $s = DB::getInstance()->select('password_reset', ['user_id', '=', Auth::user()->id, 'hash', '=', $request->data()->otp]);
        if ($s->count())
        {
            $s = $s->fetchOne();
            /**
             * change the password, then update password reset table
             */
            DB::getInstance()->update('users', ['password'=>$s->p_hash], ['id'=>Auth::user()->id]);

            $set = [
                'p_hash'=>'DONE',
                'status'=>'1'
            ];

            $where = [
                'user_id'=>Auth::user()->id
            ];

            DB::getInstance()->update('password_reset', $set, $where);

            Flash::set(['success', 'Password reset successful']);
            return Redirect::to('/logout');
        }

        Flash::set(['danger', 'Invalid OTP provided']);
        $title = "Portal || Change password";
        $url = "/lecturer/password/change/n";
        return $this->view('portal.auth.vchangep', compact('title', 'url'));
    }
}