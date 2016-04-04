<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;

use Pizza\Http\Requests\LoginRequest;
use Auth;
use Redirect;
use Session;

class AdminLoginCTRL extends Controller
{
    public function index()
    {
    	return view('admin.login');
    }

    public function login(LoginRequest $request)
    {

    		if( Auth::attempt(['email'=>$request['email'], 'password'=>$request['password'] ]) )
	    	{
                LogCTRL::addToLog(3);
				return Redirect::to('kitchen');	
	    	}

	    	Session::flash('message-error', 'Bad Login');
	    	return Redirect::to('kitchen/login');

    	
    }
    
    /**
     * [logout description]
     * @return [type] [description]
     */
    public function logout()
    {
        LogCTRL::addToLog(4);
    	Auth::logout();
        return Redirect::to('kitchen/login');
    }
}
