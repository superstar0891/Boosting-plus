<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/forget', [AuthController::class, 'forget_password']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->name('.products')->group(function () {
    Route::get('/', 'Api\ProductController@index');
});

Route::prefix('productaddons')->name('.productaddons')->group(function () {
    Route::get('/', 'Api\ProductAddonsController@index');
});

Route::prefix('boostpricescheme')->name('.boostpricescheme')->group(function () {
    Route::get('/', 'Api\BoostPriceSchemeController@index');
});

Route::prefix('placement')->name('.placement')->group(function () {
    Route::get('/', 'Api\PlacementController@index');
});

Route::prefix('games')->name('.games')->group(function () {
    Route::get('/', 'Api\GameController@index');
});

Route::prefix('discountcodes')->name('.discountcodes')->group(function () {
    Route::get('/', 'Api\DiscountCodeController@index');
});

Route::prefix('orders')->name('.orders')->group(function () {
    Route::get('/', 'Api\OrderController@index');
});

Route::prefix('completedOrders')->name('.completedOrders')->group(function () {
    Route::get('/', 'Api\OrderController@completedOrders');
});


Route::prefix('customers')->name('.customers')->group(function () {
    Route::get('/', 'Api\CustomerController@index');
});

Route::prefix('boosters')->name('.boosters')->group(function () {
    Route::get('/', 'Api\BoosterController@index');
});

Route::prefix('ranks')->name('.ranks')->group(function () {
    Route::get('/', 'Api\RankController@index');
});

Route::prefix('games')->name('.games')->group(function () {
  Route::match(['get', 'post'], '/get_level_via_rankname','Api\RankController@get_level_via_rankname')->name('.get_level_via_rankname');
  Route::match(['get', 'post'], '/get_rank_price','Api\RankController@get_rank_price')->name('.get_rank_price');
});
