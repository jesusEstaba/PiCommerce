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
	 * @param  [type] $select [description]
	 * @return [type]         [description]
	 */
    public function index($select)
    {
    	$cart = CartCTRL::busq_cart();
    	//Session = $cart -> to OrderCTRL
    	//
    	//Session = $select
    	$user = DB::table('customers')->where('Cs_Phone', Auth::user()->phone)->first();

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
