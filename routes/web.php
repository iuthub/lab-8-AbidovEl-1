<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', [
    'uses' => 'PostController@getIndex',
    'as' => 'index'
]);

Route::get('/post/{id}', [
    'uses' => 'PostController@getPost',
    'as' => 'post'
]);

Route::get('about', function (){
    return view('other.about');
})->name('about');

Route::group(['prefix' => 'admin','as' => 'admin.'], function () {
    Route::get('', [
        'uses' => 'PostController@getAdminIndex',
        'as' => 'index'
    ]);

    Route::get('create', [
        'uses' => 'PostController@getAdminCreate',
        'as' => 'create'
    ]);

    Route::post('create', [
        'uses' => 'PostController@postAdminCreate',
        'as' => 'create'
    ]);

    Route::get('edit/{id}', [
        'uses' => 'PostController@getAdminEdit',
        'as' => 'edit'
    ]);

    Route::post('edit', [
        'uses' => 'PostController@postAdminUpdate',
        'as' => 'update'
    ]);
});

