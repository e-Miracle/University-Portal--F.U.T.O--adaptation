<?php


namespace app\controllers;


use core\Controller;
use core\DB;
use core\middlewares\Auth;
use core\middlewares\Flash;
use core\Request;

class SchoolFeeController extends Controller
{
    use BasicSettings;
    public function __construct()
    {
        $this->setLayout('dashboard');
        Auth::isLoggedIn();
        Auth::isStudent();
    }

    public function generateInvoice()
    {
        $h1 = "GENERATE SCHOOL FEE INVOICE ";
        $title = 'GENERATE INVOICE';
        $sql = "SELECT DISTINCT name FROM school_session";
        $all = DB::getInstance()->query($sql)->fetch();
        return $this->view('schoolfee.generate', compact('all', 'title', 'h1'));
    }

    public function showInvoice(Request $request)
    {
        /**
         * first thing to check is if the user has an already existing invoice
         * if yes, show him the invoice else generate a new invoice for him
         */

        $user = Auth::user();
        /**
         * check if the student already has an invoice generated
         * if yes inform him about it and show the invoice
         * else go ahead and generate new invoice for the student
         */
        $title = "HOSTEL INVOICE";
        $h1 = "GENERATE SCHOOL FEE INVOICE ";
        $detail = $request->data()->session. " SCHOOL FEE INVOICE FOR ". $request->data()->level. " LEVEL";
        $type = 'SCHOOL FEE';
        $amount = $this->schoolDecision()->school_fee;

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
        return $this->view('schoolfee.invoice', compact('data', 'title', 'h1'));
    }

    public function printReceipt(Request $request)
    {
        $title = "PRINT RECEIPT";
        $h1 = "PRINT SCHOOL FEE RECEIPT";
        $sql = "SELECT DISTINCT name FROM school_session";
        $all = DB::getInstance()->query($sql)->fetch();
        return $this->view('schoolfee.generate', compact('all', 'title', 'h1'));
    }

    public function showReceipt(Request $request)
    {
        $title = "SCHOOL FEE INVOICE";
        $detail = $request->data()->session. " SCHOOL FEE INVOICE FOR ". $request->data()->level. " LEVEL";
        $total = $this->schoolDecision()->school_fee;
        $break = DB::getInstance()->select('school_fee_breakdown', ['status', '=', 1])->fetch();

        /**
         * check if it has been paid for the invoice already
         */
        $sql = "SELECT * FROM invoice WHERE user_id = ? AND detail = ?";
        $param = [Auth::user()->id, $detail];
        $check = DB::getInstance()->query($sql, $param);
        if ($check->count() && $check->fetchOne()->status == 1)
        {
            $check = $check->fetchOne();
            return $this->view('schoolfee.receipt', compact('title', 'total', 'break'));
        }
        elseif ($check->count() && $check->fetchOne()->status == 0)
        {
            Flash::set(['warning', 'You have not paid for the year in question']);
        }
        else
        {
            Flash::set(['warning', 'No invoice generated for the year in question']);
        }

        $title = "PRINT RECEIPT";
        $h1 = "PRINT SCHOOL FEE RECEIPT";
        $sql = "SELECT DISTINCT name FROM school_session";
        $all = DB::getInstance()->query($sql)->fetch();
        return $this->view('schoolfee.generate', compact('all', 'title', 'h1'));
    }
}