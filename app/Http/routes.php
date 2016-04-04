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

/*

Route::get('/template/order', function ()
{

    return view('mail_template.order')->with([

    ]);
});

Route::get('/template/reset', function ()
{
    $config = DB::table('config')->first();

    return view('mail_template.reset_password')->with([
        'logo' => $config->logo,
        'footer'=> $config->footer,
        'title'=>'Reset Password',
        'token_reset'=> md5('123456789'),
    ]);
});

*/

#Route::get('/sendmail', 'SendMailCTRL@send_mail')

Route::get('/now', 'CloseCTRL@now');


Route::get('/closed', 'CloseCTRL@index');

;

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
    Route::get('/select', 'PayCTRL@select');
    Route::get('/checkout/quick', function(){
        return "quick";
    });

    Route::group(['prefix'=>'reset'], function()
    {
        Route::get('/{token_pass}', 'ResetPasswordCTRL@tokenPass');
        Route::get('/to/{user_mail}', 'ResetPasswordCTRL@index');
    });
    

    Route::group(['middleware'=>'auth'], function()
    {
        //Route::get('/select', 'PayCTRL@select');//borrar vista y metodo()
        Route::get('/cart', 'CartCTRL@index');
        Route::get('/total_price_cart', 'CartCTRL@total_price');
        Route::get('/delete/item/{id}', 'CartCTRL@delete');
        
        

        Route::get('/checkout/{select?}', 'PayCTRL@index');
        Route::post('/order_now', 'OrderCTRL@create');
        Route::get('/order_now', function(){
            return redirect()->back();
        });

        Route::get('/coupon/{coupon}', 'CouponsCTRL@return_discount');
    });

});


//middleware Admin
Route::group(['prefix'=>'kitchen'], function()
{
    Route::get('/login', 'AdminLoginCTRL@index');
    Route::post('/login', 'AdminLoginCTRL@login');
    
    Route::get('/logout', 'AdminLoginCTRL@logout');

    Route::group(['middleware'=>'admin_panel'], function()
    {
        Route::resource('/', 'DashboardCTRL');
        Route::resource('items','ItemCTRL');
        Route::resource('users','UserCTRL');
        Route::resource('categories','CategoriesCTRL');
        Route::resource('groups','GroupCTRL');
        Route::resource('choose_category', 'ChooseCatCTRL');
        Route::resource('orders', 'OrdersCTRL');
        Route::resource('coupons', 'CouponsCTRL');
        Route::resource('config', 'ConfigCTRL');
        Route::resource('logs', 'LogCTRL');
    });
});