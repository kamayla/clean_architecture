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


/**
 * Jwt認証関連ルーティング
 */
Route::group([
    'middleware' => ['auth:api'],
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login')
        ->withoutMiddleware(['auth:api']);

    Route::post('register', 'AuthController@register')
        ->withoutMiddleware(['auth:api']);

    Route::post('logout', 'AuthController@logout');

    Route::post('refresh', 'AuthController@refresh');

    Route::get('me', 'AuthController@me');
});

/**
 * Shopルーティング
 */
Route::group([
   'middleware' => ['auth:api'],
], function () {
    Route::post('shop', 'ShopController@store');
});

