<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function () {

    #TEST ROUTES
    #Route::get('testmail/{email}', 'SendMailCTRL@test');
    #END TEST ROUTES

    Route::get('/', function () {
        return redirect()->to('login');
    });

    //Route::get('/now', 'CloseCTRL@now');
    Route::get('/closed/{type}', 'CloseCTRL@index');

    Route::group([], function () {
        Route::get('/logout', 'LoginCTRL@logout');
        Route::get('/menu', 'ChooseCTRL@index');
        Route::get('/category/{name_category}', 'CategoryCTRL@category');
        Route::get('/product/{cat}/{id}/{sub?}', 'ProductCTRL@index');



        //CHECKOUT
        Route::group(['prefix'=>'checkout'], function () {

            Route::get('/', 'PayCTRL@select');

            Route::match(['GET', 'POST'], '{name}', 'PayCTRL@index')
                ->where(['name'=>'(pickup|delivery)']);

            Route::post('/verify', 'PayCTRL@verifyTransaction');
            //Route::post('/mercuryVerify', 'OrderCTRL@verify');

            Route::get('/quick', 'QuickPayCTRL@index');
            Route::post('/quick/order', 'QuickPayCTRL@loadCartQuick');
        });


        Route::get('/register', 'RegisterCTRL@index');
        Route::post('/register', 'RegisterCTRL@register');

        //Route::get('/reactivate/{email}', 'ResetPasswordCTRL@reactivate');

        Route::get('/active-your-acount', function () {
            return view('success_mail');
        });

        Route::get('/activated/{token}', 'ResetPasswordCTRL@activeAccount');

        Route::get('/add_to_cart_ajax', function () {
            return redirect()->back();
        });
        Route::post('/add_to_cart_ajax', 'CartCTRL@addAjax');

        Route::get('/login', 'LoginCTRL@index');
        Route::post('/login', 'LoginCTRL@login');


        Route::get('/coupon/{coupon}', 'CouponsCTRL@return_discount');

        Route::get('/order_now', function () {
            return redirect()->back();
        });
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
        Route::get('/logout', 'admin\AdminLoginCTRL@logout');

        Route::get('/login', 'admin\AdminLoginCTRL@index');
        Route::post('/login', 'admin\AdminLoginCTRL@login');

        Route::group(['middleware'=>'admin_panel'], function () {
            Route::resource('/', 'admin\DashboardCTRL');
            Route::resource('items', 'admin\ItemCTRL');
            Route::resource('users', 'admin\UserCTRL');
            Route::resource('categories', 'admin\CategoriesCTRL');
            Route::resource('groups', 'admin\GroupCTRL');
            Route::resource('choose_category', 'admin\ChooseCatCTRL');
            Route::resource('orders', 'admin\OrdersCTRL');
            Route::resource('coupons', 'admin\CouponsCTRL');
            Route::resource('config', 'admin\ConfigCTRL');
            Route::resource('logs', 'admin\LogsCTRL');
            Route::resource('emails', 'admin\EmailAdminCTRL');
        });
    });


});

