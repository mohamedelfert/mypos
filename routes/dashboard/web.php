<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

        Route::get('/index', 'DashboardController@index')->name('index');

        // users routes
        Route::resource('/users', 'UserController');
        Route::patch('/users/profile/{id}', 'UserController@profile')->name('users.profile');

    });

});
