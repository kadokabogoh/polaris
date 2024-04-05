<?php
Route::namespace('App\Http\Controllers\Frontpage')->group(function () {
    Route::name('frontpage.')->group(function () {
        Route::name('login.')->group(function () {
            Route::get('/', "LoginController@index")->name('index');
            Route::post('/', "LoginController@doLogin")->name('doLogin');
        });

    });
});
