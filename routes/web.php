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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index');

Route::get('/post/{id}', ['as' => 'home.post', 'uses' => 'AdminPostController@post']);

Route::group(['middleware'=>'admin'], function() {
    Route::get('/admin', ['as' => 'admin.index', function(){
        return view('admin.index');
    }]);

    Route::resource('/admin/users', 'AdminUserController', ['names' => [
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'delete' => 'admin.users.delete',
        'destroy' => 'admin.users.destroy',
    ]]);

    Route::resource('/admin/posts', 'AdminPostController', ['names' => [
        'index' => 'admin.posts.index',
        'create' => 'admin.posts.create',
        'store' => 'admin.posts.store',
        'show' => 'admin.posts.show',
        'edit' => 'admin.posts.edit',
        'update' => 'admin.posts.update',
        'delete' => 'admin.posts.delete',
        'destroy' => 'admin.posts.destroy',
    ]]);

    Route::resource('/admin/categories', 'AdminCategoryController', ['names' => [
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'show' => 'admin.categories.show',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'delete' => 'admin.categories.delete',
        'destroy' => 'admin.categories.destroy',
    ]]);

    Route::resource('/admin/media', 'AdminMediaController', ['names' => [
        'index' => 'admin.media.index',
        'create' => 'admin.media.create',
        'store' => 'admin.media.store',
        'show' => 'admin.media.show',
        'edit' => 'admin.media.edit',
        'update' => 'admin.media.update',
        'delete' => 'admin.media.delete',
        'destroy' => 'admin.media.destroy',
    ]]);

    Route::resource('/admin/comments', 'PostCommentController', ['names' => [
        'index' => 'admin.comments.index',
        'create' => 'admin.comments.create',
        'store' => 'admin.comments.store',
        'show' => 'admin.comments.show',
        'edit' => 'admin.comments.edit',
        'update' => 'admin.comments.update',
        'delete' => 'admin.comments.delete',
        'destroy' => 'admin.comments.destroy',
    ]]);

    Route::resource('/admin/comment/replies', 'CommentReplyController', ['names' => [
        'index' => 'admin.comment.replies.index',
        'create' => 'admin.comment.replies.create',
        'store' => 'admin.comment.replies.store',
        'show' => 'admin.comment.replies.show',
        'edit' => 'admin.comment.replies.edit',
        'update' => 'admin.comment.replies.update',
        'delete' => 'admin.comment.replies.delete',
        'destroy' => 'admin.comment.replies.destroy',
    ]]);

});

Route::group(['middleware'=>'auth'], function() {
    Route::post('/comment/reply', 'CommentReplyController@createReply');

});