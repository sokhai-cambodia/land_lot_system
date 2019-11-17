<?php

Route::group(['prefix' => 'land'], function(){

    Route::get('', 'Cms\LandController@index')->name('land');
    Route::get('/create', 'Cms\LandController@create')->name('land.create');
    Route::post('/create', 'Cms\LandController@store')->name('land.create');
    Route::get('/create/land-lot', 'Cms\LandController@createLandLot')->name('land.lot.create');
    Route::post('/create/land-lot', 'Cms\LandController@storeLandLot')->name('land.lot.create');

    Route::get('/landlot/{id}', 'Cms\LandController@landLot')->name('land.landlot');

    Route::get('/update/{id}', 'Cms\LandController@edit')->name('land.update');
    Route::post('/update/{id}', 'Cms\LandController@update')->name('land.update');
    Route::get('/destroy/{id}', 'Cms\LandController@destroy')->name('land.delete');
    Route::get('/toggle/{id}', 'Cms\LandController@toggle')->name('land.toggle');
    
    Route::post('/land-lot-datatable', 'Cms\LandController@dataTableLandLot')->name('land.land-lot-datatable');

});

