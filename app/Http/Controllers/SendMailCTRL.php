<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use Mail;


class SendMailCTRL extends Controller
{
    
public function send_mail(){
	$variables_correo = ['me_le_ponen'=>'gas del bueno'];

			Mail::send('template_mail.prueba', $variables_correo, function($msj)
			{
            	$msj->subject('Order');
            	$msj->from(env('MAIL_ADDRESS'), env('MAIL_NAME'));
            	$msj->to('jeec.estaba@gmail.com');
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
