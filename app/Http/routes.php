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


Route::get('/', function ()
{
    return redirect()->to('login');
});


Route::get('/now', 'CloseCTRL@now');


Route::get('/closed', 'CloseCTRL@index');

//middleware Hora




Route::group(['middleware'=>'hora'], function()
{

    Route::get('/login', 'LoginCTRL@index');
    Route::post('/login', 'LoginCTRL@login');
    Route::get('/logout', 'LoginCTRL@logout');

    Route::get('/register', 'RegisterCTRL@index');
    Route::post('/register', 'RegisterCTRL@register');

    Route::get('/choose', 'ChooseCTRL@index');

    Route::get('/category/{name_category}', 'CategoryCTRL@category');

    Route::get('/product/{cat}/{id}/{sub?}', 'ProductCTRL@index');


    Route::post('/add_to_cart_ajax', 'CartCTRL@add_ajax');
    Route::get('/add_to_cart_ajax', function(){
        return redirect()->back();
    });


    //Rutas Sesion

    Route::group(['middleware'=>'auth'], function()
    {


        Route::get('/cart', 'CartCTRL@index');
        Route::get('/total_price_cart', 'CartCTRL@total_price');
        Route::get('/delete/item/{id}', 'CartCTRL@delete');
        
        Route::get('/select', 'PayCTRL@select');

        Route::get('/pay/{select}', 'PayCTRL@index');
        Route::get('/order_now', 'OrderCTRL@create');
    });

});


//middleware Admin
Route::group(['prefix'=>'admin'], function()
{
    Route::get('/login', 'AdminLoginCTRL@index');
    Route::post('/login', 'AdminLoginCTRL@login');
    Route::get('/logout', 'AdminLoginCTRL@logout');

    Route::group(['middleware'=>'admin_panel'], function()
    {
       
        Route::get('/',function()
        {
            return view('admin.home');
        });
        Route::resource('items','ItemCTRL');
        Route::resource('users','UserCTRL');
        Route::resource('categories','CategoriesCTRL');
        Route::resource('groups','GroupCTRL');
        Route::resource('choose_category', 'ChooseCatCTRL');
        Route::resource('orders', 'OrdersCTRL');
        Route::resource('config', 'ConfigCTRL');
    });
});