<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;
use Auth;
use Carbon\Carbon;
use Mail;
use Session;
use Input;

class OrderCTRL extends Controller
{
    /**
     * @author Jesus estaba <jeec.estaba@gmail.com>
     *
     * @return [type]
     */
    public static function create()
    {
        $hd_sell = 2;#PICKUP//poner un mensaje en caso de que estaba en delivery y no se pudo
        $hd_charge = 0;
		$hd_tips = 0;
		$hd_delivery = 0;
		$hd_payform = 1;
		$or_delivery = false;
		$or_discount = false;
		$or_charge = false;
		$or_tip = false;

		if( Input::get('card')==='true' ){	
			$fee = DB::table('payform')
				->select('Pf_Charge')
				->where('Pf_Id', 2)
				->first();

			$hd_charge = (float)$fee->Pf_Charge;
			$hd_payform = 2;

			$or_charge = true;
		}

		if( Input::get('delivery')==='true' ){
			$delivery_val = DB::table('password1')
				->select('G_Value')
				->where('G_Id', 5)
				->first();

			$hd_sell = 1;
			$hd_delivery = (float)$delivery_val->G_Value;
			$or_delivery = true;
		}

		if( Input::get('tips')==='true' ){
			$tip = (float)Input::get('tip');
			$tip = round($tip, 2);
			$hd_tips = $tip;
			$or_tip = true;
		}

    	$mytime = Carbon::now();
    	
    	$cart = CartCTRL::searchCartItems();//se deberia Cargar desde la sesion en vez de llamar al controller

    	//Calculando total del carrito
    	$total_cart = DB::table('cart')
    		->join('cart_top', 'cart_top.id_cart', '=', 'cart.id')
    		->where('cart.id_user', Auth::user()->id)
    		->selectRaw('sum(cart_top.price*cart.quantity) as toppings')
    		->orderBy('cart_top.id_cart')
    		->first();

    	if($total_cart)
    	{
    		$total_cart2 = DB::table('cart')
    			->join('size', 'size.Sz_Id', '=', 'cart.product_id')
    			->where('cart.id_user', Auth::user()->id)
    			->selectRaw('sum(size.Sz_Price*cart.quantity) as pizza')
    			->orderBy('cart.id')
    			->first();

    		if($total_cart2){
    			$total_cart2 = $total_cart2->pizza;
    		}
    		else{
				$total_cart2 = 0;
    		}

    		$sub_total = $total_cart->toppings + $total_cart2;
    	}
    	else
    	{
    		$sub_total = 0.00;
    	}
    	
		$hd_discount = 0;

		if( Session::has('coupon_discount') )
		{
			$coupon_disc = (float) Session::get('coupon_discount');
			$coupon_type = (int) Session::get('coupon_type');
			
			if($coupon_type===1)
			{
				$hd_discount = $sub_total * $coupon_disc / 100;
			}
			else
			{
				$hd_discount = $coupon_disc;
			}

			Session::forget('coupon_discount');
			Session::forget('coupon_type');
			$or_discount = true;
		}
		else
		{
			$coupon_disc = 0;
		}

        $subtotal_discount = $sub_total-$hd_discount;

        if($subtotal_discount<0)
        {
            $subtotal_discount = 0;
        }

		$tax = DB::table('taxes')->first();
		$tax = (float)$tax->Tx_Base;
		$hd_tax = $subtotal_discount * $tax/100;
		$hd_tax = round($hd_tax, 2);
    	
    	$total_de_la_Orden = $subtotal_discount + $hd_tax + $hd_charge + $hd_tips + $hd_delivery;

		if($total_de_la_Orden)
		{
			$id = DB::table('hd_tticket')->insertGetId([
				'Hd_Sell' => $hd_sell,
				'Hd_Date' => $mytime,
				'Hd_Time' => $mytime,
				'Hd_Customers' => Auth::user()->phone,
				'Hd_User' => 96,#CAMBIAR//REGISTRO NO. 81 DE LA TABLA PASSWORD1
				'Hd_Payform' => $hd_payform,
				'Hd_Subtotal' => $sub_total,
				'Hd_Discount' => round($hd_discount, 2),
				'Hd_Tax' => $hd_tax,
				'Hd_Charge' => $hd_charge,
				'Hd_Tips' => $hd_tips,//Tips over credit card, after sales
				'Hd_Delivery' => $hd_delivery,
				'Hd_Total' => round($total_de_la_Orden, 2),
			]);

			if( Session::has('coupon_id') )
			{
				CouponsCTRL::useDiscountCoupon($id, Session::get('coupon_id'));
				Session::forget('coupon_id');
			}
	    	
	    	$cont_order = 1;

	    	foreach ($cart as $c_key => $product)
	    	{
	    		$total_topping = DB::table('cart')
	    			->join('cart_top', 'cart_top.id_cart', '=', 'cart.id')
	    			->where('cart_top.id_cart', $product->id)
	    			->selectRaw('sum(cart_top.price) AS TotalToppings')
	    			->get();

	    		if($total_topping){
	    			$total_topping = $total_topping[0];
	    		}
	    		else{
	    			$total_topping = 0;
	    		}

	    		$dt_total = ($total_topping->TotalToppings+ $product->Sz_Price)*$product->quantity;

	    		$id_cart = DB::table('dt_tticket')->insertGetId([
	    			'Dt_Ticket' => $id,
	    			'Dt_Size' => $product->product_id,
	    			'Dt_SzOrder' => $cont_order,//Order
	    			'Dt_FArea' => $product->Sz_FArea,
	    			'Dt_Qty' => $product->quantity,
	    			'Dt_Price' => $product->Sz_Price,
	    			'Dt_TopPrice' => $product->Sz_Topprice,
	    			'Dt_Total' => $dt_total,
	    			
	    			//'Dt_TopDescrip' => $product->Sz_Descrip,
	    			'Dt_Detail' => $product->cooking_instructions,
	    			'Dt_Detail1' => $product->Sz_Descrip,
	    			'Dt_Detail2' => $product->Sz_Descrip,
	    		]);
	    		
	    		foreach ($product->toppings_list as $key => $topping)
	    		{		
	    			DB::table('dt_topping')->insert([
	    				'DTt_SzId' => $cont_order,//Order
	    				'DTt_Ticket' => $id,
	    				'DTt_Size' => $product->product_id,
	    				'DTt_Topping' => $topping->Tp_Id,
	    				'DTt_Detail' => $topping->Tp_Descrip,
	    				'DTt_Topprice' => $topping->price,
	    				#'DTt_SzOrder' => ,//Item Order in the invoice
	    				#'DTt_TopOrder' => ,//Topping Order under the Item (Dt_Size)
	    			]);
	    		}

	    		++$cont_order;
	    	}

			//VACIAR CARRITO
			foreach ($cart as $key => $value) {
				
				DB::table('cart_top')
					->where('id_cart', $value->id)
					->delete();

				DB::table('cart')
					->where('id', $value->id)
					->delete();
			}

			//AÑADIENDO LOG DE LA IP
			LogCTRL::addToLog(5);
			

			//ENVIAR CORREOS
			$correos = DB::table('emails_admin')->get();
			$mail_user = Auth::user()->email;
			$config = DB::table('config')->first();

			$order = DB::table('hd_tticket')->where('Hd_Ticket', $id)->first();
	        
			$size =function ($size)
		    {
		        $size_topping = '';

				        if($size==1){
				            $size_topping = '(All)';
				        }
				        elseif($size==2){
				            $size_topping = '(Left)';
				        }
				        elseif($size==3){
				            $size_topping = '(Rigth)';
				        }
				        elseif($size==4){
				            $size_topping = '(Extra)';
				        }
				        elseif($size==5){
				            $size_topping = '(Lite)';
				        }
				        
				return $size_topping;
		    };

		    $user = DB::table('users')
	    		->leftJoin('customers', 'customers.Cs_Phone', '=', 'users.phone')
	    		->where('users.phone', Auth::user()->phone)
	    		->select('Cs_Number', 'Cs_Street', 'Cs_ZipCode', 'Cs_Notes', 'Cs_Name', 'Cs_Phone', 'email')
	    		->first();


	        $variables_correo = [
		        'order' => $order,
		        'now' => Carbon::now()->format('d-m-Y'),

		        'delivery'=>$or_delivery,
		        'discount' => $or_discount,
		        'charge' => $or_charge,
		        'tip'=>$or_tip,

		        'cart'=>$cart,
		        'title'=>'Order',
		        'size'=>$size,
		        'logo' => $config->logo,
		        'footer'=> $config->footer,
		        'num_order'=>$id,
		        

		        'phone' => Auth::user()->phone,
		        'name'=> $user->Cs_Name,
		        'email'=>$mail_user,

		        'street_num' => $user->Cs_Number,
		        'street_name' => $user->Cs_Street,
		        'zip_code' => $user->Cs_ZipCode,
	        ];
	        
	        //$cart
	        //

            try {
                Mail::send('mail_template.order', $variables_correo, function($msj) use ($mail_user)
            {
                $msj->subject('Order');
                $msj->from(env('MAIL_ADDRESS'), env('MAIL_NAME'));
                
                $msj->to($mail_user);    
            });
                
            } catch (Exception $e) {
                
            }
	        
	        
	        Mail::send('mail_template.order', $variables_correo, function($msj) use ($correos)
	        {
	            $msj->subject('Order');
	            $msj->from(env('MAIL_ADDRESS'), env('MAIL_NAME'));

	            foreach($correos as $array => $admin)
	            {
	                $msj->to($admin->email);
	            }
	        });

	        if( $error_num_mail = count( Mail::failures() ) )
	        {
	            $errors = 'Failed to send ('.$error_num_mail.') email.';
	        }
	        
	        
		}

		if( !isset($errors) ){
			$errors = ['status'=>'correct'];
		}
		
		return response()->json($errors);
    }


    /**
     * 
     */
    public function back()
    {
    	return redirect()->back();
    }
}
