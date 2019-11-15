<?php

Route::group(['prefix' => 'document'], function(){

    Route::get('/user/{userId}', 'Cms\DocumentUserController@index')->name('document.user');
    Route::get('/user/create/{userId}', 'Cms\DocumentUserController@create')->name('document.user.create');
    Route::post('/user/create/{userId}', 'Cms\DocumentUserController@store')->name('document.user.create');
    Route::get('/user/update/{userId}/{id}', 'Cms\DocumentUserController@edit')->name('document.user.update');
    Route::post('/user/update/{userId}/{id}', 'Cms\DocumentUserController@update')->name('document.user.update');
    Route::post('/user/data-table/{userId}', 'Cms\DocumentUserController@dataTable')->name('document.user.data-table');
});

