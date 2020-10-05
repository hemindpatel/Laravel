<?php

use Illuminate\Http\Request;
use Laravel\Scout\Searchable;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([ 'prefix' => 'auth'], function (){ 
    Route::group(['middleware' => ['guest:api']], function () {
        Route::post('login', 'API\AuthController@login');
        Route::post('signup', 'API\AuthController@signup');
    });
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'API\AuthController@logout');
        Route::get('getuser', 'API\AuthController@getUser');
    });
});

Route::group(['prefix' => 'post'], function (){
   /*Route::get('view', 'Controller@viewPost');
    Route::post('add', 'Controller@SavePost')->name('post.add');*/
    Route::post('get', 'Controller@getPost');
    Route::get('scout', 'Controller@getUser');
    Route::get('eager', function(){
        return response()->json(\App\Post::find(1)->user);
        //return response()->json(\App\Post::with('user')->get());
        //return response()->json(\App\Post::with('user:id,name')->get());
    });
});

Route::group(['prefix' => 'morph/example'], function (){
    Route::post('agent', 'Controller@addAgent');
    Route::post('user', 'Controller@addUser');
});

