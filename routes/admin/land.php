<?php

Route::group(['prefix' => 'land'], function(){

    Route::get('', 'Admin\LandController@index')->name('land');
    Route::get('/create', 'Admin\LandController@create')->name('land.create');
    Route::post('/create', 'Admin\LandController@store')->name('land.create');
    Route::get('/create/land-lot', 'Admin\LandController@createLandLot')->name('land.lot.create');
    Route::post('/create/land-lot', 'Admin\LandController@storeLandLot')->name('land.lot.create');

    Route::get('/landlot/{id}', 'Admin\LandController@landLot')->name('land.landlot');

    Route::get('/update/{id}', 'Admin\LandController@edit')->name('land.update');
    Route::post('/update/{id}', 'Admin\LandController@update')->name('land.update');
    Route::get('/destroy/{id}', 'Admin\LandController@destroy')->name('land.delete');
    Route::get('/toggle/{id}', 'Admin\LandController@toggle')->name('land.toggle');
    
    Route::post('/land-lot-datatable', 'Admin\LandController@dataTableLandLot')->name('land.land-lot-datatable');

});

