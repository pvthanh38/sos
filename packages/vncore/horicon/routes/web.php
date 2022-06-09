<?php

Route::namespace('VNCore\Horicon\Controllers')->middleware(['web', 'auth'])->group(function () {
    // Routes defined here have the web middleware applied
    // like the web.php file in a laravel project
    // They also have an applied controller namespace and a route names.

    Route::middleware('horicon')->name('horicon.')->group(function () {

        // [START] Common
        Route::middleware('role:staff')->namespace('Common')->group(function () {
            // The dashboard
            Route::get('dashboard', 'DashboardController@index')->name('index');

            // The notifications
            Route::prefix('notifications')->name('notifications.')->group(function () {
                Route::get('', 'NotificationController@index')->name('index');
                Route::post('', 'NotificationController@readAll')->name('read_all');
                Route::get('get/unread', 'NotificationController@getUnread')->name('get_unread');
            });
        });
        // [END] Common

        // [START] Settings
        Route::namespace('Settings')->prefix('settings')->name('settings.')->group(function () {
            Route::get('profile', 'ProfileSettingsController@index')->name('profile');
            Route::post('profile', 'ProfileSettingsController@store');

            Route::get('account', 'AccountSettingsController@index')->name('account');
            Route::post('account', 'AccountSettingsController@store');
        });
        // [END] Settings

        // [START] Admin
        Route::middleware('role:admin')->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
            Route::get('', 'AdminController@index')->name('index');

            // The Users
            Route::resource('users', 'UserController');

            Route::get('distance', 'EnvController@distance')->name('env.distance');
            Route::post('distance', 'EnvController@distanceStote')->name('env.distance.stote');

            Route::get('date', 'EnvController@date')->name('env.date');
            Route::post('date', 'EnvController@dateStote')->name('env.date.stote');
        });
        // [END] Admin

        // [START] CMS
        Route::middleware('role:staff')->namespace('Cms')->prefix('cms')->name('cms.')->group(function () {
            // The FAQs
            Route::resource('faqs', 'FaqController')->only([
                'index', 'show', 'edit', 'update', 'destroy'
            ]);
            Route::post('faqs/{faq}/comment/store', 'FaqController@storeComment')->name('faqs.store.comment');

            // The Blog
            Route::namespace('Blog')->prefix('blog')->name('blog.')->group(function () {
                Route::resource('categories', 'CategoryController');
                Route::resource('posts', 'PostController');
            });

            // The SOS
            Route::namespace('Sos')->prefix('sos')->name('sos.')->group(function () {
                Route::get('companies/import', 'CompanyController@import')->name('companies.import');
                Route::post('companies/import', 'CompanyController@importStore')->name('companies.import.store');
                Route::resource('companies', 'CompanyController');

                Route::resource('contracts', 'ContractController');
                Route::get('contracts/download/{sosContract}', 'ContractController@download')->name('contracts.download');

                Route::get('contracts/{sosContract}/location/create', 'ContractController@createLocation')->name('contracts.create.location');
                Route::post('contracts/{sosContract}/location/store', 'ContractController@storeLocation')->name('contracts.store.location');
                Route::get('contracts/{sosContractLocation}/location/destroy', 'ContractController@destroyLocation')->name('contracts.destroy.location');

                Route::get('users/export', 'UserController@export')->name('users.export');
                Route::get('users/export/show', 'UserController@exportStore')->name('users.export.store');
                Route::get('users/export/download', 'UserController@exportDownload')->name('users.export.download');
                Route::get('users/import', 'UserController@import')->name('users.import');
                Route::post('users/import', 'UserController@importStore')->name('users.import.store');
                Route::get('users/{sosUser}/location', 'UserController@location')->name('users.location');
                Route::get('users/wrong-location/download', 'UserController@wrongLocationDownload')->name('users.wronglocation.download');
                Route::resource('users', 'UserController');

                Route::get('supports/download', 'SupportController@download')->name('supports.download');
                Route::resource('supports', 'SupportController');
                Route::get('supports/{sosSupport}/show2', 'SupportController@show2')->name('supports.show2');
                Route::post('supports/{sosSupport}/comment/store', 'SupportController@storeComment')->name('supports.store.comment');
                Route::post('supports/{sosSupport}/adminComment/store', 'SupportController@storeAdminComment')->name('supports.store.adminComment');
                Route::post('supports/{sosSupport}/close', 'SupportController@close')->name('supports.close');

                Route::resource('notifications', 'NotificationController');

                Route::resource('contacts', 'ContactController');

                Route::resource('questions', 'AskedQuestionController');
            });
        });
        // [END] CMS

    });
});
