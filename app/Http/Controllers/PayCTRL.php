<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;
use Auth;

class PayCTRL extends Controller
{
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
    	$cart = CartCTRL::busq_cart();//Session = $cart -> to OrderCTRL
    	
    	$total_in_cart = CartCTRL::total_price(true);

    	$user = DB::table('users')
    		->leftJoin('customers', 'customers.Cs_Phone', '=', 'users.phone')
    		->where('users.phone', Auth::user()->phone)
    		->select('Cs_Number', 'Cs_Street', 'Cs_ZipCode', 'Cs_Notes', 'Cs_Name', 'Cs_Phone', 'email')
    		->first();

    	

    	$valid_zip_code = DB::table('street')
    		->where('St_ZipCode', $user->Cs_ZipCode)
    		->first();
		
		$delivery = false;
    	
    	if($valid_zip_code){
    		$delivery = true;
    	}

    	return view('pay')->with([
    		'cart'=>$cart,
    		'total_in_cart'=>$total_in_cart,
    		'user'=>$user,
    		'delivery'=>$delivery
    		]);
    }
	

	/**
	 * [select description]
	 * @return [type] [description]
	 */
	public function select()
	{
		return view('selection');
	}

}
