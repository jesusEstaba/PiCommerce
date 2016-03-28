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
    	$cart = CartCTRL::busq_cart();
    	//Session = $cart -> to OrderCTRL

    	$user = DB::table('users')
    		->leftJoin('customers', 'customers.Cs_Phone', '=', 'users.phone')
    		->where('users.phone', Auth::user()->phone)
    		->select('Cs_Number', 'Cs_Street', 'Cs_ZipCode', 'Cs_Notes')
    		->first();

    	return view('pay')->with(['cart'=>$cart, 'user'=>$user]);
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
