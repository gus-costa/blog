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

Route::get('/', 'PagesController@getIndex')->name('home');

Route::get('about', 'PagesController@getAbout')->name('about');

Route::get('contact', 'PagesController@getContact')->name('contact');
Route::post('contact', 'PagesController@postContact')->name('submitContact');

Route::get('/post/{id}', 'PagesController@redirectToSlug')->where('id', '[\d]+');
Route::get('/post/{slug}', 'PagesController@showPost')->name('post.view')->where('slug', '[\w\d\-\_]+');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@indexPage')->name('admin.index');
    Route::get('/info', 'AdminController@infoPage')->name('admin.info');

    Route::resource('category', 'CategoryController');

    Route::resource('post', 'PostController');

    Route::resource('tag', 'TagController');

    Auth::routes(['register' => false, 'reset' => false]);
});
