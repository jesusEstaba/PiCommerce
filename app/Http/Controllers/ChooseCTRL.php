<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;

class ChooseCTRL extends Controller
{
    public function index()
    {
        $categories = DB::table('choose_category')
            ->join('category', 'category.id', '=', 'choose_category.cat_id')
            ->where('Status', 0)
            ->get();
        $items = DB::table('items')
            ->where('It_Feature', '=', 1)
            ->where('It_Status', '=', '0')
            ->select('description', 'It_Id', 'It_Descrip', 'It_ImagePre')
            ->orderBy('It_Special')
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

        $categorys = DB::table('category')
            ->where('Status', 0)
            ->select('name', 'name_cat')
            ->get();

        return view('choose')->with([
            'categories'=>$categories,
            'items'=>$items,
            'categorys'=>$categorys
        ]);
    }
}
