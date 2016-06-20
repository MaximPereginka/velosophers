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

Route::group(['middleware' => 'dashboard'], function(){
    /*
     * Author dashboard pages
     */
    Route::group(['middleware' => 'author'], function () {
            Route::get('/dashboard/author/articles/new', 'AuthorController@create_article');
        Route::post('/dashboard/author/articles/store', 'AuthorController@save_new_article');
        Route::get('/dashboard/author/articles/{article}/edit', 'AuthorController@edit_article');
        Route::patch('/dashboard/author/articles/{article}/update', 'AuthorController@update_article');
        Route::get('/dashboard/author/articles/{article}/preview', 'AuthorController@article_preview');
        Route::get('/dashboard/author/articles/{article}/moderation', 'AuthorController@send_on_moderation');
        Route::get('/dashboard/author/articles/{article}/cancel_moderation', 'AuthorController@cancel_moderation');
        Route::get('/dashboard/author/articles/{article}/unpublish', 'AuthorController@unpublish');
        Route::get('/dashboard/author/articles/{article}/delete', 'AuthorController@delete_article');
        Route::get('/dashboard/author/articles/category/{category}', 'AuthorController@category_list');
        Route::get('/dashboard/author/articles/own', 'AuthorController@own_articles_list');
    });

    /*
     * Mutual dashboard pages
     */
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/dashboard/private_office', 'DashboardController@private_office');
    Route::patch('/dashboard/user/update', 'DashboardController@user_update');
    Route::patch('/dashboard/user/update_password', 'DashboardController@user_update_password');
    Route::get('/dashboard/user/delete', 'DashboardController@user_delete');
});