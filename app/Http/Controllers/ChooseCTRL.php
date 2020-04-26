<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class ChooseCTRL extends Controller
{
    public function index()
    {
        $combos = DB::table('combo')
            ->where('Cb_Status', 0)
            ->where('Cb_Lunch', 0)
            ->get();

        $lunchs = DB::table('combo')
            ->where('Cb_Status', 0)
            ->where('Cb_Lunch', 1)
            ->get();

        $items = DB::table('products_features')
            ->join('items', 'items.It_Id', '=', 'products_features.item_id')
            ->where('It_Status', '=', '0')
            ->select(
                'items.description',
                'items.It_Id',
                'items.It_Descrip',
                'items.It_ImagePre'
            )
            ->orderBy('products_features.special_order')
            ->get();

        foreach ($items as $key => $item) {
            $size = DB::table('size')
                ->where('Sz_item', '=', $item->It_Id)
                ->where('Sz_Status', '=', '0')
                ->select('Sz_Price')
                ->take(1)
                ->get();

            if ($size) {
                $item->{'Sz_Price'} = $size[0]->Sz_Price;
                $item->{'Sz_item'} = $item->It_Id;
            } else {
                $item->{'Sz_Price'} = 0;
                $item->{'Sz_item'} = 0;
            }
        }

        return view('choose')->with([
            'items' => $items,
            'combos' => $combos,
            'lunchs' => $lunchs,
        ]);
    }
}
