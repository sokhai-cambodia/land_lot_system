<?php

Route::group(['prefix' => 'user'], function(){

    Route::get('/deleted-list', 'Cms\UserController@deletedList')->name('user.deleted-list');
    Route::get('/customer', 'Cms\UserController@customer')->name('user.customer');
    Route::get('/witness', 'Cms\UserController@witness')->name('user.witness');
    Route::get('/staff', 'Cms\UserController@staff')->name('user.staff');
    Route::get('/create/{role}', 'Cms\UserController@create')->name('user.create');
    Route::post('/create/{role}', 'Cms\UserController@store')->name('user.create');
    Route::get('/update/{role}/{id}', 'Cms\UserController@edit')->name('user.update');
    Route::post('/update/{role}/{id}', 'Cms\UserController@update')->name('user.update');
    Route::get('/toggle/{role}/{id}', 'Cms\UserController@toggle')->name('user.toggle');
    Route::post('/datatable', 'Cms\UserController@dataTable')->name('user.data-table');
    Route::post('/deleted-list-data-table', 'Cms\UserController@deletedListDataTable')->name('user.deleted-list.data-table');
});

