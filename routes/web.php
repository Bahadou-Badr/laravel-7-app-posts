<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function(){
    return view('welcome');
});
Route::get('/home', 'HomeController@home')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/secret', 'HomeController@secret')->name('secret')->middleware('can:secret.page');

Route::get('/posts/archive', 'PostController@archive');
Route::patch('/posts/{post}/restore', 'PostController@restore');
Route::delete('/posts/{post}/forcedelete', 'PostController@forcedelete');

Route::get('/posts/all', 'PostController@all');

Route::get('/posts/tag/{id}', 'PostTagController@index')->name('posts.tag.index');
Route::resource('posts.comments', 'PostCommentController')->only(['store']);
Route::resource('users.comments', 'UserCommentController')->only(['store']);

Route::resource('/posts','PostController');
Auth::routes();

Route::resource('users','UserController')->only(['show' ,'edit' ,'update']);

Route::get('/home', 'HomeController@index')->name('home');
