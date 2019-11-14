<?php

Route::group(['prefix' => 'user'], function(){

    Route::get('', 'Cms\UserController@index')->name('user');
    Route::get('/customer', 'Cms\UserController@customer')->name('user.customer');
    Route::get('/create/{role}', 'Cms\UserController@create')->name('user.create');
    Route::post('/create/{role}', 'Cms\UserController@store')->name('user.create');
    Route::get('/update/{id}', 'Cms\UserController@edit')->name('user.update');
    Route::post('/update/{id}', 'Cms\UserController@update')->name('user.update');
    Route::get('/destroy/{id}', 'Cms\UserController@destroy')->name('user.delete');
    Route::get('/toggle/{id}', 'Cms\UserController@toggle')->name('user.toggle');
    Route::post('/datatable', 'Cms\UserController@dataTable')->name('user.data-table');

});

