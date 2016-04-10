<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use Auth;
use DB;
use Carbon\Carbon;
use Mail;
use Session;
use Input;

class ResetPasswordCTRL extends Controller
{
    public function changePass()
    {
        if (Session::has('token_reset_password') && Session::has('email_reset')) {
            DB::table('users')
                ->where('email', Session::get('email_reset'))
                ->update(['password'=>bcrypt(Input::get('pass'))]);

            DB::table('password_resets')
                ->where('token', Session::get('token_reset_password'))
                ->delete();

            return response()->json('Password Changed!');
        }
        return response()->json('Error Access');
    }


    public function tokenPass($token_pass = '')
    {

        $data = DB::table('password_resets')->where('token', $token_pass)->first();

        if ($data) {
            Session::put('email_reset', $data->email);
            Session::put('token_reset_password', $token_pass);

            return view('new_password');
        }

        return 'invalid token';
    }

    public function index($user_mail)
    {
        //$user_mail = Auth::user()->email;
        $day = Carbon::now();
        $token_reset = md5($user_mail . $day);

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

        Mail::send('mail_template.reset_password', $variables_correo, function ($msj) use ($user_mail) {
            $msj->subject('Reset Password');
            $msj->from(env('MAIL_ADDRESS'), env('MAIL_NAME'));
            $msj->to($user_mail);
        });

        if (count(Mail::failures())) {
            $errors = 'Failed to send password reset email, please try again.';
        }

        return $errors;
    }
}
