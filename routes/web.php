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

Route::get('/', 'StoreController@index');
Route::get('/post/{id}', 'StoreController@getView');

Route::group(['prefix' => 'admin'], function(){
    Route::middleware(['auth'])->get('/', function() {
        return view('admin.index');
    });

    Route::resource('category','CategoryController');
    
    Route::resource('post','PostController');

    Auth::routes(['register' => false, 'reset' => false]);
});
