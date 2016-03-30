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
    public function index()
    {
        $codes = DB::select('SELECT * from street where St_City = ?', ['Orlando']);
        $streets = DB::select('SELECT distinct St_ZipCode from street');
        
        return view('register')->with(['codes'=>$codes, 'streets'=>$streets]);
    }
    
    public function register(Request $request)
    {

    	if (
            !empty($request['password']) &&
            !empty($request['email']) &&
            !empty($request['phone']) &&
            !empty($request['first_name']) &&
            !empty($request['last_name']) &&
            !empty($request['street_number']) &&
            !empty($request['street_name'])
    		)
    	{
    		$datos = DB::table('users')
                ->where('email', $request['email'])
                ->select('users.id')
                ->get();
    		
            $datos_phone = DB::table('customers')
                ->where('Cs_Phone', $request['phone'])
                ->select('Cs_Phone')
                ->get();
            
            if(!$datos && !$datos_phone)
    		{
    			 DB::table('users')->insert([
                    'password' => bcrypt($request['password']),
                    'email' => $request['email'], 
                    'phone'=> $request['phone'],
                    'dir_ip'=> $_SERVER['REMOTE_ADDR'],
	    		]);

                DB::table('customers')->insert([
                    'Cs_Email1' => $request['email'],
                    'Cs_Phone'=> $request['phone'],
                    'Cs_Name' => $request['first_name'].' '.$request['last_name'], 

                    'Cs_Company' => $request['company'], 
                    'Cs_Number' => $request['street_number'], 
                    'Cs_Street' => $request['street_name'], 
                    /*
                    '' => $request['aparment'], 
                    '' => $request['aparment_complex'], 
                    '' => $request['complex_name'], 
                    '' => $request['city'], 

                    'Cs_ZipCode' => $request['zip_code'], 
                    'Cs_Notes' => $request['special_directions'],
                    */
                ]);


	    		Session::flash('message', 'User Registered!');
                
                if( Auth::attempt(['email'=>$request['email'], 'password'=>$request['password'] ]) )
                {
                    return Redirect::to('choose');    
                }
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
