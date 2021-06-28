<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/orders')->group(function () {
    route::post('/','OrderController@create');
    route::get('/','OrderController@index');
});

Route::prefix('/foods')->group(function () {
    route::post('/','FoodController@index');
    route::get('/{id}','FoodController@show');
});

Route::prefix('/ingredients')->group(function () {
    route::get('/','IngredientController@index');
});

Route::prefix('/orderbuy')->group(function () {
    route::get('/purchases','OrderbuyController@purchases');
});
