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
        $categorys = DB::table('category')
            ->where('Status', 0)
            ->select('name', 'name_cat')
            ->get();
        
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
            }
        }

        if ($it_groups) {
            $builder_data = DB::table('category')
                ->where('group_id', $it_groups)
                ->where('Status', 0)
                ->select('builder_id', 'image', 'tp_kind')
                ->first();

            if ($builder_data) {
                $id_builder = $builder_data->builder_id;
                $image = $builder_data->image;
                $tp_kind = $builder_data->tp_kind;

                if (!$image) {
                    $image = "recipe-no-photo.jpg";
                }
            } else {
                $id_builder = 0;
                $image = "";
                $tp_kind = 0;
            }

            $toppings = DB::table('toppings')
                ->where('Tp_Kind', $tp_kind)
                ->where('Tp_Abrev', '!=', '.')
                ->where('Tp_Cat', '!=', 0)
                ->select('Tp_Id', 'TP_Descrip', 'Tp_Cat', 'Tp_Double', 'Tp_Topprice')
                ->orderBy('Tp_Cat')
                ->orderBy('Tp_special')
                ->get();

            $cooking_instructions = DB::table('toppings')
                ->where('Tp_Kind', 4)
                ->orderBy('Tp_Special')
                ->get();

            if ($id_builder == 1) {
                $vista = 'builder.pizza';
            } elseif ($id_builder == 2) {
                $vista = 'builder.salad';
            } elseif ($id_builder == 3) {
                $vista = 'builder.simple';
            }

            if (isset($vista)) {
                $cart = false;
                $total_cart = 0.00;

                if (Auth::check()) {
                    $cart = CartCTRL::searchCartItems('asc');
                    $total_cart = CartCTRL::totalCostCart(true);
                }

                return view($vista)->with([
                        'cooking_instructions' => $cooking_instructions,
                        'name'=>$name,
                        'size'=>$size_t,
                        'toppings'=>$toppings,
                        'item'=>$items,
                        'description'=>$description,
                        'image_category'=>$image,
                        'tp_kind'=>$tp_kind,
                        'cart'=>$cart,
                        'total_cart'=>$total_cart,
                        'categorys' => $categorys
                    ]);
            }
        }

        return view('builder.generic_builder')->with(['categorys' => $categorys]);
    }
}
