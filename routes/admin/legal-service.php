<?php

Route::group(['prefix' => 'legal-service'], function(){
    Route::get('', 'Admin\LegalServiceController@index')->name('legal-service');
    Route::post('/datatable', 'Admin\LegalServiceController@dataTable')->name('legal-service.data-table');

    Route::get('/process/{id}', 'Admin\LegalServiceController@process')->name('legal-service.process');
    Route::get('/process/{id}/create', 'Admin\LegalServiceController@createProcess')->name('legal-service.process.create');
    Route::post('/process/{id}/create', 'Admin\LegalServiceController@storeProcess')->name('legal-service.process.create');
    Route::get('/process/{id}/update/{pid}', 'Admin\LegalServiceController@editProcess')->name('legal-service.process.update');
    Route::post('/process/{id}/update/{pid}', 'Admin\LegalServiceController@updateProcess')->name('legal-service.process.update');
    Route::get('/process/{id}/finish/{pid}', 'Admin\LegalServiceController@finishProcess')->name('legal-service.process.finish');

    Route::get('/create/{paymentId}', 'Admin\LegalServiceController@create')->name('legal-service.create');
    Route::post('/create/{paymentId}', 'Admin\LegalServiceController@store')->name('legal-service.create');

    Route::get('/update/{id}', 'Admin\LegalServiceController@edit')->name('legal-service.update');
    Route::post('/update/{id}', 'Admin\LegalServiceController@update')->name('legal-service.update');
});

