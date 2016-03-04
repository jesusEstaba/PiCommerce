<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;

use DB;

use Input;

class ItemCTRL extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = Input::get('search');
        $category = Input::get('category');

        if ( $search!='' and $category!='')
        {
            $items = DB::table('items')
                ->join('groups', 'items.It_Groups', '=', 'groups.Gr_Id')
                ->where('items.It_Descrip', 'like', '%'.$search.'%')
                ->where('groups.Gr_ID', $category)
                ->select('items.It_Id', 'items.It_Descrip', 'items.description', 'items.It_Status', 'groups.Gr_Descrip')
                ->paginate(15);
        }
        else if($search!='')
        {
            $items = DB::table('items')
                ->join('groups', 'items.It_Groups', '=', 'groups.Gr_Id')
                ->where('items.It_Descrip', 'like', '%'.$search.'%')
                ->select('items.It_Id', 'items.It_Descrip', 'items.description', 'items.It_Status', 'groups.Gr_Descrip')
                ->paginate(15);
        }
        else if($category!='')
        {
            $items = DB::table('items')
                ->join('groups', 'items.It_Groups', '=', 'groups.Gr_Id')
                ->where('groups.Gr_ID', $category)
                ->select('items.It_Id', 'items.It_Descrip', 'items.description', 'items.It_Status', 'groups.Gr_Descrip')
                ->paginate(15);
        }
        else
        {
            $items = DB::table('items')
                ->join('groups', 'items.It_Groups', '=', 'groups.Gr_Id')
                ->select('items.It_Id', 'items.It_Descrip', 'items.description', 'items.It_Status', 'groups.Gr_Descrip')
                ->paginate(15);
        }

        $groups = DB::table('groups')->get();
        
        return view('admin.items.index')->with(['items'=>$items, 'search'=>$search, 'category'=>$category, 'groups'=>$groups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( isset($request['add']) )
        {
            if( !empty($request['name']) && !empty($request['category']) && !empty($request['descrip']) )
            {
                DB::table('items')->insert([
                    'It_Descrip'=> $request['name'],
                    'It_Abrev' =>$request['name'],
                    'It_Groups'=>$request['category'],
                    'It_Status'=>1,
                    'description'=>$request['descrip'],
                ]);
                return response()->json("New Item");
            }
        }

        if( isset($request['new_size']) )
        {
            if(
                !empty($request['descrip']) &&
                !empty($request['abrev']) &&
                !empty($request['price']) &&
                !empty($request['top_price']) &&
                !empty($request['top_price2']) &&
                !empty($request['area']) 
            )
            {
                $id_item = (int) $request['id_item'];
                $price = (float)$request['price'];
                $top = (float)$request['top_price'];
                $top2 = (float)$request['top_price2'];

                $price = round($price, 2);
                $top = round($top, 2);
                $top2 = round($top2, 2);

                DB::table('size')->insert([
                    'Sz_Item' => $id_item,
                    'Sz_Descrip' => $request['descrip'],
                    'Sz_Abrev' => $request['abrev'],
                    'Sz_Price' => $price,
                    'Sz_Topprice' => $top,
                    'Sz_Topprice2' => $top2,
                    'Sz_FArea' => $request['area'],
                    'Sz_Status' => 1,
                ]);
                return response()->json("New Size");
            }
        }


        return response()->json("error");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = DB::table('items')
            ->join('groups', 'groups.Gr_ID', '=', 'items.It_Groups')
            ->where('It_Id', $id)
            ->get();

        $sizes = "";
        
        if($item)
        {
            $item = $item[0];
            $item_id = $item->It_Id;
            $sizes = DB::table('size')
                ->where('Sz_Item', $item_id)
                ->get();
        }

        $groups = DB::table('groups')->get();
        $food = DB::table('food')->get();
        
        return view('admin.items.show')->with([
            'item'=>$item, 
            'sizes'=>$sizes, 
            'groups'=>$groups, 
            'food'=>$food
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$respuesta=[];

        if ( isset($request['edit_item']) )
        {
            $update = [];

            if($request['name']!="")
                $update['It_Descrip'] = $request['name'];
            
            if($request['descrip']!="")
                $update['description'] = $request['descrip'];
            
            if($request['category']!="")
                $update['It_Groups'] = (int)$request['category'];
            
            if( count($update) )
                DB::table('items')
                    ->where('It_Id', $id)
                    ->update($update);

            $respuesta = ['state'=>'Changed'];
        }


        if ( isset($request['id']) )//
        {

            $update = [];

            if($request['descrip']!="")
                $update['Sz_Abrev'] = $request['descrip'];
            if($request['price']!="")
                $update['Sz_Price'] = (float)$request['price'];
            if($request['top_price']!="")
                $update['Sz_Topprice'] = (float)$request['top_price'];
            
            if( count($update) )
                DB::table('size')
                    ->where('Sz_Id', $request['id'])
                    ->update($update);

            $respuesta = ['state'=>'Changed'];
        }


        if( isset($request['item_visible']) )
        {
            $status  = (int)$request['status'];
            
            DB::table('items')
                ->where('It_Id', $id)
                ->update(['It_Status'=>$status]);
            
            $respuesta = ['state'=>'Changed'];
        }

        if( isset($request['change_visible']) )
        {
            $status  = (int)$request['status'];
            
            DB::table('size')
                ->where('Sz_Id', $request['change_visible'])
                ->update(['Sz_Status'=>$status]);
            
            $respuesta = ['state'=>'Changed'];
        }

        if( !count($respuesta) )
             $respuesta = ['state'=>'No'];
        
        return response()->json($respuesta);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
