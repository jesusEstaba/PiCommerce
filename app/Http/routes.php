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

// Route::get('/template/order', function ()
// {

//     $size =function ($size)
//     {
//         if($size==1)
//             $size_topping = '(All)';
//         elseif($size==2)
//             $size_topping = '(Left)';
//         elseif($size==3)
//             $size_topping = '(Rigth)';
//         elseif($size==4)
//             $size_topping = '(Extra)';
//         elseif($size==5)
//             $size_topping = '(Lite)';
//         return $size_topping;
//     };

//     $cart = Pizza\Http\Controllers\CartCTRL::searchCartItems();
//     $config = DB::table('config')->first();
//     $order_id = 567;

//     $order = DB::table('hd_tticket')->where('Hd_Ticket', $order_id)->first();
//     // $order_ticket = DB::table('dt_tticket')->where('Dt_Ticket', $order_id)->get();
//     // $order_topping = DB::table('dt_topping')->where('hd_ticket', $order_id)->get();
//     return view('mail_template.order')->with([
//         'order' => $order,
//         'now' => \Carbon\Carbon::now()->format('d-m-Y'),
//         'delivery'=>true,
//         'discount' => true,
//         'charge' => true,
//         'tip'=>true,
//         'cart'=>$cart,
//         'title'=>'Order',
//         'size'=>$size,
//         'logo' => $config->logo,
//         'footer'=> $config->footer,
//         'num_order'=>567,
//         'phone' => 4567894,
//         'name'=>'jesus',
//         'email'=>'gg@mail.com',
//         'street_num' => 34564,
//         'street_name' => 'Aguacate',
//         'zip_code' => 36478,
//     ]);
// });
// Route::get('/template/reset', function ()
// {
//     $config = DB::table('config')->first();

//     return view('mail_template.reset_password')->with([
//         'logo' => $config->logo,
//         'footer'=> $config->footer,
//         'title'=>'Reset Password',
//         'token_reset'=> md5('123456789'),
//     ]);
// });

//Route::get('/sendmail', 'SendMailCTRL@send_mail')

Route::get('/', function () {
    return redirect()->to('login');
});

Route::get('/now', 'CloseCTRL@now');
Route::get('/closed', 'CloseCTRL@index');

Route::group(['middleware'=>'hora'], function () {
    Route::get('/logout', 'LoginCTRL@logout');
    Route::get('/choose', 'ChooseCTRL@index');
    Route::get('/category/{name_category}', 'CategoryCTRL@category');
    Route::get('/product/{cat}/{id}/{sub?}', 'ProductCTRL@index');

    Route::get('/select', 'PayCTRL@select');
    Route::get('/checkout/pickup', 'PayCTRL@index');

    Route::get('/checkout/quick', 'QuickPayCTRL@index');

    Route::post('/checkout/quick/order', 'QuickPayCTRL@createOrderQuick');


    Route::get('/register', 'RegisterCTRL@index');
    Route::post('/register', 'RegisterCTRL@register');

    //Route::get('/reactivate/{email}', 'ResetPasswordCTRL@reactivate');

    Route::get('/active-your-acount', function () {
        return view('success_mail');
    });

    Route::get('/activated/{token}', 'ResetPasswordCTRL@activeAccount');

    Route::get('/add_to_cart_ajax', 'CartCTRL@back');
    Route::post('/add_to_cart_ajax', 'CartCTRL@addAjax');

    Route::get('/login', 'LoginCTRL@index');
    Route::post('/login', 'LoginCTRL@login');

    Route::get('/checkout/{select?}', 'PayCTRL@index');
    Route::get('/coupon/{coupon}', 'CouponsCTRL@return_discount');

    Route::get('/order_now', 'OrderCTRL@back');
    Route::post('/order_now', 'OrderCTRL@create');

    Route::group(['prefix'=>'reset'], function () {
        Route::get('/to/{user_mail}', 'ResetPasswordCTRL@index');

        Route::get('/{token_pass}', 'ResetPasswordCTRL@tokenPass');
        Route::post('/{token_pass}', 'ResetPasswordCTRL@changePass');
    });

    Route::group(['middleware'=>'auth'], function () {
        Route::resource('/account', 'UserAcount');
        Route::get('/cart', 'CartCTRL@index');
        Route::get('/total_price_cart', 'CartCTRL@totalCostCart');
        Route::get('/delete/item/{id}', 'CartCTRL@delete');
    });

});


#Admin Zone
Route::group(['prefix'=>'kitchen'], function () {
    Route::get('/logout', 'AdminLoginCTRL@logout');

    Route::get('/login', 'AdminLoginCTRL@index');
    Route::post('/login', 'AdminLoginCTRL@login');

    Route::group(['middleware'=>'admin_panel'], function () {
        Route::resource('/', 'DashboardCTRL');
        Route::resource('items', 'ItemCTRL');
        Route::resource('users', 'UserCTRL');
        Route::resource('categories', 'CategoriesCTRL');
        Route::resource('groups', 'GroupCTRL');
        Route::resource('choose_category', 'ChooseCatCTRL');
        Route::resource('orders', 'OrdersCTRL');
        Route::resource('coupons', 'CouponsCTRL');
        Route::resource('config', 'ConfigCTRL');
        Route::resource('logs', 'LogCTRL');
        Route::resource('emails', 'EmailAdminCTRL');
    });
});
