<?php

Route::group(['prefix' => 'document'], function(){
    // User
    Route::get('/user/{userId}', 'Cms\DocumentUserController@index')->name('document.user');
    Route::get('/user/create/{userId}', 'Cms\DocumentUserController@create')->name('document.user.create');
    Route::post('/user/create/{userId}', 'Cms\DocumentUserController@store')->name('document.user.create');
    Route::get('/user/update/{userId}/{id}', 'Cms\DocumentUserController@edit')->name('document.user.update');
    Route::post('/user/update/{userId}/{id}', 'Cms\DocumentUserController@update')->name('document.user.update');
    Route::post('/user/data-table/{userId}', 'Cms\DocumentUserController@dataTable')->name('document.user.data-table');

    // Land Payment
    Route::get('/payment/{paymentId}', 'Cms\DocumentPaymentController@index')->name('document.payment');
    Route::get('/payment/create/{paymentId}', 'Cms\DocumentPaymentController@create')->name('document.payment.create');
    Route::post('/payment/create/{paymentId}', 'Cms\DocumentPaymentController@store')->name('document.payment.create');
    Route::get('/payment/update/{paymentId}/{id}', 'Cms\DocumentPaymentController@edit')->name('document.payment.update');
    Route::post('/payment/update/{paymentId}/{id}', 'Cms\DocumentPaymentController@update')->name('document.payment.update');
    Route::post('/payment/data-table/{paymentId}', 'Cms\DocumentPaymentController@dataTable')->name('document.payment.data-table');

    // Service Process
    Route::get('/process/{processId}', 'Cms\DocumentLegalServiceProcessController@index')->name('document.process');
    Route::get('/process/create/{processId}', 'Cms\DocumentLegalServiceProcessController@create')->name('document.process.create');
    Route::post('/process/create/{processId}', 'Cms\DocumentLegalServiceProcessController@store')->name('document.process.create');
    Route::get('/process/update/{processId}/{id}', 'Cms\DocumentLegalServiceProcessController@edit')->name('document.process.update');
    Route::post('/process/update/{processId}/{id}', 'Cms\DocumentLegalServiceProcessController@update')->name('document.process.update');
    Route::post('/process/data-table/{processId}', 'Cms\DocumentLegalServiceProcessController@dataTable')->name('document.process.data-table');
});

