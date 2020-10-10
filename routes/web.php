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
    Route::post('/addHomework', [
        'as'    => 'addHomework',
        'uses'  => 'Admin\AdminHomeworkController@addHomework'
    ]);
    Route::get('/challenge', [
        'as'    => 'challenge',
        'uses'  => 'Admin\AdminChallengeController@getData'
    ]);
    Route::post('/admin/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
});