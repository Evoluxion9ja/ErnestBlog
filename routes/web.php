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
Route::match(['GET', 'POST'], '/articles', [
    'uses' => 'PageController@index',
    'as' => 'article.index'
]);
Route::match(['GET', 'POST'], 'articles/{slug}',[
    'uses' => 'PageController@single',
    'as' => 'single.index'
])->where('slug', '[\w\ \d\-\_]+');

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

//Route For Comments
Route::match(['GET', 'POST'], 'comment/{post_id}', [
    'uses' => 'CommentController@store',
    'as' => 'comment.store'
]);

Route::match(['PUT'], 'comment/{id}', [
    'uses' => 'CommentController@update',
    'as' => 'comment.update'
]);

Route::match(['DELETE'], 'comment/{id}', [
    'uses' => 'CommentController@destroy',
    'as' => 'comment.destory'
]);

//Route For Replies
Route::match(['GET', 'POST'], 'reply/{comment_id}', [
    'uses' => 'ReplyController@store',
    'as' => 'reply.store'
]);

Route::match(['PUT'], 'reply/{id}', [
    'uses' => 'ReplyController@update',
    'as' => 'reply.update'
]);

Route::match(['DELETE'], 'reply/{id}', [
    'uses' => 'ReplyController@destroy',
    'as' => 'reply.destory'
]);

//Image Route
Route::match(['GET', 'POST'], '/image-view',[
    'uses' => 'ImageController@index',
    'as' => 'image.upload'
]);

Route::match(['GET', 'POST'], '/image-submit', [
    'uses' => 'ImageController@store',
    'as' => 'image.store'
]);

Route::match(['GET', 'POST'], '/form', [
    'uses' => 'FormController@index',
    'as' => 'form.upload'
]);
Route::match(['GET', 'POST'], 'form/store', [
    'uses' => 'FormController@store',
    'as' => 'form.store'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
