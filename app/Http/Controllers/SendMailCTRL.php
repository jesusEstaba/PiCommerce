<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use Mail;
use Swift_Validate;

class SendMailCTRL extends Controller
{
    public static function sendNow($vista, $dataEmail, $userEmail, $subject)
    {
        if (Swift_Validate::email($userEmail)) {
            Mail::send($vista, $dataEmail, function ($msj) use ($userEmail, $subject) {
                $msj->subject($subject);
                $msj->from(env('MAIL_ADDRESS'), env('MAIL_NAME'));
                $msj->to($userEmail);
            });

            $error = count(Mail::failures());
        } else {
            $error = 1;
        }

        return $error;
    }
}
