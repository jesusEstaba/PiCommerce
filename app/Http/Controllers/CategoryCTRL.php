<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;
use Pizza\Config;

class CategoryCTRL extends Controller
{
    /**
     * [category description]
     * @param  [type] $name_category [description]
     * @return [type]                [description]
     */
    public function category($name_category)
    {
        $defaultBanner = Config::message('Default Banner Group');
        $items = '';
        $name_cat = '';
        $submenu_cat = 0;
        

        $name_category = strtolower($name_category);
        $consulta = DB::table('groups')
            ->where('Gr_Url', $name_category)
            ->where('Gr_Status', 0)
            ->select(
                'Gr_Descrip AS name',
                'Gr_Banner AS image_cat',
                'Gr_ID AS group_id',
                'Gr_Sub AS submenu_cat'
            )
            ->first();

        if ($consulta) {
            $banner = ($consulta->image_cat) ? $consulta->image_cat : $defaultBanner;
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
            $banner = $defaultBanner;
        }

        return view('category')->with([
            'categorys' => $consulta,
            'name_category' => $name_cat,
            'name_cat_url' => $name_category,
            'banner' => $banner,
            'items' => $items,
            'sub' => $submenu_cat
        ]);
    }
}
