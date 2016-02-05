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
        $codes = DB::select('SELECT * from street where St_City = ?', ['Orlando']);
        return view('register')->with(['codes'=>$codes]);
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
