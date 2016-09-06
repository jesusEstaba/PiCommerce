<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;
use Auth;
use Pizza\Config;

class ProductCTRL extends Controller
{
    /**
     * [index description]
     * @param  [type] $cat [description]
     * @param  integer $id  [description]
     * @param  string $sub [description]
     * @return view      [description]
     */
    public function index($cat, $id, $sub = '')
    {
        // Cart Things
        $cart = false;
        $total_cart = 0.00;

        if (Auth::check()) {
            $cart = CartCTRL::searchCartItems('asc');
            $total_cart = CartCTRL::totalCostCart(true);
        }

        $sizeToppingFunc = function ($size) {
            if($size==2) {
                $sizeTopping = " [left]";
            } elseif($size==3) {
                $sizeTopping = " [rigth]";
            } elseif($size==4) {
                $sizeTopping = " [extra]";
            } elseif($size==5) {
                $sizeTopping = " [lite]";
            } else {
                $sizeTopping = "";
            }
            
            return $sizeTopping;
        };
        // END Cart Things
        
        $idTpKinds = Config::value1('Id Topping Cooking Instructions');
        $cooking_instructions = DB::table('toppings')
                ->where('Tp_Kind', $idTpKinds)
                ->orderBy('Tp_Special')
                ->get();

        $maxCooking = Config::value1('Max Cooking Instructions');
       
        $it_groups = false;

        if ($sub=='sub') {
            $size_t = DB::table('size')
                ->join('items', 'items.It_Id', '=', 'size.Sz_Item')
                ->where('size.Sz_Id', $id)
                ->first();

            if ($size_t) {
                $items = true;
                $name = $size_t->Sz_Descrip;
                $description = '';
                $it_groups = $size_t->It_Groups;
                $size_Id = [(int)$id];
            }
        } else {
            if ($cat=='combo') {
                $comboItems = DB::table('combo_items')
                    ->leftJoin('items', 'items.It_Id', '=', 'combo_items.CbI_Item')
                    ->where('CbI_Combo', $id)
                    ->get();

                foreach ($comboItems as $key => $item) {
                    $sizes = DB::table('size')
                        ->where('Sz_Item', $item->It_Id)
                        ->where('Sz_Status', 0)
                        ->get();
                    
                    $item->sizes = $sizes;
                    $item->sizeToppings = [];

                    foreach ($sizes as $arry => $size) {
                        $item->sizeToppings[] = $this->toppings($size->Sz_Id);
                    }
                }

                $combo = DB::table('combo')
                    ->where('Cb_Id', $id)
                    ->where('Cb_Status', 0)
                    ->first();

                if ($combo) {
                    return view('builder.combo')->with([
                        'maxCooking' => $maxCooking,
                        'cooking_instructions' => $cooking_instructions,
                        'combo' => $combo,
                        'items' => $comboItems,
                        'cart'=>$cart,
                        'total_cart'=>$total_cart,
                        'sizeToppingFunc' => $sizeToppingFunc,
                    ]);
                }

                
            } else {
                $items = DB::table('items')
                    ->where('It_Id', $id)
                    ->where('It_Status', 0)
                    ->select('items.It_Groups', 'items.It_Descrip', 'items.It_Id', 'items.description')
                    ->first();

                if ($items) {
                    $name = $items->It_Descrip;
                    $id_item = $items->It_Id;
                    $description = $items->description;
                    $it_groups = $items->It_Groups;

                    $size_t = DB::table('size')
                        ->where('Sz_Item', $id_item)
                        ->where('Sz_Status', 0)
                        ->get();

                    $sizes_t = [];

                    foreach ($size_t as $key => $value) {
                        $sizes_t[] = $value->Sz_Id;
                    }

                    $size_Id = $sizes_t;
                }
            }
            
        }

        if ($it_groups) {
            $builder_data = DB::table('groups')
                ->where('Gr_ID', $it_groups)
                ->where('Gr_Status', 0)
                ->select(
                    'Gr_Builder AS builder_id',
                    'Gr_Image AS image',
                    'Gr_Banner AS banner'
                )
                ->first();

            if ($builder_data) {
                $id_builder = $builder_data->builder_id;
                $image = $builder_data->image;
                $banner = $builder_data->banner;

                if (!$image) {
                    $image = Config::message('Default Photo Group Item');
                }

                if (!$banner) {
                    $banner = Config::message('Default Banner Group');
                }
            } else {
                $id_builder = 0;
                $image = "";
                $banner = Config::message('Default Banner Group');
            }
            
            /******************/

            $allToppings = [];
            $pizzaBuilderSize = false;

            foreach ($size_Id as $sizeId) {
                $allToppings[] = $this->toppings($sizeId);
            }


            if (count($allToppings)) {// pizza qty Topping
                $isExist = DB::table('config')
                    ->where('Cfg_Descript', 'Id Group Pizza Builder')
                    ->where('Cfg_Value1', $it_groups)
                    ->first();
                
                if ($isExist) {
                    $pizzaBuilderSize = true;
                }
            }

            /******************/

            if ($id_builder == 1) {
                $vista = 'builder.toppings';
            } elseif ($id_builder == 2) {
                $vista = 'builder.simple';
            }

            if (isset($vista)) {
                return view($vista)->with([
                        'maxCooking' => $maxCooking,
                        'cooking_instructions' => $cooking_instructions,
                        'name'=>$name,
                        'size'=>$size_t,
                        'allToppings' => $allToppings,
                        'item'=>$items,
                        'description'=>$description,
                        'image_category'=>$image,
                        'pizzaBuilderSize'=>$pizzaBuilderSize,
                        'cart'=>$cart,
                        'total_cart'=>$total_cart,
                        'banner' => $banner,
                        'sizeToppingFunc' => $sizeToppingFunc,
                ]);
            }
        }

        return view('builder.generic_builder');
    }


    public function toppings($sizeId)
    {
        $tp_kind = DB::table('sizetopp')
            ->where('SzTp_Size', $sizeId)
            ->where('SzTp_Status', 0)
            ->first();
        
        $tp_kind = ($tp_kind) ? $tp_kind->SzTp_GroupTP : 0;
        
        $allToppings = DB::table('toppings')
            ->leftJoin('color_toppings', 'color_toppings.color_number', '=', 'toppings.Tp_Color')
            ->where('Tp_Kind', $tp_kind)
            ->where('Tp_Status', 0)
            ->select(
                'Tp_Id',
                'TP_Descrip',
                'color_hex AS Tp_Color',
                'Tp_Double',
                'Tp_Topprice'
            )
            ->orderBy('Tp_Special')
            ->get();

        
        return ($allToppings) ? $allToppings : [];
    }
}
