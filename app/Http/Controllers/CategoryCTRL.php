<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;

class CategoryCTRL extends Controller
{
    /**
     * [category description]
     * @param  [type] $name_category [description]
     * @return [type]                [description]
     */
    public function category($name_category)
    {
        $name_category = strtolower($name_category);
        $consulta = DB::table('category')
            ->where('name_cat', $name_category)
            ->where('Status', 0)
            ->select('name', 'image_cat', 'group_id', 'submenu_cat')
            ->first();

        if ($consulta) {
            $banner = $consulta->image_cat;
            $group_id = $consulta->group_id;
            $submenu_cat = $consulta->submenu_cat;
            $name_cat = $consulta->name;

            if ($group_id) {
                $items = DB::table('items')
                    ->where('It_Groups', '=', $group_id)
                    ->where('It_Status', '=', '0')
                    ->select('description', 'It_Id', 'It_Descrip', 'It_ImagePre')
                    ->orderBy('It_Special')
                    ->get();

                if ($submenu_cat) {
                    $id = $items[0]->It_Id;
                    $items = DB::table('size')
                        ->where('Sz_Item', $id)
                        ->select('Sz_Id', 'Sz_Price', 'Sz_item', 'Sz_Descrip')
                        ->orderBy('Sz_Special')
                        ->get();
                } else {
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
                }
            }
        } else {
            $banner = '7838a2f8-fb2d-48e8-abc9-f7db942d3ede.jpg';
            //donde no esta en la lista
        }

        if (!isset($items)) {
            $items = '';
        }

        if (!isset($submenu_cat)) {
            $submenu_cat = 0;
        }

        if (!isset($name_cat)) {
            $name_cat = "";
        }

        $categorys = DB::table('category')
            ->where('Status', 0)
            ->select('name', 'name_cat')
            ->get();

        return view('category')->with(
            [
            'categorys'=>$categorys,
            'name_category'=>$name_cat,
            'name_cat_url'=>$name_category,
            'banner'=>$banner,
            'items'=>$items,
            'sub'=>$submenu_cat
            ]
        );
    }
}
