<?php

Route::group(['prefix' => 'legal-service'], function(){
    Route::get('', 'Cms\LegalServiceController@index')->name('legal-service');
    Route::post('/datatable', 'Cms\LegalServiceController@dataTable')->name('legal-service.data-table');

    Route::get('/create/{paymentId}', 'Cms\LegalServiceController@create')->name('legal-service.create');
    Route::post('/create/{paymentId}', 'Cms\LegalServiceController@store')->name('legal-service.create');

    Route::get('/update/{id}', 'Cms\LegalServiceController@edit')->name('legal-service.update');
    Route::post('/update/{id}', 'Cms\LegalServiceController@update')->name('legal-service.update');
});

