<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

namespace core\middlewares;


use core\Controller;

class Mail extends Controller
{
    public static function send(string $address, array $message, $reply = null)
    {
        if (!key_exists('subject', $message)){
            throw new \Exception('Please add a subject', 500);
        }

        if (!key_exists('message', $message)){
            throw new \Exception('Please add a body', 500);
        }

        $subject = $message['subject'];
        $message = self::renderTemplate($message);
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '.SENDER."\r\n".
        (empty($reply))? '': 'Reply-To: '.$reply."\r\n".
            'X-Mailer: PHP/' . phpversion();

        $email = strtolower($address);
        $sendMail = mail($email, $subject, $message, $headers, '-freturn@'.BASE_URL);

        $e=error_get_last();
        if($e['message']!==''){
            return $e;
        }

        return true;
    }

    private static function template()
    {
        ob_start();
        include_once BASE_URL."/views/mail/template/main.php";
        return ob_get_clean();
    }

    private static function renderTemplate(array $message)
    {
        $template = self::template();
        $find = ['{{title}}', '{{content}}'];
        $replace = [$message['subject'], $message['message']];

        return str_replace($find, $replace, $template);
    }
}