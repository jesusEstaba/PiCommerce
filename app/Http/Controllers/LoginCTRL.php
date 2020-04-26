<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\LoginRequest;

use Auth;
use Session;
use Redirect;
use DB;
use App\Config;

class LoginCTRL extends Controller
{
    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        if (!Auth::check()) {

            $logo = Config::message('logo');
            $background = Config::message('Background Login');

            return view('login')->with([
                'logo'=> $logo,
                'background'=> $background,
            ]);
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
        ];

        if (Auth::attempt($credentials)) {
            LogCTRL::addToLog(1);

            if (CartCTRL::totalCostCart(true) || Session::has('size')) {
                return Redirect::to('cart');
            }

            return Redirect::to('menu');
        }

        Session::flash('message-error','User or Password is Incorrect!');

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
