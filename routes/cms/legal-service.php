<?php

Route::group(['prefix' => 'legal-service'], function(){
    Route::get('', 'Cms\LegalServiceController@index')->name('legal-service');
    Route::post('/datatable', 'Cms\LegalServiceController@dataTable')->name('legal-service.data-table');

    Route::get('/process/{id}', 'Cms\LegalServiceController@process')->name('legal-service.process');
    Route::get('/process/{id}/create', 'Cms\LegalServiceController@createProcess')->name('legal-service.process.create');
    Route::post('/process/{id}/create', 'Cms\LegalServiceController@storeProcess')->name('legal-service.process.create');
    Route::get('/process/{id}/update/{pid}', 'Cms\LegalServiceController@editProcess')->name('legal-service.process.update');
    Route::post('/process/{id}/update/{pid}', 'Cms\LegalServiceController@updateProcess')->name('legal-service.process.update');
    Route::get('/process/{id}/finish/{pid}', 'Cms\LegalServiceController@finishProcess')->name('legal-service.process.finish');

    Route::get('/create/{paymentId}', 'Cms\LegalServiceController@create')->name('legal-service.create');
    Route::post('/create/{paymentId}', 'Cms\LegalServiceController@store')->name('legal-service.create');

    Route::get('/update/{id}', 'Cms\LegalServiceController@edit')->name('legal-service.update');
    Route::post('/update/{id}', 'Cms\LegalServiceController@update')->name('legal-service.update');
});

