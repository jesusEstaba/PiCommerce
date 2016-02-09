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
    		empty('password') &&
            empty('email') &&
            empty('phone') &&
            empty('first_name') &&
            empty('last_name') &&
            empty('street_number') &&
            empty('street_name')
    		)
    	{
    		$datos = DB::select('select id from users where email = ?', [$request['email']]);
    		if(!$datos)
    		{
    			User::create([
                    'password' => bcrypt($request['password']),
                    'email' => $request['email'], 
                    'phone'=> $request['phone'],
                    'first_name' => $request['first_name'], 
                    'last_name' => $request['last_name'], 
                    'company' => $request['company'], 
                    'street_number' => $request['street_number'], 
                    'street_name' => $request['street_name'], 
                    'aparment' => $request['aparment'], 
                    'aparment_complex' => $request['aparment_complex'], 
                    'complex_name' => $request['complex_name'], 
                    'zip_code' => $request['zip_code'], 
                    'city' => $request['city'], 
                    'state' => $request['state'], 
                    'country' => $request['country'], 
                    'special_directions' => $request['special_directions'], 

	    		]);
	    		Session::flash('message', 'User Registered [active your account in the mail send]');
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
