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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Admin\Auth\LoginController@login')->name('admin.login');
Route::middleware(['admin'])->group(function(){
    Route::get('/admin/dashboard', 'Admin\AdminUserDataController@getData')->name('admin.dashboard');
    Route::any('/profile/{userId}', [
        'as'    => 'profile',
        'uses'  => 'Admin\AdminUserDataController@viewProfile'
    ]);
    Route::get('/editprofile/{userId}', [
        'as'    => 'editprofile',
        'uses'  => 'Admin\AdminUserDataController@show'
    ]);
    Route::post('/editprofile/{userId}', [
        'as'    => 'editprofile',
        'uses'  => 'Admin\AdminUserDataController@editProfile'
    ]);
    Route::get('/delete/{userId}', 'Admin\AdminUserDataController@deleteUser');
    Route::get('/addStudent', [
        'as'    => 'addStudent',
        'uses'  => 'Admin\AdminUserDataController@showForm'
    ]);
    Route::post('/addStudent',
    [
        'as'    => 'addStudent',
        'uses'  => 'Admin\AdminUserDataController@addStudent' 
    ]);
    Route::get('/homework', [
        'as'    => 'homework',
        'uses'  => 'Admin\AdminHomeworkController@getData'
    ]);
    Route::get('/addHomework', [
        'as'    => 'addHomework',
        'uses'  => 'Admin\AdminHomeworkController@showForm'
    ]);
    Route::get('/viewHomework/{id}', [
        'as'    => 'viewHomework',
        'uses'  => 'Admin\AdminHomeworkController@viewHomework'
    ]);
    Route::get('/downloadHomework/{id}', [
        'as'    => 'downloadHomework',
        'uses'  => 'Admin\AdminHomeworkController@downloadHomework'
    ]);
    Route::get('/deleteHomework/{id}', [
        'as'    => 'deleteHomework',
        'uses'  => 'Admin\AdminHomeworkController@deleteHomework'
    ]);
    Route::post('/addHomework', [
        'as'    => 'addHomework',
        'uses'  => 'Admin\AdminHomeworkController@addHomework'
    ]);
    Route::get('/challenge', [
        'as'    => 'challenge',
        'uses'  => 'Admin\AdminChallengeController@getData'
    ]);
    Route::get('/addChallenge', [
        'as'    => 'addChallenge',
        'uses'  => 'Admin\AdminChallengeController@showForm'
    ]);
    Route::post('/addChallenge', [
        'as'    => 'addChallenge',
        'uses'  => 'Admin\AdminChallengeController@addChallenge'
    ]);
    Route::post('/subChallenge', [
        'as'    => 'subChallenge',
        'uses'  => 'Admin\AdminChallengeController@subChallenge'
    ]);
    Route::get('/viewChallenge/{id}', [
        'as'    => 'viewChallenge',
        'uses'  => 'Admin\AdminChallengeController@viewChallenge'
    ]);
    
    Route::get('/deleteChallenge/{id}', [
        'as'    => 'deleteChallenge',
        'uses'  => 'Admin\AdminChallengeController@deleteChallenge'
    ]);
    Route::get('/addMessage/{id}', [
        'as'    => 'addMessage',
        'uses'  => 'Admin\AdminMessageController@showForm'
    ]);
    Route::get('/message', [
        'as'    => 'message',
        'uses'  => 'Admin\AdminMessageController@getData'
    ]);
    Route::post('/addMessage/{id}', [
        'as'    => 'addMessage',
        'uses'  => 'Admin\AdminMessageController@sendMessage'
    ]);
    Route::post('/admin/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
});