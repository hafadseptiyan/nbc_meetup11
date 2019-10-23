<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'v1','namespace' => 'API\V1'], function () {
   
    /**
     * Rest api with authentication middleware
     * @return [string] message
    */
    Route::group(['middleware' => 'auth:api'], function(){
   
    /**
     * Rest api route for categories
     */
    Route::group(['namespace' => 'Category'], function () {

        Route::get('categories', 'CategoryController@index')
                ->name('api.v1.categories.index'); 
        Route::get('categories/{id}', 'CategoryController@show')
                ->name('api.v1.categories.index');
        Route::post('categories', 'CategoryController@store')
                ->name('api.v1.categories.store');
        Route::post('categories/{id}', 'CategoryController@update')
                ->name('api.v1.categories.update');
        Route::delete('categories/{id}', 'CategoryController@destroy')
                ->name('api.v1.categories.destroy');
    });

    /**
     * Rest api route for authors
     */
    Route::group(['namespace' => 'Author'], function () {
   
        Route::get('authors', 'AuthorController@index')
                ->name('api.v1.authors.index');  
        Route::get('authors/{id}', 'AuthorController@show')
                ->name('api.v1.authors.index');
        Route::post('authors', 'AuthorController@store')
                ->name('api.v1.authors.store');
        Route::post('authors/{id}', 'AuthorController@update')
                ->name('api.v1.authors.update');
        Route::delete('authors/{id}', 'AuthorController@destroy')
                ->name('api.v1.authors.destroy');
    });

    /**
     * Rest api route for publishers
     */
    Route::group(['namespace' => 'Publisher'], function () {
   
        Route::get('publishers', 'PublisherController@index')
                ->name('api.v1.publishers.index');
        Route::get('publishers/{id}', 'PublisherController@show')
                ->name('api.v1.publishers.index');
        Route::post('publishers', 'PublisherController@store')
                ->name('api.v1.publishers.store');
        Route::post('publishers/{id}', 'PublisherController@update')
                ->name('api.v1.publishers.update');
        Route::delete('publishers/{id}', 'PublisherController@destroy')
                ->name('api.v1.publishers.destroy');
    });

    /**
     * Rest api route for books
     */
    Route::group(['namespace' => 'Book'], function () {
   
        Route::get('books', 'BookController@index')
                ->name('api.v1.books.index');
        Route::get('books/{id}', 'BookController@show')
                ->name('api.v1.books.index');
        Route::post('books', 'BookController@store')
                ->name('api.v1.books.store');
        Route::post('books/{id}', 'BookController@update')
                ->name('api.v1.books.update');
        Route::delete('books/{id}', 'BookController@destroy')
                ->name('api.v1.books.destroy');
        });
    });


    /**
     * Rest api route for books
     */
    Route::group(['namespace' => 'User'], function () {
         Route::post('login', 'AuthController@login');
         Route::post('register', 'AuthController@register');
         Route::group(['middleware' => 'auth:api'], function(){
             Route::get('users', 'AuthController@index');
             Route::get('logout', 'AuthController@logout');
        });

    });
});
