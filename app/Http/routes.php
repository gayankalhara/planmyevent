<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('sendmail', function () {
    Mail::raw('Laravel with Mailgun is easy!', function($message)
    {
        $message->to('gayan.csnc@gmail.com')->subject('Learning Laravel test email');;
    });

    return "Your email has been sent successfully";
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::auth();
    Route::get('/', 'HomeController@index');
});

Route::get('/terms', function () {
    return 'Terms and Conditions';
});

Route::get('/profile', function () {
    return 'Profile';
});

Route::get('/settings', function () {
    return 'Settings';
});

Route::get('/all-notifications', function () {
    return 'All Notifications';
});

Route::get('/mails/new', function () {
    return 'New Message';
});

Route::get('/mails/inbox', function () {
    return 'Inbox';
});

Route::get('/mails/sent', function () {
    return 'Sent Messages';
});