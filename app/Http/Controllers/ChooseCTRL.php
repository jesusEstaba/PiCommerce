<?php

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

        return view('choose')->with(['categories'=>$categories]);
    }
}
