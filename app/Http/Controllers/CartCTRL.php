<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Auth;
use DB;

class CartCTRL extends Controller
{
    /**
     * [add_ajax description]
     * @param Request $request [description]
     */
    public function addAjax(Request $request)
    {
        if (Auth::check()) {
            if ($request['combo_id']) {
                $this->loadComboToCart(
                    $request['combo_id'],
                    $request['id_size'],
                    $request['toppings_id'],
                    $request['toppings_size'],
                    $request['cooking_notes'],
                    $request['quantity'] 
                );

                $response = ['type' => 'combo'];
            } else {
               $this->loadItemToCart(
                    $request['id_size'],
                    $request['toppings_id'],
                    $request['toppings_size'],
                    $request['cooking_notes'],
                    $request['quantity']
                );

                $response = ['type' => 'item'];
            }

            $response['status'] = 'online';
            
        } else {
            if ($request['combo_id']) {
                Session::put('combo', $request['combo_id']);
                $response = ['type' => 'combo'];
            } else {
                $response = ['type' => 'item'];
            }

            Session::put('size', $request['id_size']);
            Session::put('topping', $request['toppings_id']);
            Session::put('topping_size', $request['toppings_size']);
            Session::put('cooking_instructions', $request['cooking_notes']);
            Session::put('quantity', $request['quantity']);

            $response['status'] = 'offline';
        }

        return response()->json($response);
    }


    /**
     * [delete description]
     * @param  Request $id [description]
     * @return [type]      [description]
     */
    public function delete($id)
    {
        DB::table('cart_top')
            ->where('id_cart', $id)
            ->delete();

        $deleteRespn = DB::table('cart')
            ->where('id_user', Auth::user()->id)
            ->where('id', $id)
            ->delete();

        return response()->json(['state' => $deleteRespn,]);
    }

    /**
     * [Vaciar el carrito]
     * @param array $cart
     */
    public static function clear($cart)
    {
        foreach ($cart as $key => $value) {
            DB::table('cart_top')
                ->where('id_cart', $value->id)
                ->delete();
            
            DB::table('cart')
                ->where('id', $value->id)
                ->delete();
        }
    }


    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        if (Session::has('size')) {
            if (Session::has('combo')) {
                $this->loadComboToCart(
                    Session::get('combo'),
                    Session::get('size'),
                    Session::get('topping'),
                    Session::get('topping_size'),
                    Session::get('cooking_instructions'),
                    Session::get('quantity')
                );

                Session::forget('combo');
            } else {
                $this->loadItemToCart(
                    Session::get('size'),
                    Session::get('topping'),
                    Session::get('topping_size'),
                    Session::get('cooking_instructions'),
                    Session::get('quantity')
                );
            }

            Session::forget('size');
            Session::forget('toppings');
            Session::forget('topping_size');
            Session::forget('cooking_instructions');
            Session::forget('quantity');
        }

        $cart = static::searchCartItems('comboSubItems');

        if (!isset($size)) {
            $size = "";
        }

        if (!isset($toppings)) {
            $toppings = "";
        }

        return view('cart')->with(['cart'=>$cart]);
    }


    public function back()
    {
        return redirect()->back();
    }


    /**
     * [searchCartItems description]
     * @param  string $asc [description]
     * @return [type]      [description]
     */
    public static function searchCartItems($asc = '', $idCart = '')
    {
        $keyGroup = 'cart.id';
        
        if ($asc==='asc') {
            $orderByCart = 'asc';
        } elseif ($asc==='combo'){
            $orderByCart = 'desc';
            $keyGroup = 'cart.is_combo';
        } else {
            $orderByCart = 'desc';
        }

        if ($idCart == '' || $asc === 'recursive') {
            $idUserTemp = Auth::user()->id;
        } else {
            $idUserTemp = 314;
        }

        $cart = DB::table('cart')
            ->join('size', 'size.Sz_Id', '=', 'cart.product_id')
            ->join('items', 'items.It_Id', '=', 'size.Sz_Item')
            ->where('cart.id_user', $idUserTemp)
            ->where(
                function ($query) use ($idCart, $asc) {
                    if ($idCart) {
                        $query->where('id', $idCart);
                    }
                    if ($asc==='comboSubItems') {
                        $query->where('combo', 0);
                    }
                }
            )
            ->select(
                'items.It_Descrip',
                'cart.product_id',
                'cart.quantity',
                'cart.id',
                'cart.cooking_instructions',
                'size.Sz_Abrev',
                'size.Sz_FArea',
                'size.Sz_Price',
                'size.Sz_Topprice',
                'size.Sz_FArea',
                'size.Sz_Descrip',
                'cart.combo',
                'cart.is_combo'
            )
            ->orderBy($keyGroup, $orderByCart)
            ->get();


        foreach ($cart as $key => $value) {

            if ($asc==='comboSubItems' && $value->is_combo==1) {
                $subItemsCombo = DB::table('cart')
                    ->where('combo', $value->id)
                    ->get();

                $value->subItems = [];

                foreach ($subItemsCombo as $subKey => $subItem) {
                    $item = static::searchCartItems('recursive', $subItem->id);
                    $value->subItems = array_merge($item, $value->subItems);
                }

            } else {
                $value->toppings_list = static::loadToppings($value->id);
            }
        }

        return $cart;
    }


    /**
     * 
     */
    protected static function loadToppings($idItemCart)
    {
        return DB::table('cart_top')
            ->join('toppings', 'toppings.Tp_Id', '=', 'cart_top.id_topping')
            ->where('id_cart', $idItemCart)
            ->orderBy('id_cart')
            ->select(
            'toppings.Tp_Id',
            'toppings.Tp_Descrip',
            'cart_top.price',
            'cart_top.size'
            )
            ->get();
    }


    /**
     * [Devuelve el total del precio del carrito]
     * @param  boolean $res
     * void:devuelve la respuesta en json.
     * true:devuelve el precio en número.
     * @return [json || float]
     */
    public static function totalCostCart($res = false, $userIdCart = '')
    {
        if ($userIdCart === '') {
            $userIdCart = Auth::user()->id;
            $idCartTemp = 0;
        } else {
            $idCartTemp = $userIdCart;
        }

        $totalCart = DB::table('cart')
            ->join('cart_top', 'cart_top.id_cart', '=', 'cart.id')
            ->where('is_combo', 0)
            ->where(function ($query) use ($userIdCart, $idCartTemp) {
                    if ($idCartTemp) {
                        $query->where('cart.id', $idCartTemp);
                    } else {
                        $query->where('cart.id_user', $userIdCart);
                    }
                }
            )
            ->selectRaw('sum(cart_top.price*cart.quantity) as toppings')
            ->get();

        if ($totalCart) {
            $totalCartTwo = DB::table('cart')
                ->join('size', 'size.Sz_Id', '=', 'cart.product_id')
                ->where('is_combo', 0)
                ->where(function ($query) use ($userIdCart, $idCartTemp) {
                        if ($idCartTemp) {
                            $query->where('cart.id', $idCartTemp);
                        } else {
                            $query->where('cart.id_user', $userIdCart);
                        }
                    }
                )
                ->selectRaw('sum(size.Sz_Price*cart.quantity) as pizza')
                ->get();

            if ($totalCartTwo) {
                $totalCartTwo = $totalCartTwo[0]->pizza;
            } else {
                $totalCartTwo = 0;
            }

            $total = $totalCart[0]->toppings + $totalCartTwo;
        } else {
            $total = 0.00;
        }

       return $total;
    }


    /**
     * Carga los Size al Carrito
     * 
     * @param  [String || Intenger] $size
     * @param  [String || Array] $toppings
     * @param  [String || Array] $topSize
     * @param  [String] $cookingInstructions
     * @param  [String || Intenger] $quantity
     *
     *
     * @return [int] [Solo si $quick es True]
     */
    public static function loadItemToCart(
        $size,
        $toppings,
        $topSize,
        $cookingInstructions,
        $quantity,
        $quick = false,
        $comboId = 0
    )
    {
        $idCart = 0;

        $quantity = (int)$quantity;

        if (!$quantity) {
            $quantity = 1;
        }

        if ($quick) {
            $userIdCart = 314;
        } else {
            $userIdCart = Auth::user()->id;
        }

        $idCart = DB::table('cart')->insertGetId(
            [
            'id_user' => $userIdCart,
            'product_id' => $size,
            'cooking_instructions' => trim($cookingInstructions),
            'quantity' => $quantity,
            'combo' => $comboId,
            'is_combo' => $comboId != 0
            ]
        );

        static::addToppingToCartTop(
            $idCart,
            $size,
            $toppings,
            $topSize
        );


        if ($quick) {
            return $idCart;
        }
    }

    /**
     * Carga el Combo al Carrito 
     *
     * @param [int] $comboId
     * @param [array] $sizeId
     * @param [array] $toppingsId
     * @param [array] $toppingsSize
     * @param [string] $cookingNotes
     * @param [String || Integer] $quantity
     */
    protected function loadComboToCart(
        $comboId,
        $sizeId,
        $toppingsId,
        $toppingsSize,
        $cookingNotes,
        $quantity
    )
    {
        $idCart = DB::table('cart')->insertGetId(
            [
                'id_user' => Auth::user()->id,
                'product_id' => $comboId,
                'cooking_instructions' => trim($cookingNotes),
                'quantity' => $quantity,
                'is_combo' => 1,
            ]
        );
        
        $numSizes = count($sizeId);

        for ($i = 0; $i < $numSizes; $i++) {
            if (isset($toppingsId[$i])) {
                $topsId = $toppingsId[$i];
            } else {
                $topsId = [];
            }

            if (isset($toppingsSize[$i])) {
                $topSize = $toppingsSize[$i];
            } else {
                $topSize = [];
            }

            static::loadItemToCart(
                $sizeId[$i],
                $topsId,
                $topSize,
                '',
                $quantity,
                false,
                $idCart
            );
        }
    }



    /**
     * Carga los Toppings a los toppings del Carrito
     *
     * @param [String || Integer] $idCart
     * @param [String || Integer] $sizeId
     * @param [String || Array] $toppings
     * @param [String || Array] $topSize
     */
    protected static function addToppingToCartTop(
        $idCart,
        $sizeId,
        $toppings,
        $topSize
    ) {
        $sizePrice = DB::table('size')
            ->where('Sz_Id', $sizeId)
            ->select('Sz_Topprice as szTop', 'Sz_Topprice2 as szTopTwo')
            ->first();

        $toppingPrice = (float)$sizePrice->szTop;
        $toppingPriceTwo = (float)$sizePrice->szTopTwo;

        if (!is_array($toppings)) {
            $toppings = explode(',', $toppings);
            $topSize = explode(',', $topSize);
        }

        $arrSize = count($toppings);

        for ($indice = 0; $indice < $arrSize; $indice++) {
            $idTop = (int)$toppings[$indice];
            $sizeTopId = (int)$topSize[$indice];

            if ($idTop) {
                $topping = DB::table('toppings')
                    ->where('Tp_Id', $idTop)
                    ->select(
                        'Tp_Topprice as tpTopPrice',
                        'Tp_Double as tpDouble',
                        'Tp_Kind as tpKind'
                    )
                    ->first();

                if ($topping->tpKind != 4) {
                    $tpTopPrice =  $topping->tpTopPrice;
                    $tpDouble =  $topping->tpDouble;
                    $priceTopNew = 0;

                    if ($tpTopPrice>0) {
                        $priceTopNew = (float)$tpTopPrice;
                    } else {
                        if ($tpDouble=='N') {
                            $priceTopNew = (float)$toppingPrice;
                        } else {
                            $priceTopNew = (float)$toppingPriceTwo;
                        }
                    }

                    if ($sizeTopId==1 ||  $sizeTopId==5) {
                        $priceTopNew *= 1;
                    } elseif ($sizeTopId==2 ||  $sizeTopId==3) {
                        $priceTopNew *= 1/2;
                    } elseif ($sizeTopId==4) {
                        $priceTopNew *= 2;
                    }
                } else {
                    $sizeTopId = 6;
                    $priceTopNew = 0;
                }

                DB::table('cart_top')->insert(
                    [
                    'id_cart' => $idCart,
                    'id_topping' => $idTop,
                    'price' => round($priceTopNew, 2),
                    'size' => $sizeTopId
                    ]
                );
            }
        }
    }


}
