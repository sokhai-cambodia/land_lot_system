<?php

Route::group(['prefix' => 'revenue-cost'], function(){
    Route::get('', 'Cms\RevenueCostController@index')->name('revenue-cost');
    Route::get('/create', 'Cms\RevenueCostController@create')->name('revenue-cost.create');
    Route::post('/create', 'Cms\RevenueCostController@store')->name('revenue-cost.create');
    Route::get('/update/{id}', 'Cms\RevenueCostController@edit')->name('revenue-cost.update');
    Route::post('/update/{id}', 'Cms\RevenueCostController@update')->name('revenue-cost.update');
    Route::get('/destroy/{id}', 'Cms\RevenueCostController@destroy')->name('revenue-cost.delete');
    Route::get('/toggle/{id}', 'Cms\RevenueCostController@toggle')->name('revenue-cost.toggle');
    Route::post('/datatable', 'Cms\RevenueCostController@dataTable')->name('revenue-cost.data-table');

});

