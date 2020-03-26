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

Route::get('/view', function () {
    //return view('admin.index');
    return view('store.view');
});

Route::get('/', 'StoreController@index');
Route::get('/view/{id}', 'StoreController@getView');

Route::resource('category','CategoryController');

Route::resource('post','PostController');
