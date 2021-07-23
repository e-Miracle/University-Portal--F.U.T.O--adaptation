<?php


namespace app\controllers;


use core\Controller;
use core\DB;

class PayController extends Controller
{
    public static function generateTransactionIdAndRecordPurpose($id, string $type, string $purpose, int $amount, $channel = 'PAYSTACK')
    {
        //first generate a reference id
        $ref_id = bin2hex(random_bytes(mt_rand(10,15)));

        //check to make sure the value does not exist already
        $check = DB::getInstance()->select('transaction_ref', ['reference', '=', $ref_id]);

        if ($check->count()) {
            //regenerate reference id
            $ref_id = bin2hex(random_bytes(mt_rand(10,15)));
        }

        $add = DB::getInstance()->insert('invoice', ['user_id' => $id, 'type'=>$type, 'reference' => strtoupper($ref_id), 'detail' => $purpose, 'channel' => $channel, 'amount'=>$amount]);

        //return the refernce_id
        if ($add) {
            return $ref_id;
        }
        return false;
    }
}