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
				return Redirect::to('admin');	
	    	}

	    	Session::flash('message-error', 'Bad Login');
	    	return Redirect::to('admin/login');

    	
    }
    
    /**
     * [logout description]
     * @return [type] [description]
     */
    public function logout()
    {
    	Auth::logout();
        return Redirect::to('admin/login');
    }
}