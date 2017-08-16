<?php

use App\Http\Controllers\OrdersController;

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

Route::resource('orders',   'OrdersController');
Route::get('/',             'OrdersController@index');
Route::get('home',             'OrdersController@home');
//Route::get('/{id}',     'OrdersController@show');

//Route::get('/items/{item_id}', 'ItemsController@show');

Route::post('add',          'ItemsController@add');
//Route::post('remove',       'ItemsController@remove');
//Route::get('delete',         'ItemsController@destroy');
Route::post('save',        'OrdersController@store');
Route::post('itemSave',        'ItemsController@store');


