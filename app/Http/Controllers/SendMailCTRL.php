<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use Mail;


class SendMailCTRL extends Controller
{
    public static function sendNow($vista, $dataEmail, $userEmail, $subject)
    {
        Mail::send($vista, $dataEmail, function ($msj) use ($userEmail, $subject) {
            $msj->subject($subject);
            $msj->from(env('MAIL_ADDRESS'), env('MAIL_NAME'));
            $msj->to($userEmail);
        });

        return count(Mail::failures());
    }
}
