<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;
use Input;
use Mail;
use Session;
use Carbon\Carbon;
use Auth;

class QuickPayCTRL extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->to('checkout/pickup');
        }

        $config = DB::table('config')->first();

        $termsAndServices = DB::table('terms_service')
            ->where('section', 2)
            ->first();

        if ($termsAndServices) {
            $termsAndServices = $termsAndServices->terms;
        } else {
            $termsAndServices = '';
        }

        return view('checkout.quick')->with([
            'config'=>$config,
            'termsAndServices' => $termsAndServices
        ]);
    }

    public function createOrderQuick(){
        $id_order_for_temp_user = 0;
        $day_now = Carbon::now()->format('d-m-Y');

        if (Session::has('size') &&
            Input::has('name') &&
            Input::has('phone') &&
            Input::has('email')
            ) {

            Session::put('name', Input::get('name'));
            Session::put('phone', Input::get('phone'));
            Session::put('email', Input::get('email'));

            //funcion que carga el producto a la db
            $id_cart_go = CartCTRL::loadItemToCart(
                Session::get('size'),
                Session::get('topping'),
                Session::get('topping_size'),
                Session::get('cooking_instructions'),
                Session::get('quantity'),
                true
            );

            if ($id_cart_go>0) {
                if (Session::has('id_cart')) {
                    $idCartSession = (int)Session::get('id_cart');

                    DB::table('cart')->delete($idCartSession);

                    DB::table('cart_top')
                        ->where('id_cart', $idCartSession)
                        ->delete();

                    Session::forget('id_cart');
                }

                Session::put('id_cart', $id_cart_go);

                Session::forget('size');
                Session::forget('toppings');
                Session::forget('topping_size');
                Session::forget('cooking_instructions');
                Session::forget('quantity');

                return response()->json('correct');
            } else {
                return response()->json('error');
            }
        }
    }
}
