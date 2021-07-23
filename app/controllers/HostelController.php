<?php


namespace app\controllers;


use core\Controller;
use core\DB;
use core\middlewares\Auth;
use core\middlewares\Flash;
use core\Request;

class HostelController extends Controller
{
    use BasicSettings;
    public function __construct()
    {
        $this->setLayout('dashboard');
        $this->session = $this->getSession();
    }

    public function generate(Request $request)
    {
        $user = Auth::user();
        /**
         * check if the student already has an invoice generated
         * if yes inform him about it and show the invoice
         * else go ahead and generate new invoice for the student
         */
        $title = "HOSTEL INVOICE";
        $detail = $this->session->name. " HOSTEL INVOICE FOR <b> ". Auth::user()->reg_no. " </b>";
        $type = 'HOSTEL';
        $amount = $this->schoolDecision()->hostel;

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
        return $this->view('hostel.view', compact('data', 'title'));
    }
}