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

            $config = DB::table('config')->first();

            $variables_correo = [
                'logo' => $config->logo,
                'footer'=> $config->footer,
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

    public static function sendEmailToNewUser($userMail, $name, $pass)
    {
        $config = DB::table('config')->first();

        $day = Carbon::now();
        $token_active = md5($userMail . $day . rand());

        $variables_correo = [
            'logo' => $config->logo,
            'footer'=> $config->footer,
            'title'=>'Active Your Account',
            'name' => $name,
            'pass' => $pass,
        ];

        $isErrorEmail = SendMailCTRL::sendNow(
            'mail_template.new_user',
            $variables_correo,
            $userMail,
            'Reset Password'
        );

        return $isErrorEmail;
    }

    public function reactivate($email)
    {

        $userExist = DB::table('users')
            ->where('email', $email)
            ->where('account_verify', 0)
            ->get();

        if ($userExist) {
            $config = DB::table('config')->first();

            $day = Carbon::now();
            $token_active = md5($email . $day . rand());

            $variables_correo = [
                'logo' => $config->logo,
                'footer'=> $config->footer,
                'title'=>'Active Your Account',
                'token_active'=> $token_active,
            ];

            $isErrorEmail = SendMailCTRL::sendNow(
                'mail_template.new_user',
                $variables_correo,
                $email,
                'Reset Password'
            );

            if ($isErrorEmail===0) {
                DB::table('verified_accounts')
                    ->where('email', $email)
                    ->delete();

                DB::table('verified_accounts')->insert([
                    'email'=>$email,
                    'remember_token'=> $token_active,
                    'created_at' => $day,
                ]);

                return redirect()->to('active-your-acount');
            }

            Session::flash('message-error', 'Email not valid');

            return redirect()->to('login');
        }

        Session::flash('message-error', 'User does not exist');

        return redirect()->to('login');
    }

    public function activeAccount($token)
    {
        $data = DB::table('verified_accounts')
            ->where('remember_token', $token)
            ->first();

        if ($data) {
            DB::table('verified_accounts')
                ->where('remember_token', $token)
                ->delete();

            DB::table('users')
                ->where('email', $data->email)
                ->update(['account_verify'=>1]);

            return view('account_activated');
        }

        return 'invalid token';
    }
}
