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

            $logo = DB::table('config')
                ->where('Cfg_Descript', 'logo')
                ->first();
            $background = DB::table('config')
                ->where('Cfg_Descript', 'Background Login')
                ->first();

            return view('login')->with([
                'logo'=> $logo->Cfg_Message,
                'background'=> $background->Cfg_Message,
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

            if (CartCTRL::totalCostCart(true)) {
                return Redirect::to('cart');
            }

            return Redirect::to('choose');
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
