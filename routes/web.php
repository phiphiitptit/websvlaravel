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
Route::middleware(['auth'])->group(function(){
    Route::get('/home', 'UserDataController@getData')->name('home');
    Route::get('/userprofile/{userId}', [
        'as'    => 'userprofile',
        'uses'  => 'UserDataController@profile'
    ]);
    Route::get('/useraddMessage/{id}', [
        'as'    => 'useraddMessage',
        'uses'  => 'UserMessageController@showForm'
    ]); 
    Route::post('/useraddMessage/{id}', [
        'as'    => 'useraddMessage',
        'uses'  => 'UserMessageController@sendMessage'
    ]); 
    Route::get('/userMessage', [
        'as'    => 'userMessage',
        'uses'  => 'UserMessageController@getData'
    ]); 
    Route::get('/userViewMessage/{id}', [
        'as'    => 'userViewMessage',
        'uses'  => 'UserMessageController@viewMessage'
    ]); 
    Route::get('/userEditMessage/{id}', [
        'as'    => 'userEditMessage',
        'uses'  => 'UserMessageController@editMessage'
    ]); 
    Route::get('/userSeenMessage/{id}', [
        'as'    => 'userSeenMessage',
        'uses'  => 'UserMessageController@seenMessage'
    ]);
    Route::post('/userEditMessage/{id}', [
        'as'    => 'userEditMessage',
        'uses'  => 'UserMessageController@updateMessage'
    ]); 
    Route::get('/userDeleteMessage/{id}', [
        'as'    => 'userDeleteMessage',
        'uses'  => 'UserMessageController@deleteMessage'
    ]); 
    Route::get('/userHomework', [
        'as'    => 'userHomework',
        'uses'  => 'UserHomeworkController@getData'
    ]); 
    Route::get('/userDownloadHomework/{id}', [
        'as'    => 'userDownloadHomework',
        'uses'  => 'UserHomeworkController@downloadHomework'
    ]); 
    Route::get('/uploadHomework/{id}', [
        'as'    => 'uploadHomework',
        'uses'  => 'UserHomeworkController@getHomework'
    ]); 
    Route::post('/uploadHomework/{id}', [
        'as'    => 'uploadHomework',
        'uses'  => 'UserHomeworkController@uploadHomework'
    ]); 
    Route::get('/userChallenge', [
        'as'    => 'userChallenge',
        'uses'  => 'UserChallengeController@getData'
    ]); 
    Route::get('/userViewChallenge/{id}', [
        'as'    => 'userViewChallenge',
        'uses'  => 'UserChallengeController@showChallenge'
    ]); 
    Route::post('/userSubChallenge', [
        'as'    => 'userSubChallenge',
        'uses'  => 'UserChallengeController@subChallenge'
    ]);
    Route::get('/userEditUser', [
        'as'    => 'userEditUser',
        'uses'  => 'UserDataController@showUser'
    ]);
    Route::post('/userEditprofile', [
        'as'    => 'userEditprofile',
        'uses'  => 'UserDataController@editUser'
    ]);
  
});
Route::get('/admin/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Admin\Auth\LoginController@login')->name('admin.login');
Route::middleware(['admin'])->group(function(){
    Route::get('/admin/dashboard', 'Admin\AdminUserDataController@getData')->name('admin.dashboard');
    Route::any('/profile/{userId}', [
        'as'    => 'profile',
        'uses'  => 'Admin\AdminUserDataController@viewProfile'
    ]);
    Route::get('/editUser', [
        'as'    => 'editUser',
        'uses'  => 'Admin\AdminUserDataController@showUser'
    ]);
    Route::post('/editUser', [
        'as'    => 'editUser',
        'uses'  => 'Admin\AdminUserDataController@editUser'
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
    Route::get('/downloadSubHomework/{id}', [
        'as'    => 'downloadSubHomework',
        'uses'  => 'Admin\AdminHomeworkController@downloadSubHomework'
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
    Route::get('/viewMessage/{id}', [
        'as'    => 'viewMessage',
        'uses'  => 'Admin\AdminMessageController@viewMessage'
    ]);
    Route::get('/editMessage/{id}', [
        'as'    => 'editMessage',
        'uses'  => 'Admin\AdminMessageController@editMessage'
    ]);
    Route::post('/editMessage/{id}', [
        'as'    => 'editMessage',
        'uses'  => 'Admin\AdminMessageController@updateMessage'
    ]);
    Route::get('/seenMessage/{id}', [
        'as'    => 'seenMessage',
        'uses'  => 'Admin\AdminMessageController@seenMessage'
    ]);
    Route::get('/deleteMessage/{id}', [
        'as'    => 'deleteMessage',
        'uses'  => 'Admin\AdminMessageController@deleteMessage'
    ]);
    Route::post('/addMessage/{id}', [
        'as'    => 'addMessage',
        'uses'  => 'Admin\AdminMessageController@sendMessage'
    ]);
    Route::post('/admin/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
});