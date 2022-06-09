<?php

Route::namespace('VNCore\Horicon\Controllers\Api')->middleware('auth:api')->group(function () {
    Route::prefix('api')->name('horicon.api.')->group(function () {

        Route::get('sos', 'SupportController@index')->name('index');
        Route::post('sos', 'SupportController@store')->name('store');
        Route::post('closeSos', 'SupportController@close')->name('close');

        Route::get('sosConversation/{id}', 'ConversationController@index')->name('index');
        Route::post('sosContent', 'ConversationController@store')->name('store');

        Route::post('changePassword', 'UserController@changePassword')->name('changePassword');
        Route::post('changeSecurityQuestion', 'UserController@changeSecurity')->name('changeSecurity');
        Route::post('editUser', 'UserController@editUser')->name('editUser');
        Route::post('editUserLocation', 'UserController@editUserLocation')->name('editUserLocation');
        Route::post('editUserFCM', 'UserController@editUserFCM')->name('editUserFCM');
        Route::post('editAvatar', 'UserController@editAvatar')->name('editAvatar');
        Route::get('getInfo', 'UserController@getInfo')->name('getInfo');

        Route::post('sendQA', 'FAQController@sendQA')->name('sendQA');
        Route::post('commentQA', 'FAQController@commentQA')->name('commentQA');
        Route::get('listQA', 'FAQController@listQA')->name('listQA');
        Route::get('QAContent/{id}', 'FAQController@QAContent')->name('QAContent');

        Route::post('sendContact', 'ContactController@sendContact')->name('sendContact');

        Route::get('questions', 'QuestionController@questions')->name('questions');
    });
});

Route::namespace('VNCore\Horicon\Controllers\Api')->middleware('api')->group(function () {
    Route::prefix('api')->name('horicon.api.')->group(function () {
        Route::get('notifications', 'NotificationController@index')->name('index');

        Route::post('createPassword', 'UserController@store')->name('store');
        Route::post('countInstall', 'UserController@countInstall')->name('countInstall');

        Route::get('listQuestion', 'QuestionController@index')->name('index');

        Route::post('forgetPassword', 'UserController@forgetPassword')->name('forgetPassword');
    });
});