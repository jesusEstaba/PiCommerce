<?php

namespace Pizza\Http\Controllers;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;
use Storage;
use File;
use Input;


use Carbon\Carbon;

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
            $insert_to_db = [
                'name' => $request['name'],
                'name_cat' => str_slug($request['url']),
                'group_id' => $request['group'],
                'submenu_cat' => $request['sub'],
                'Status' => 1
            ];

            if( Input::file('imagen')->isValid() )
            {
                $name = $request['imagen']->getClientOriginalName();
                $ext_img = $request['imagen']->getClientOriginalExtension();
                $name = md5( Carbon::now() . $name . rand(1024, 1280) ) . '.' . $ext_img;

                try{
                
                    Storage::disk('public_images_category')
                        ->put( $name, File::get( Input::file('imagen')->getRealPath() ) );

                    $insert_to_db['image'] = $name;
                }
                catch(Execption $e){
                    echo "error al subir";
                }
            }

            DB::table('category')->insert($insert_to_db);

            return response()->json("created");
        }
          

        $respuesta = [
            "Empty",
            'name' => $request['name'],
            'url' => $request['url'],
            'group' => $request['group'],
        ];



        if($request['cambios'])
        {
            $id = (int)$request['id'];
            $update=[];
            
            if( !empty($request['category']) )
                $update['group_id'] = $request['category'];

            if( !empty($request['url']) )
                $update['name_cat'] = str_slug($request['url']);

            if( !empty($request['name_category']) )
                $update['name'] = $request['name_category'];

           
            if( !empty( Input::file('imagen') ) )
            {
                $image = $this->upload_image_sys(Input::file('imagen'), 'public_images_category');
                
                if($image)
                    $update['image'] = $image;

                //delete dthe old element #Storage::delete('file.jpg');
            }

            if( !empty( Input::file('imagen_cat') ) )
            {
               $image = $this->upload_image_sys(Input::file('imagen_cat'), 'public_images_banner');
               
               if($image)
                    $update['image_cat'] = $image;

                //delete dthe old element #Storage::delete('file.jpg');
            }


            if( count($update) )
                DB::table('category')
                    ->where('id', $id)
                    ->update($update);

            $respuesta = ['state'=>'update'];




        }





        return response()->json($respuesta);
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

        $products = false;
        $submenu_cat = 0;

        if($category)
        {
            if(!$category->submenu_cat)
            {
                $products = DB::table('items')
                            ->where('It_Groups', $category->group_id)
                            ->orderBy('It_Special')
                            ->get();
            }
            else
            {
                $id_item_group = DB::table('items')
                            ->where('It_Groups', $category->group_id)
                            ->orderBy('It_Special')
                            ->first()
                            ->It_Id;

                $products = DB::table('size')
                            ->where('Sz_Item', $id_item_group)
                            ->orderBy('Sz_Special')
                            ->get();
                
                $submenu_cat = 1;
            }
        }
        

        if( !isset($category) )
            $category = "";

        return view('admin.categories.category')->with([
            'submenu_cat'=>$submenu_cat,
            'products'=>$products,
            'category'=>$category, 
            'groups'=>$groups
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

        if($request['order_change'])
        {

            $all_count = count($request['order_items']);
            
            $sub_menus = (int)$request['sub'];

            for ($i=0; $i < $all_count; $i++)
            { 

                if($sub_menus)
                {
                    DB::table('size')
                        ->where('Sz_Id', $request['order_items'][$i])
                        ->update(['Sz_Special'=> $i+1]);
                }
                else
                {
                    DB::table('items')
                        ->where('It_Id', $request['order_items'][$i])
                        ->update(['It_Special'=> $i+1]);
                }
            }

            $respuesta = ['state'=>'Order Change'];
        }

    	return response()->json($respuesta);
    }


    public function upload_image_sys($image_file, $disk_driver)
    {
        $update = false;
        $name = $image_file->getClientOriginalName();
        $ext_img = $image_file->getClientOriginalExtension();
        $name = md5( Carbon::now() . $name . rand(1024, 1280) ) . '.' . $ext_img;
        
        try{
            Storage::disk($disk_driver)->put( $name, File::get( $image_file->getRealPath() ) );
            
            $update = $name;
        }
        catch(Execption $e){
            //
        }
        
        return $update;
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
