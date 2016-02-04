<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Delete this route in production
Route::get('/pass', function () {
    return bcrypt('pass');
});
/////////////////////////////////

Route::get('/', function () {
    return view('selection');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', 'LoginCTRL@login');
Route::get('/logout', 'LoginCTRL@logout');

Route::get('/register', 'RegisterCTRL@index');
Route::post('/register', 'RegisterCTRL@register');

Route::get('/choose', function () {
    return view('choose');
});

Route::get('/category/{name_category}', 'CategoryCTRL@category');

Route::get('/product/{cat}/{id}', 'ProductCTRL@index');

Route::post('/add_to_cart', 'CartCTRL@add');

Route::group(['middleware'=>'auth'], function(){
	Route::get('/cart', 'CartCTRL@index');
    Route::get('/total_price_cart', 'CartCTRL@total_price');
});

