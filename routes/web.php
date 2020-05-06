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

Route::view('/about', 'pages.about')->name('about');

Route::view('/contact', 'pages.contact')->name('contact');
Route::post('/contact', 'PagesController@postContact')->name('submitContact');

Route::prefix('post')->group(function() {
    Route::get('/{post}', 'PagesController@redirectToSlug');
    Route::get('/{post:slug}', 'PagesController@showPost')->name('post.view');
    
    Route::post('/{post}/comments', 'CommentController@store')->name('comments.store');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@indexPage')->name('admin.index');
    Route::get('/info', 'AdminController@infoPage')->name('admin.info');

    Route::resource('category', 'CategoryController');

    Route::resource('post', 'PostController');

    Route::resource('tag', 'TagController')->except(['create', 'show']);
    
    Route::get('comments', 'CommentController@index')->name('comments.index');
    Route::post('comments/{id}/approve', 'CommentController@approve')->name('comments.approve');
    Route::delete('comments/{id}', 'CommentController@destroy')->name('comments.destroy');

    Auth::routes(['register' => false, 'reset' => false]);
});
