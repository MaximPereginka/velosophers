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
 * Blog routes
 */
Route::get('/administrator/blog', 'BlogController@index');
Route::get('/administrator/blog/own', 'BlogController@own');
Route::get('/administrator/blog/create', 'BlogController@create');
Route::post('/administrator/blog', 'BlogController@store');
Route::get('/administrator/blog/edit/{article}', 'BlogController@edit');
Route::patch('/administrator/blog/edit/{article}/update', 'BlogController@update');
Route::post('/administrator/blog/destroy', 'BlogController@destroy');
