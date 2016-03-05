<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;

class CategoriesCTRL extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('category')
        	->join('groups', 'groups.Gr_ID', '=', 'category.group_id')
        	->select(
        		'category.id',
        		'category.name', 
        		'category.name_cat', 
        		'groups.Gr_Descrip', 
        		'category.Status'
        	)
        	->paginate(15);


        $groups = DB::table('groups')->get();

        return view('admin.categories.index')->with(['categories'=>$categories, 'groups'=>$groups]);
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
        if(
            $request['name'] &&
            $request['url'] &&
            $request['group']
        )
        {    
            DB::table('category')->insert([
                'name' => $request['name'],
                'name_cat' => $request['url'],
                'group_id' => $request['group'],
                'submenu_cat' => $request['sub'],
                'Status' => 1
            ]);

            return response()->json("created");
        }
        return response()->json([
            "Empty",
            'name' => $request['name'],
            'url' => $request['url'],
            'group' => $request['group'],
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = DB::table('category')
            ->join('groups', 'groups.Gr_ID', '=', 'category.group_id')
            ->where('id', $id)
            ->first();

        $groups = DB::table('groups')->get();

        if( !isset($category) )
            $category = "";

        return view('admin.categories.category')->with(['category'=>$category, 'groups'=>$groups]);
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
        if( isset($request['change_visible']) )
        {
            $id = (int)$id;
            if( $id != 0 )
            {
                $status  = (int)$request['status'];

                DB::table('category')
                ->where('id', $id)
                ->update(['Status'=>$status]);

                $respuesta = ['state'=>'Changed'];
            }
            else
                $respuesta ="empty";
        }

        if($request['cambios'])
        {
            $update=[];
            
            if( !empty($request['category']) )
                $update['group_id'] = $request['category'];

            if( count($update) )
                DB::table('category')
                    ->where('id', $id)
                    ->update($update);

            $respuesta = ['state'=>'update'];
            
        }
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
