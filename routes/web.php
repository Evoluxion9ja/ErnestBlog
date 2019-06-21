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

Route::match(['GET', 'POST'], '/', [
    'uses' => 'PageController@index',
    'as' => '/'
]);

//Category Route
Route::match(['GET', 'POST'], '/categories', [
    'uses' => 'CategoryController@index',
    'as' => 'category.index'
]);
Route::match(['POST'], 'categories/store', [
    'uses' => 'CategoryController@store',
    'as' => 'category.store'
]);
Route::match(['GET', 'POST'], 'categories/{id}', [
    'uses' => 'CategoryController@show',
    'as' => 'category.show'
]);
Route::match(['PUT'], 'categories/{id}', [
    'uses' => 'CategoryController@update',
    'as' => 'category.update'
]);
Route::match(['DELETE'], 'categories/{id}', [
    'uses' => 'CategoryController@destroy',
    'as' => 'category.destroy'
]);

//Tag Route
Route::match(['GET', 'POST'], '/tags', [
    'uses' => 'TagController@index',
    'as' => 'tags.index'
]);
Route::match(['POST'], 'tags/store', [
    'uses' => 'TagController@store',
    'as' => 'tags.store'
]);
Route::match(['GET', 'POST'], 'tags/{id}', [
    'uses' => 'TagController@show',
    'as' => 'tags.show'
]);
Route::match(['PUT'], 'tags/{id}', [
    'uses' => 'TagController@update',
    'as' => 'tags.update'
]);
Route::match(['DELETE'], 'tags/{id}', [
    'uses' => 'TagController@destroy',
    'as' => 'tags.destroy'
]);

//Article Route
Route::match(['GET', 'POST'], '/publish', [
    'uses' => 'PostController@index',
    'as' => 'publish.index'
]);
Route::match(['POST'], 'publish/store', [
    'uses' => 'PostController@store',
    'as' => 'publish.store'
]);
Route::match(['GET', 'POST'], 'publish/{id}', [
    'uses' => 'PostController@show',
    'as' => 'publish.show'
]);
Route::match(['PUT'], 'publish/{id}', [
    'uses' => 'PostController@update',
    'as' => 'publish.update'
]);
Route::match(['DELETE'], 'publish/{id}', [
    'uses' => 'PostController@destroy',
    'as' => 'publish.destroy'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
