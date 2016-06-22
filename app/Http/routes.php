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
     * Moderator dashboard pages
     */
    Route::group(['middleware' => 'moderator'], function () {
        Route::get('/dashboard/moderator/moderation_list', 'ModeratorController@moderation_list');
        Route::get('/dashboard/moderator/article/{article}/moderation', 'ModeratorController@moderation');
        Route::get('/dashboard/moderator/article/{article}/publish', 'ModeratorController@publish');
        Route::patch('/dashboard/moderator/article/{article}/reject', 'ModeratorController@reject');
    });

    /*
     * Administrator dashboard pages
     */
    Route::group(['middleware' => 'administrator'], function () {
        Route::get('/dashboard/administrator/articles/create', 'AdministratorController@create_article');
        Route::post('/dashboard/administrator/articles/store', 'AdministratorController@store_article');
        Route::get('/dashboard/administrator/articles/{article}/edit', 'AdministratorController@edit_article');
        Route::patch('/dashboard/administrator/articles/{article}/update', 'AdministratorController@update_article');
        Route::get('/dashboard/administrator/articles/{article}/preview', 'AdministratorController@article_preview');
        Route::get('/dashboard/author/articles/{article}/delete', 'AuthorController@delete_article');
        Route::get('/dashboard/administrator/articles/own', 'AdministratorController@own_articles_list');
        Route::get('/dashboard/administrator/articles', 'AdministratorController@all_articles_list');
        Route::get('/dashboard/administrator/articles/category/{category}', 'AdministratorController@category_list');

        Route::get('/dashboard/administrator/articles/categories', 'AdministratorController@categories');
        Route::post('/dashboard/administrator/articles/categories/create', 'AdministratorController@create_category');
        Route::get('/dashboard/administrator/articles/categories/{category}/delete', 'AdministratorController@delete_category');

        Route::get('/dashboard/administrator/moderation_list', 'AdministratorController@moderation_list');
        Route::get('/dashboard/administrator/article/{article}/moderation', 'AdministratorController@moderation');
        Route::get('/dashboard/administrator/article/{article}/publish', 'AdministratorController@publish');
        Route::patch('/dashboard/administrator/article/{article}/reject', 'AdministratorController@reject');
        Route::get('/dashboard/author/users', 'AdministratorController@users_list');
        Route::get('/dashboard/author/users/create', 'AdministratorController@create_user');
        Route::post('/dashboard/author/users/store', 'AdministratorController@store_user');
        Route::get('/dashboard/author/users/{user}', 'AdministratorController@edit_user');
        Route::patch('/dashboard/author/users/{user}/update', 'AdministratorController@update_user');
        Route::patch('/dashboard/author/users/{user}/change_password', 'AdministratorController@change_password');
        Route::get('/dashboard/author/users/{user}/delete', 'AdministratorController@delete_user');
    });

    /*
     * Mutual dashboard pages
     */
    Route::get('/', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/dashboard/private_office', 'DashboardController@private_office');
    Route::patch('/dashboard/user/update', 'DashboardController@user_update');
    Route::patch('/dashboard/user/update_password', 'DashboardController@user_update_password');
});