<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use Auth;
use DB;
use Carbon\Carbon;

class ResetPasswordCTRL extends Controller
{
    public function tokenPass($token_pass='')
	{

	    $data = DB::table('password_resets')->where('token', $token_pass)->first();

	    if($data)
	    {
			return 'password changed';
	    }

	    return 'invalid token';	
	}

	public function index($user_mail)
	{
		//$user_mail = Auth::user()->email;
	    $day = Carbon::now();
	    $token_reset = md5( $user_mail . $day  );

	    DB::table('password_resets')->where('email', $user_mail)->delete();

	    DB::table('password_resets')->insert([
	    	'email'=>$user_mail,
	    	'token'=> $token_reset,
	    	'created_at' => $day,
	    ]);

	    $config = DB::table('config')->first();

		$variables_correo = [
			'logo' => $config->logo,
		    'footer'=> $config->footer,
		    'title'=>'Reset Password',
		    'token_reset'=> $token_reset,
		];


		$errors = 'Mail Send';

		Mail::send('mail_template.reset_password', $variables_correo, function($msj) use ($user_mail)
        {
            $msj->subject('Order');
            $msj->from(env('MAIL_ADDRESS'), env('MAIL_NAME'));
            
            $msj->to($user_mail);
            
        });

        if(count(Mail::failures()))
        {
            $errors = 'Failed to send password reset email, please try again.';
        }

        return $errors;
	}
}
