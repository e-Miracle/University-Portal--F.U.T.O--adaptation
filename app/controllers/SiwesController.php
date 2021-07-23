<?php


namespace app\controllers;


use core\DB;
use core\middlewares\Auth;
use core\middlewares\Flash;
use core\Request;

class SiwesController extends \core\Controller
{
    use BasicSettings;
    public function __construct()
    {
        $this->session = $this->getSession();
        Auth::isLoggedIn();
        Auth::isStudent();
        $this->setLayout('dashboard');
    }

    public function generate()
    {
        $user = Auth::user();
        $title = "Portal || SIWES";
        $faculty = DB::getInstance()->select('faculty', ['id', '=', $user->faculty])->fetchOne();
        $department = DB::getInstance()->select('department', ['id', '=', $user->department])->fetchOne();
        return $this->view('siwes.siwes', compact('title', 'faculty', 'department'));
    }

    public function generateInvoice(Request $request)
    {
        $user = Auth::user();
        /**
         * check if the student already has an invoice generated
         * if yes inform him about it and show the invoice
         * else go ahead and generate new invoice for the student
         */
        $title = "SIWES INVOICE";
        $detail = $request->data()->level. " SIWES INVOICE FOR <b> ". Auth::user()->reg_no. " </b>";
        $type = 'SIWES';
        $amount = $this->schoolDecision()->siwes;

        $count = DB::getInstance()->select('invoice', ['user_id', '=', $user->id, 'detail', '=', $detail]);
        if ($count->count())
        {
            $db = true;
        }
        else
        {
            $db = false;
        }
        switch ($db)
        {
            case true:
                /**
                 * the student has an invoice already
                 */
                Flash::set(['warning', 'Invoice found for the above stated purpose']);
                $data = $count->fetchOne();
                break;
            default:
                /**
                 * student has no invoice
                 */
                $invoice = PayController::generateTransactionIdAndRecordPurpose($user->id, $type, $detail, $amount);

                /*$d = [
                    'user_id'=>$user->id,
                    'type'=>$type,
                    'reference'=>$invoice,
                    'detail'=>$detail,
                ];

                $data = DB::getInstance()->insert('invoice', $d);
                $last_id = DB::getInstance()->lastID();*/
                /**
                 * now we proceed to get the last inserted data
                 */
                if ($invoice)
                {
                    $data = DB::getInstance()->select('invoice', ['reference', '=', $invoice])->fetchOne();
                }
                break;
        }

        /**
         * return view with the data
         */
        return $this->view('siwes.view', compact('data', 'title'));
    }
}