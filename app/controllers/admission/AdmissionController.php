<?php


namespace app\controllers\admission;


use app\controllers\BasicSettings;
use app\controllers\PayController;
use core\DB;
use core\middlewares\Auth;
use core\middlewares\Flash;
use core\middlewares\Redirect;
use core\Request;
use core\View;

class AdmissionController extends \core\Controller
{
    use BasicSettings;

    public function __construct()
    {
        $this->setLayout('sisu');
        $this->session = $this->getSession();
    }

    public function statusView()
    {
        $title = 'Admission || check status';
        return $this->view('admission.status', compact('title'));
    }

    public function checkStatus(Request $request)
    {
        /**
         * check if the number exist in the database, then check if he has been given
         * admission
         */

        $num = DB::getInstance()->select('pre_admission', ['jamb_reg', '=', $request->data()->jamb,
        'session', '=', $this->session->id]);

        if ($num->count())
        {
            $num = $num->fetchOne();

            if ($num->status == 1)
            {
                Flash::set(['success', 'Congratulations '. $num->jamb_reg]);
                $faculty = DB::getInstance()->select('faculty', ['id', '=', $num->faculty])->fetchOne();
                $department = DB::getInstance()->select('department', ['id', '=', $num->department])->fetchOne();
                $session = $this->session->name;
                $title = "Admission || Notification";
                return $this->view('admission.notify', compact('num', 'faculty', 'department', 'session', 'title'));
            }
            else
            {
                Flash::set(['warning', 'Sorry! you;ve not been offered admission yet, try again later.']);
            }
        }
        else
        {
            Flash::set(['warning', 'Invalid Jamb Registration Number']);
        }
        return Redirect::to('/admission/check_status');
    }

    public function generateRemitaReferenceNumber(Request $request)
    {
        //$this->setLayout('dashboard');
        $user = $request->data();
        /**
         * check if the student already has an invoice generated
         * if yes inform him about it and show the invoice
         * else go ahead and generate new invoice for the student
         */
        $title = "HOSTEL INVOICE";
        $detail = $this->session->name. " ACCEPTANCE FEE INVOICE FOR <b> ". $user->jamb. " </b>";
        $type = 'ACCEPTANCE';
        $amount = $this->schoolDecision()->acceptance;

        $count = DB::getInstance()->select('invoice', ['user_id', '=', $user->jamb, 'detail', '=', $detail]);
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
                $invoice = PayController::generateTransactionIdAndRecordPurpose($user->jamb, $type, $detail, $amount);

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
        return $this->view('admission.view', compact('data', 'title'));
    }
}