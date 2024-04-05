<?php
Route::middleware(['auth'])->group(function () {
    Route::name('secure.')->group(function () {
        Route::namespace('App\Http\Controllers\Secure')->group(function () {

            Route::get('/home', "HomeController@index")->name('home.index');
            Route::get('/logout', "HomeController@logout")->name('home.logout');

            Route::prefix('devices')->group(function () {
                Route::name('devices.')->group(function () {
                    Route::get('/get-data', "DeviceController@getData")->name('getData');
                    Route::get('/add', "DeviceController@add")->name('add');
                    Route::get('/edit/{id}', "DeviceController@edit")->name('edit');
                    Route::post('/create', "DeviceController@create")->name('create');
                    Route::post('/update', "DeviceController@update")->name('update');
                    Route::post('/delete/{id}', "DeviceController@del")->name('delete');

                });
            });
        });
    });
});
