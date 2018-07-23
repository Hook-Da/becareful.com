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
//Comments
Route::post('comments/{post_id}',['uses'=>'CommentsController@store','as'=>'comments.store']);
Route::get('comments/{id}/edit',['uses'=>'CommentsController@edit','as'=>'comments.edit']);
Route::put('comments/{id}',['uses'=>'CommentsController@update','as'=>'comments.update']);
Route::delete('comments/{id}',['uses'=>'CommentsController@destroy','as'=>'comments.destroy']);
Route::get('comments/{id}/delete',['uses'=>'CommentsController@delete','as'=>'comments.delete']);

Route::resource('tags','TagController',['except'=>'create']);
Route::resource('categories','CategoryController',['except'=>'create']);
// Password Reset Routes
//{token?} we have question mark because won't have token every single time
//Route::get('password/reset/{token?}',['uses'=>'Auth\ResetPasswordController@showResetForm','as'=>'password/reset']);
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');//->name('password.request')
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//Authentication Routes
Route::get('auth/login','Auth\LoginController@getLogin');
Route::post('auth/login','Auth\LoginController@postLogin');
//Route::post('auth/logout',['as'=>'auth/logout','uses'=>'Auth\LoginController@getLogout']);

// Register
Route::get('auth/register','Auth\RegisterController@getRegister');
Route::post('auth/register','Auth\RegisterController@postRegister');

Route::get('blog/{slug}',['as'=>'blog.single','uses'=>'BlogController@getSingle'])->where('slug','[\w\d\-\_]+');

Route::get('blog',['uses'=>'BlogController@getIndex','as'=>'blog.index']);

Route::get('contact', 'PagesController@getContact');

Route::post('contact','PagesController@postContact');

Route::get('about', 'PagesController@getAbout');
Route::get('/','PagesController@getIndex');

Route::get('create','PostController@create');

Route::resource('posts','PostController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); 
