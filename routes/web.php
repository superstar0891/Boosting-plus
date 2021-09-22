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
// Route::get('/games', function () {
//     return redirect("/contact-promotor");
// });
Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Auth::routes();

    Route::get('/logout', 'Auth\LoginController@logout');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('passwordResetForm');
    Route::get('/', 'Site\HomeController@index')->name('dashboard');
    Route::get('/loyalty', 'Site\HomeController@loyalty')->name('loyalty');
    Route::match(['get', 'post'],'/contact-promotor', 'Site\HomeController@contact_promotor')->name('contact-promotor');
    Route::match(['get', 'post'],'/contact-booster', 'Site\HomeController@contact_booster')->name('contact-booster');
    Route::get('/thankyou', 'Site\HomeController@orderComplete')->name('orderComplete');
    Route::get('/tos', 'Site\HomeController@tos')->name('tos');
    Route::post('/captureEmail', 'Site\HomeController@captureEmail')->name('captureEmail');
    Route::view('/welcome', 'home');
    //games
    Route::prefix('games')->name('games')->group(function () {
         Route::get('/', 'Site\GameController@index');
         Route::get('{game}/', 'Site\GameController@game_view')->name('.view');
         Route::get('{game}/{products}','Site\ProductController@product_view')->name('.products') ;
         Route::get('{game}/view', 'Site\GameController@view')->name('.view');
         Route::prefix('{game}/products')->name('.products')->group(function () {
              Route::get('/{product}/view', 'Site\ProductController@view')->name('.view');
        });
        Route::match(['get', 'post'], '/get_level_via_rankname','Api\RankController@get_level_via_rankname')->name('.get_level_via_rankname');
    });

    //paypal
    Route::get('status', 'Dashboard\PaypalController@getPaymentStatus');
    Route::match(['get','post'], '{product}/checkout', 'Dashboard\PaypalController@checkout')->name('checkout');



    //dashboard
    Route::group(['middleware' => 'auth'], function () {
        Route::prefix('dashboard')->name('dashboard')->group(function () {
            Route::get('/', 'Dashboard\DashboardController@index');
            Route::prefix('orders')->name('.orders')->group(function () {
                Route::get('/', 'Dashboard\OrderController@index');
                Route::get('{order}/view', 'Dashboard\OrderController@view')->name('.view');
            });
            Route::prefix('chat')->name('.chat')->group(function () {
                Route::get('/', 'Dashboard\ChatController@index');
                Route::get('/{conversation}/checkIfNewMessage', 'Dashboard\ChatController@checkIfNewMessage')->name('.checkIfNewMessage');
                Route::get('/{conversation}/view', 'Dashboard\ChatController@view')->name('.view');
                Route::match(['get', 'post'], '/{conversation}/sendMessage', 'Dashboard\ChatController@sendMessage')->name('.sendMessage');
            });
        });
    });
    Route::group(['middleware' => ['check.dashboard', 'auth']], function () {
        Route::prefix('dashboard')->name('dashboard')->group(function () {
            Route::prefix('products')->name('.products')->group(function () {
                Route::get('/', 'Dashboard\ProductController@index');
                Route::match(['get', 'post'], '/create', 'Dashboard\ProductController@createOrUpdate')->name('.create');
                Route::match(['get', 'post'], '/{product}/edit', 'Dashboard\ProductController@createOrUpdate')->name('.edit');
                Route::match(['get', 'delete'], '/{product}/delete', 'Dashboard\ProductController@delete')->name('.delete');
            });
            Route::prefix('productaddons')->name('.productaddons')->group(function () {
                Route::get('/', 'Dashboard\ProductAddonController@index');
                Route::match(['get', 'post'], '/create', 'Dashboard\ProductAddonController@createOrUpdate')->name('.create');
                Route::match(['get', 'post'], '/{addon}/edit', 'Dashboard\ProductAddonController@createOrUpdate')->name('.edit');
                Route::match(['get', 'delete'], '/{addon}/delete', 'Dashboard\ProductAddonController@delete')->name('.delete');
            });
            Route::prefix('orders')->name('.orders')->group(function () {
                Route::match(['get', 'post'], '/{order}/markAsStarted', 'Dashboard\OrderController@markAsStarted')->name('.markAsStarted');
                Route::match(['get', 'post'], '/{order}/requestLoginDetails', 'Dashboard\OrderController@requestLoginDetails')->name('.requestLoginDetails');
                Route::match(['get', 'post'], '/{order}/requestLoginDetails', 'Dashboard\OrderController@requestLoginDetails')->name('.requestLoginDetails');
                Route::match(['get', 'post'], '/{order}/claim', 'Dashboard\OrderController@claim')->name('.claim');
                Route::match(['get', 'post'], '/{order}/unclaim', 'Dashboard\OrderController@unclaim')->name('.unclaim');
                Route::match(['get', 'delete'], '/{order}/delete', 'Dashboard\OrderController@delete')->name('.delete');
            });

            Route::prefix('chat')->name('.chat')->group(function () {
                Route::match(['get', 'post'], '/{order}/startChat', 'Dashboard\ChatController@startChat')->name('.startChat');
                Route::match(['get', 'post'], '/{order}/requestLoginCode', 'Dashboard\OrderController@requestLoginCode')->name('.requestLoginCode');
                Route::match(['get', 'post'], '/{conversation}/announceWin', 'Dashboard\ChatController@announceWin')->name('.announceWin');
                Route::match(['get', 'post'], '/{conversation}/announceLose', 'Dashboard\ChatController@announceLose')->name('.announceLose');
                Route::match(['get', 'post'], '/{order}/markAsCompleted', 'Dashboard\OrderController@markAsCompleted')->name('.markAsCompleted');
            });

            Route::prefix('customers')->name('.customers')->group(function () {
                Route::get('/', 'Dashboard\CustomerController@index');
                Route::match(['get', 'delete'], '/{customer}/delete', 'Dashboard\CustomerController@delete')->name('.delete');
            });

            Route::prefix('boosters')->name('.boosters')->group(function () {
                Route::get('/', 'Dashboard\BoosterController@index');
                Route::match(['get', 'post'], '/create', 'Dashboard\BoosterController@createOrUpdate')->name('.create');
                Route::match(['get', 'post'], '/{booster}/edit', 'Dashboard\BoosterController@createOrUpdate')->name('.edit');
                Route::match(['get', 'post'], '/{booster}/impersonate', 'Dashboard\BoosterController@impersonate')->name('.impersonate');
                Route::match(['get', 'post'], '/leaveImpersonation', 'Dashboard\BoosterController@leaveImpersonation')->name('.leaveImpersonation');
                Route::match(['get', 'delete'], '/{booster}/delete', 'Dashboard\BoosterController@delete')->name('.delete');
            });
            Route::prefix('boostpricescheme')->name('.boostpricescheme')->group(function () {
                Route::get('/', 'Dashboard\BoostPriceSchemeController@index');
                Route::match(['get', 'post'], '/create', 'Dashboard\BoostPriceSchemeController@createOrUpdate')->name('.create');
                Route::match(['get', 'post'], '/{scheme}/edit', 'Dashboard\BoostPriceSchemeController@createOrUpdate')->name('.edit');
                Route::match(['get', 'delete'], '/{scheme}/delete', 'Dashboard\BoostPriceSchemeController@delete')->name('.delete');
            });
            Route::prefix('placement')->name('.placement')->group(function () {
                Route::get('/', 'Dashboard\PlacementController@index');
                Route::match(['get', 'post'], '/create', 'Dashboard\PlacementController@createOrUpdate')->name('.create');
                Route::match(['get', 'post'], '/{placement}/edit', 'Dashboard\PlacementController@createOrUpdate')->name('.edit');
                Route::match(['get', 'delete'], '/{placement}/delete', 'Dashboard\PlacementController@delete')->name('.delete');
            });
            Route::prefix('games')->name('.games')->group(function () {
                Route::get('/', 'Dashboard\GameController@index');
                Route::match(['get', 'post'], '/create', 'Dashboard\GameController@createOrUpdate')->name('.create');
                Route::match(['get', 'post'], '/{game}/edit', 'Dashboard\GameController@createOrUpdate')->name('.edit');
                Route::match(['get', 'delete'], '/{game}/delete', 'Dashboard\GameController@delete')->name('.delete');
            });
            Route::prefix('discountcodes')->name('.discountcodes')->group(function () {
                Route::get('/', 'Dashboard\DiscountCodeController@index');
                Route::match(['get', 'post'], '/create', 'Dashboard\DiscountCodeController@createOrUpdate')->name('.create');
                Route::match(['get', 'post'], '/{discountCode}/edit', 'Dashboard\DiscountCodeController@createOrUpdate')->name('.edit');
                Route::match(['get', 'delete'], '/{discountCode}/delete', 'Dashboard\DiscountCodeController@delete')->name('.delete');
            });

            Route::prefix('ranks')->name('.ranks')->group(function () {
                Route::get('/', 'Dashboard\RankController@index');
                Route::match(['get', 'post'], '/create', 'Dashboard\RankController@create')->name('.create');
                Route::match(['get', 'post'], '/{rank}/edit', 'Dashboard\RankController@update')->name('.edit');
                Route::match(['get', 'post'], '/delete/{rank}','Dashboard\RankController@delete')->name('.delete');
                Route::match(['get', 'post'], '/ajax_delete','Dashboard\RankController@ajax_delete')->name('.ajax_delete');
            });
        });
    });
});

Auth::routes();
