<?php

use Illuminate\Http\Request;
use Laravel\Scout\Searchable;
use App\Post;
use App\Scope\PostCountScope;
use App\Http\Resources\PostCollection;

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

// Passport Authentication
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
    // Get Post Data
    Route::post('get', 'Controller@getPost');

    // API Resource Collection
    /*Route::post('get', function(){
        return new PostCollection(Post::all());
        //return PostCollection::collection(Post::all());
    });*/

    // Scout
    Route::get('scout', 'Controller@getUser');

    // Eager Loading
    Route::get('eager', function(){
        return response()->json(Post::find(1)->user);
        //return response()->json(Post::with('user')->get());
        //return response()->json(Post::with('user:id,name')->get());
    });

    // Debug Bar
    Route::get('index', 'Controller@index');

    // Scope Route
    Route::post('global/scope/get', function (){
        return response()->json(Post::select('*')->get());
    });
    Route::post('without/global/scope/get', function(){
        return response()->json(Post::select('*')->withoutGlobalScope(PostCountScope::class)->get());
    });
});

//Eloquent Morph Relation Ship
Route::group(['prefix' => 'morph/example'], function (){
    Route::post('agent', 'Controller@addAgent');
    Route::post('user', 'Controller@addUser');
});

