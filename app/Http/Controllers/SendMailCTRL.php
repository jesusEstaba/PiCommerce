<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Swift_Validate;

class SendMailCTRL extends Controller
{
    public static function sendNow($vista, $dataEmail, $userEmail, $subject)
    {
        if (in_array(env('APP_ENV', 'development'), ['development', 'local'])) {
            return 0;
        }
        
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

    public static function sendToAdmins($emailList, $title, $template, $payload) {
        if (in_array(env('APP_ENV', 'development'), ['development', 'local'])) {
            return 0;
        }

        Mail::send($template, $payload, function ($msj) use ($emailList, $title) {
            $msj->subject($title);
            $msj->from(env('MAIL_ADDRESS'), env('MAIL_NAME'));
            foreach ($emailList as $array => $admin) {
                $msj->to($admin->email);
            }
        });
    }

    public function test($email)
    {
		$error = SendMailCTRL::sendNow('welcome', ['data'=>'data'], $email, 'Test Mail');
		if ($error===0) {
			return "enviado :)";
		} else {
			return "hubo un error";
		}
    }
}
