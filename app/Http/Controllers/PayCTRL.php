<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;


class PayCTRL extends Controller
{
    public function index(Request $request){
    	
    	$cart = CartCTRL::busq_cart();
    	//Session = $cart -> to OrderCTRL
    	return view('pay')->with(['cart'=>$cart]);
    }
}
