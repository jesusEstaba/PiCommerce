<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;

class PayCTRL extends Controller
{
    public function index(Request $request){

    	return view('pay')->with('cart_item', $request['select_cart']);
    }
}
