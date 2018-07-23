<?php
/**
 * Cumple el Estándar PSR-2
 */
namespace Pizza\Http\Controllers\admin;

use Illuminate\Http\Request;

use Pizza\Http\Requests;
use Pizza\Http\Controllers\Controller;
use DB;
use Storage;
use File;
use Input;


use Carbon\Carbon;

/**
 * Esta clase es de la categorias y tal
 * @category Categorias
 * @license license url license name
 * @author Jesus Estaba <jeec.estaba@gmail.com>
 * @link url text
 */
class CategoriesCTRL extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('groups')
            ->select(
                'Gr_Descrip AS name',#
                'Gr_Descrip',#
                'Gr_Url AS name_cat',#
                'Gr_Status AS Status',
                'Gr_ID AS id'
            )
            ->paginate(15);   
        

        $groups = DB::table('groups')->get();

        return view('admin.categories.index')->with([
            'categories' => $categories,
            'groups' => $groups
        ]);

    }//end index()


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }//end create()


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request['name'] && $request['url'] && $request['group']) {
            $insertToCategory = [
                'name' => $request['name'],
                'name_cat' => str_slug($request['url']),
                'group_id' => $request['group'],
                'submenu_cat' => $request['sub'],
                'Status' => 1
            ];

            if (!empty(Input::file('imagen'))) {
                $name = $this->uploadImageServer(
                    Input::file('imagen'),
                    'public_images_category'
                );

                if ($name) {
                    $insertToCategory['image'] = $name;
                }
                //delete dthe old element #Storage::delete('file.jpg');
            }

            DB::table('category')->insert($insertToCategory);
            return response()->json("created");
        }

        $respuesta = [
            'Empty',
            'name' => $request['name'],
            'url' => $request['url'],
            'group' => $request['group'],
        ];

        if ($request['cambios']) {
            $id = (int)$request['id'];
            $update=[];

            if (!empty($request['category'])) {
                $update['group_id'] = $request['category'];
            }

            if (!empty($request['url'])) {
                $update['name_cat'] = str_slug($request['url']);
            }

            if (!empty($request['name_category'])) {
                $update['name'] = $request['name_category'];
            }

            if (!empty(Input::file('imagen'))) {
                $image = $this->uploadImageServer(
                    Input::file('imagen'),
                    'public_images_category'
                );

                if ($image) {
                    $update['image'] = $image;
                }
                //delete dthe old element #Storage::delete('file.jpg');
            }

            if (!empty(Input::file('imagen_cat'))) {
                $image = $this->uploadImageServer(
                    Input::file('imagen_cat'),
                    'public_images_banner'
                );

                if ($image) {
                    $update['image_cat'] = $image;
                }
                //delete dthe old element #Storage::delete('file.jpg');
            }

            if (count($update)) {
                DB::table('category')
                    ->where('id', $id)
                    ->update($update);
            }

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
            ->join(
                'groups',
                'groups.Gr_ID',
                '=',
                'category.group_id'
            )
            ->where('id', $id)
            ->select(
                'category.group_id as groupId',
                'submenu_cat as submenuCat'
            )
            ->first();

        $groups = DB::table('groups')->get();

        $products = false;
        $submenuCat = 0;

        if ($category) {
            if (!$category->submenuCat) {
                $products = DB::table('items')
                            ->where('It_Groups', $category->groupId)
                            ->orderBy('It_Special')
                            ->get();
            } else {
                $idItemGroup = DB::table('items')
                            ->where('It_Groups', $category->groupId)
                            ->orderBy('It_Special')
                            ->first()
                            ->It_Id;

                $products = DB::table('size')
                            ->where('Sz_Item', $idItemGroup)
                            ->orderBy('Sz_Special')
                            ->get();

                $submenuCat = 1;
            }
        }


        if (!isset($category)) {
            $category = "";
        }

        return view('admin.categories.category')->with(
            [
            'submenu_cat'=>$submenuCat,
            'products'=>$products,
            'category'=>$category,
            'groups'=>$groups
            ]
        );
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
        if (isset($request['change_visible'])) {
            $id = (int)$id;

            if ($id != 0) {
                $status  = (int)$request['status'];

                DB::table('groups')
                ->where('Gr_ID', $id)
                ->update(['Gr_Status'=>$status]);

                $respuesta = ['state'=>'Changed'];
            } else {
                $respuesta ="empty";
            }
        }

        if ($request['order_change']) {
            $allCount = count($request['order_items']);

            $subMenus = (int)$request['sub'];

            for ($i = 0; $i < $allCount; $i++) {
                if ($subMenus) {
                    DB::table('size')
                        ->where('Sz_Id', $request['order_items'][$i])
                        ->update(['Sz_Special'=> $i+1]);
                } else {
                    DB::table('items')
                        ->where('It_Id', $request['order_items'][$i])
                        ->update(['It_Special'=> $i+1]);
                }
            }

            $respuesta = ['state'=>'Order Change'];
        }

        return response()->json($respuesta);
    }


    public static function uploadImageServer($imageFile, $diskDriver)
    {
        //if( $imagen_file->isValid() )

        $update = false;
        $name = $imageFile->getClientOriginalName();
        $extImg = $imageFile->getClientOriginalExtension();
        $name = md5(Carbon::now() . $name . rand(1024, 1280)) . '.' . $extImg;

        try {
            Storage::disk($diskDriver)->put(
                $name,
                File::get($imageFile->getRealPath())
            );

            $update = $name;
        } catch (Execption $e) {
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
