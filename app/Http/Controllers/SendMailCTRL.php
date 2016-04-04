<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use Mail;


class SendMailCTRL extends Controller
{
    /**
     * [send_mail description]
     * @return [type] [description]
     */
    public function send_mail()
    {
    	       
        $variables_correo = ['me_le_ponen'=>'gas del bueno'];

        $correos = ['jeec.estaba@gmail.com', 'estaba_jesus@hotmail.com'];

        Mail::send('template_mail.prueba', $variables_correo, function($msj) use ($correos)
        {
            $msj->subject('Order');
            $msj->from(env('MAIL_ADDRESS'), env('MAIL_NAME'));
            
            foreach($correos as $email)
            {
                $message->to($email);
            }
        });

        if(count(Mail::failures()))
        {
            $errors = 'Failed to send password reset email, please try again.';
        }
        
        if( !isset($errors) )
            $errors = "todo correcto <a href='cart'>Cart</a>";

        return $errors;
    }
}
