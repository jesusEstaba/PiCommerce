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

        return view('admin.categories.index')->with(['categories'=>$categories]);
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
        $category = DB::table('category')
            ->where('id', $id)
            ->get();

        if($category)
        {
            $category = $category[0];
        }
        else
            $category = "";

        return view('admin.categories.category')->with(['category'=>$category]);
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

        return $respuesta;
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
