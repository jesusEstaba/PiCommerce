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
use Session;
use Input;
use Pizza\Config;

class ResetPasswordCTRL extends Controller
{
    /**
     * @param  [type]
     * @return [type]
     */
    public function index($userMail)
    {
        $isEmailExist = DB::table('users')->where('email', $userMail)->first();

        if ($isEmailExist) {
            $day = Carbon::now();
            $token_reset = md5($userMail . $day);

            DB::table('password_resets')
                ->where('email', $userMail)
                ->delete();

            DB::table('password_resets')->insert([
                'email'=>$userMail,
                'token'=> $token_reset,
                'created_at' => $day,
            ]);


            $logo = Config::message('logo');

            $variables_correo = [
                'logo' => $logo,
                'footer'=> '',
                'title'=>'Reset Password',
                'token_reset'=> $token_reset,
            ];


            $errors = 'Mail Send';

            $isErrorEmail = SendMailCTRL::sendNow(
                'mail_template.reset_password',
                $variables_correo,
                $userMail,
                'Reset Password'
            );

            if ($isErrorEmail) {
                $errors = 'Failed to send password reset email, please try again.';
            }

            if ($errors==='Mail Send') {
                $response = ['message' => 'Email Send! Please check your email'];
            } else {
                $response = ['message' => 'Error to Send email'];
            }
        } else {
            $response = ['message' => 'Email No Exist'];
        }

        return response()->json($response);
    }


    /**
     * @return [type]
     */
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


    /**
     * @param  string
     * @return [type]
     */
    public function tokenPass($token_pass = '')
    {

        $data = DB::table('password_resets')
            ->where('token', $token_pass)
            ->first();

        if ($data) {
            Session::put('email_reset', $data->email);
            Session::put('token_reset_password', $token_pass);

            return view('new_password');
        }

        return 'invalid token';
    }
}
