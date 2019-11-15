<?php

Route::group(['prefix' => 'land'], function(){

    Route::get('', 'Cms\LandController@index')->name('land');
    Route::get('/create', 'Cms\LandController@create')->name('land.create');
    Route::post('/create', 'Cms\LandController@store')->name('land.create');
    Route::get('/update/{id}', 'Cms\LandController@edit')->name('land.update');
    Route::post('/update/{id}', 'Cms\LandController@update')->name('land.update');
    Route::get('/destroy/{id}', 'Cms\LandController@destroy')->name('land.delete');
    Route::get('/toggle/{id}', 'Cms\LandController@toggle')->name('land.toggle');
    Route::post('/datatable', 'Cms\LandController@dataTable')->name('land.data-table');
    Route::get('/list', 'Cms\LandController@list')->name('land.list');

});

