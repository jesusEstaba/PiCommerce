<?php

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
        if( !Auth::check() ){
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
    	if( Auth::attempt(['email'=>$request['email'], 'password'=>$request['password'] ]) )
    	{
            LogCTRL::addToLog(1);

            if( CartCTRL::total_price(true) ){
                return Redirect::to('cart');
            }

            return Redirect::to('choose');
    	}

    	Session::flash('message-error', 'Bad Login');
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
