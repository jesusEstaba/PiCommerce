<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;
use Auth;
use Carbon\Carbon;


class PayCTRL extends Controller
{
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index($select='')
    {
        $cart = CartCTRL::busq_cart();//Session = $cart -> to OrderCTRL
        
        $total_in_cart = CartCTRL::total_price(true);
    	
        if($select=='quick')
        {
            $config = DB::table('config')->select('logo', 'background')->first();
            
            return view('checkout.quick')->with(['config'=>$config]);
        }

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

    	$tax = DB::table('taxes')
            ->select('Tx_Base')
            ->first();

        $delivery_val = DB::table('password1')
            ->select('G_Value')
            ->where('G_Id', 5)
            ->first();

        $fee = DB::table('payform')
            ->select('Pf_Charge')
            ->where('Pf_Id', 2)
            ->first();

        $arrival_date = Carbon::now();

    	return view('checkout.pay')->with([
            'select'=>$select,
            'arrival_date'=>$arrival_date,
            'fee'=>$fee,
            'delivery_val'=>$delivery_val,
    		'cart'=>$cart,
    		'total_in_cart'=>$total_in_cart,
    		'tax'=>$tax->Tx_Base,
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
		return view('checkout.selection');
	}

}
