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

Auth::routes([
    'register'  =>  false,  // Registration not required...
    'reset'     =>  false,  // Password Reset not required...
    'verify'    =>  false,  // Email Verification not required...
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('comments', 'CommentController@index')->name('comments.list');
    Route::post('comment/save','CommentController@save')->name('comments.save');
    Route::post('comment/delete','CommentController@delete')->name('comments.delete');
    Route::post('comment/likecomment', 'CommentController@likeComment')->name('comment.likecomment');


    Route::get('user/profile', function () {
        // Uses first & second Middleware
    });
});