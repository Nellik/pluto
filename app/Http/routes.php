<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();
Route::group(['middleware' => 'auth'], function () {
  Route::get('/home', 'HomeController@index');
  Route::resource('posts', 'PostController');
  Route::get('post/{post_id}/comments',  ['as' => 'comments', 'uses' => 'CommentController@index']);
  Route::get('post/{post_id}/comments/create',  ['as' => 'comments.create', 'uses' => 'CommentController@create']);
  Route::post('post/{post_id}/comments',  ['as' => 'comments.store', 'uses' => 'CommentController@store']);
  Route::get('post/{post_id}/comments/{comment_id}/edit',  ['as' => 'comments.edit', 'uses' => 'CommentController@edit']);
  Route::put('post/{post_id}/comments/{comment_id}',  ['as' => 'comments.update', 'uses' => 'CommentController@update']);
  Route::delete('post/{post_id}/comments/{comment_id}',  ['as' => 'comments.destroy', 'uses' => 'CommentController@destroy']);
});
