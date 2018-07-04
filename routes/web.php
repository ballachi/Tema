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

use Illuminate\Http\Request;

Route::get('/', function () {
    $todo = \App\Todo::orderBy('created_at','asc')->get();
    $tag = \App\Tag::orderBy('created_at','asc')->get();
    return view('welcome',
        ['todo'=>$todo, 'tags'=>$tag]);
});



Route::get('/tag', function () {
	$tag = \App\Tag::orderBy('created_at','asc')->get();
    return view('tags',
    	['tags'=>$tag
	]);
});


Route::post('/tag','TagController@add');
Route::post('/tagupdate/{tag}','TagController@update');
Route::delete('/tag/{tag}','TagController@delete');
Route::get('/find','TodoController@find');
Route::get('/edittag2', 'TodoController@updatetag');
Route::get('/edittag', 'TodoController@edittag');
Route::get('/uploadfile', 'TagController@index');
Route::post('/uploadfile', 'TodoController@upload');
Route::get('/edittodo', 'TodoController@edit');