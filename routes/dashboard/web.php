<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

        Route::get('/index', 'DashboardController@index')->name('index');

        // categories routes
        Route::resource('/categories', 'CategoryController');

        // products routes
        Route::resource('/products', 'ProductController');

        // clients routes
        Route::resource('/clients', 'ClientController');
        Route::resource('/clients.orders', 'Client\OrderController');

        // orders route
        Route::resource('/orders', 'OrderController');
        Route::get('/orders/{order}/products', 'OrderController@products')->name('orders.products');

        // users routes
        Route::resource('/users', 'UserController');
        Route::patch('/users/profile/{id}', 'UserController@profile')->name('users.profile');

        // setting routes
        Route::resource('/settings', 'SettingController');

    });

});
