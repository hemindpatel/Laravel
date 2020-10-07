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

// Root Route with Welcome view
Route::get('/', function () {
    return view('welcome');
});

// View, Add and Custom Route
Route::group(['prefix' => 'post'], function () {
    Route::get('view', 'Controller@viewPost');
    Route::post('add', 'Controller@SavePost')->name('post.add');
});
