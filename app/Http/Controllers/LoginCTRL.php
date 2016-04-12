<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;

use Pizza\Http\Requests\LoginRequest;

use Auth;
use Session;
use Redirect;
use DB;

class LoginCTRL extends Controller
{
    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        if (!Auth::check()) {
            $config = DB::table('config')->select('logo', 'background')->first();

            return view('login')->with(['config'=>$config]);
        }

        return Redirect::to('cart');
    }

    /**
     * [login description]
     * @param  LoginRequest $request [description]
     * @return [type]                [description]
     */
    public function login(LoginRequest $request)
    {
        $credentials = [
            'email'=>$request['email'],
            'password'=>$request['password'],
            'account_verify' => 1
        ];

        if (Auth::attempt($credentials)) {
            LogCTRL::addToLog(1);

            if (CartCTRL::totalCostCart(true)) {
                return Redirect::to('cart');
            }

            return Redirect::to('choose');
        }

        $userExist = DB::table('users')
            ->where('email', $request['email'])
            ->where('account_verify', 0)
            ->get();

        if ($userExist) {
            Session::flash('normal-error', 'Please activate your account');
        } else {
            Session::flash(
                'message-error',
                'Bad Login, User or Password is Incorrect!'
            );
        }

        return Redirect::to('login');
    }

    /**
     * [logout description]
     * @return [type] [description]
     */
    public function logout()
    {
        LogCTRL::addToLog(2);
        Auth::logout();
        return Redirect::to('login');
    }
}
