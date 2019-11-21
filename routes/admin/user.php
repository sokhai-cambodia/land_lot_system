<?php

Route::group(['prefix' => 'user'], function(){

    Route::get('/deleted-list', 'Admin\UserController@deletedList')->name('user.deleted-list');
    Route::get('/customer', 'Admin\UserController@customer')->name('user.customer');
    Route::get('/witness', 'Admin\UserController@witness')->name('user.witness');
    Route::get('/staff', 'Admin\UserController@staff')->name('user.staff');
    Route::get('/create/{role}', 'Admin\UserController@create')->name('user.create');
    Route::post('/create/{role}', 'Admin\UserController@store')->name('user.create');
    Route::get('/update/{role}/{id}', 'Admin\UserController@edit')->name('user.update');
    Route::post('/update/{role}/{id}', 'Admin\UserController@update')->name('user.update');
    Route::get('/toggle/{role}/{id}', 'Admin\UserController@toggle')->name('user.toggle');
    Route::post('/datatable', 'Admin\UserController@dataTable')->name('user.data-table');
    Route::post('/deleted-list-data-table', 'Admin\UserController@deletedListDataTable')->name('user.deleted-list.data-table');

    Route::post('/detail', 'Admin\UserController@detail')->name('user.detail');
});

