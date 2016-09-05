<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;
use Input;
use Session;
use Carbon\Carbon;
use Auth;
use Pizza\Config;

class QuickPayCTRL extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->to('checkout/pickup');
        }

        $logo = Config::message('logo');

        $termsAndServices = DB::table('terms_service')
            ->where('section', 2)
            ->first();

        if ($termsAndServices) {
            $termsAndServices = $termsAndServices->terms;
        } else {
            $termsAndServices = '';
        }

        return view('checkout.quick')->with([
            'logo' => $logo,
            'termsAndServices' => $termsAndServices
        ]);
    }


    /**
     * Carga el producto al carrito y mantiene le Id del item del
     * carrrito en Session, y si existe un producto en Sesion lo
     * elimina.
     * 
     * Session::get('id_cart') mantiene el Id del item del carrito
     * 
     * @return json
     */
    public function loadCartQuick()
    {
        if (Session::has('size') &&
            Input::has('name') &&
            Input::has('phone') &&
            Input::has('email')
            ) {

            Session::put('name', Input::get('name'));
            Session::put('phone', Input::get('phone'));
            Session::put('email', Input::get('email'));

            //funcion que carga el producto a la db
            $cartId = CartCTRL::loadItemToCart(
                Session::get('size'),
                Session::get('topping'),
                Session::get('topping_size'),
                Session::get('cooking_instructions'),
                Session::get('quantity'),
                true
            );

            if ($cartId>0) {
                if (Session::has('id_cart')) {
                    $cartIdSession = (int)Session::get('id_cart');

                    DB::table('cart')->delete($cartIdSession);

                    DB::table('cart_top')
                        ->where('id_cart', $cartIdSession)
                        ->delete();

                    Session::forget('id_cart');
                }

                Session::put('id_cart', $cartId);

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
