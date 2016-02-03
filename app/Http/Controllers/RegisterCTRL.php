<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use Pizza\User;
use Redirect;
use Session;
use DB;

class RegisterCTRL extends Controller
{
    public function index(){
        return view('register');
    }
    
    public function register(Request $request){

    	if(
    		!empty($request['name']) &&
			!empty($request['email']) &&
			!empty($request['password'])
    		)
    	{
    		$datos = DB::select('select id from users where email = ?', [$request['email']]);
    		if(!$datos)
    		{
    			User::create([
		    		'name' => $request['name'], 
		    		'email' => $request['email'], 
		    		'password' => bcrypt($request['password'])
	    		]);
	    		Session::flash('message', 'User Registered');
    		}
    		else
    		{
    			Session::flash('message-error', 'This user is already register');
    		}
    	}
    	else
    	{
    		Session::flash('message-error', 'Field Empty');
    	}
    	
    	return Redirect::to('register');
    }
}
