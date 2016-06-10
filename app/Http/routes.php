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

Route::auth();

Route::get('/administrator', 'PagesController@administrator_index');

/*
 * Administrator blog routes
 */
Route::get('/', 'PagesController@administrator_index');
Route::get('/administrator/blog', 'BlogController@administrator_index');
Route::get('/administrator/blog/own', 'BlogController@own');
Route::get('/administrator/blog/create', 'BlogController@create');
Route::post('/administrator/blog', 'BlogController@store');
Route::get('/administrator/blog/edit/{article}', 'BlogController@edit');
Route::get('/administrator/blog/view/{article}', 'BlogController@administrator_view');
Route::patch('/administrator/blog/edit/{article}/update', 'BlogController@update');
Route::get('/administrator/blog/article/{article}/delete', 'BlogController@delete');
Route::get('/administrator/blog/category/{category}', 'BlogController@category');
Route::get('/administrator/blog/categories', 'BlogController@categories');
Route::post('/administrator/blog/categories/create', 'BlogController@create_category');
Route::get('/administrator/blog/categories/{category}/delete', 'BlogController@delete_category');

/*
 * User management pages
 */
Route::get('/administrator/users', 'UserController@index');
Route::get('/administrator/users/edit/{user}', 'UserController@edit');
Route::get('/administrator/users/create', 'UserController@create');
Route::post('/administrator/users/store', 'UserController@store');
Route::patch('/administrator/users/{user}/update', 'UserController@update');
Route::patch('/administrator/users/{user}/password', 'UserController@password');
Route::get('/administrator/users/{user}/delete', 'UserController@delete');