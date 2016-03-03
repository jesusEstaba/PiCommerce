<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;


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
    	

    	return view('pay')->with(['cart'=>$cart]);
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
