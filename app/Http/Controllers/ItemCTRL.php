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
        if ( $search!='' )
        {
            $items = DB::table('items')
                ->join('groups', 'items.It_Groups', '=', 'groups.Gr_Id')
                ->where('items.It_Descrip', 'like', '%'.$search.'%')
                ->select('items.It_Descrip', 'items.description', 'items.It_Status', 'groups.Gr_Descrip')
                ->paginate(15);
        }
        else
        {
            $items = DB::table('items')
                ->join('groups', 'items.It_Groups', '=', 'groups.Gr_Id')
                ->select('items.It_Id', 'items.It_Descrip', 'items.description', 'items.It_Status', 'groups.Gr_Descrip')
                ->paginate(15);
        }
        
        return view('admin.items.index')->with(['items'=>$items, 'search'=>$search]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = DB::table('items')->where('It_Id', '=', $id)->get();

        if($item)
        {
            
            $item = $item[0];
            $item_id = $item->It_Id;
            $sizes = DB::table('size')->where('Sz_Item', '=', $item_id)->get();
        }

        return view('admin.items.show')->with(['item'=>$item, 'sizes'=>$sizes]);
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
        //
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
