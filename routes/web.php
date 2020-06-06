<?php

use Illuminate\Support\Facades\Route;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

Route::group(['prefix' => 'category'], function() {
    Route::get('all', 'CategoryController@getAll');
    Route::get('repartItemByUser', 'CategoryController@getRepartForUser');
});

Route::group(['prefix' => 'borrow'], function(){
    Route::get('waitingLend', 'BorrowController@getMyWaitingLend');
    Route::get('runningBorrow', 'BorrowController@getMyRunningBorrow');
});

Route::group(['prefix' => 'item'], function(){
    Route::post('set', 'ItemController@setItem');
});