<?php

Route::group(['prefix' => 'document'], function(){
    // User
    Route::get('/user/{userId}', 'Admin\DocumentUserController@index')->name('document.user');
    Route::get('/user/create/{userId}', 'Admin\DocumentUserController@create')->name('document.user.create');
    Route::post('/user/create/{userId}', 'Admin\DocumentUserController@store')->name('document.user.create');
    Route::get('/user/update/{userId}/{id}', 'Admin\DocumentUserController@edit')->name('document.user.update');
    Route::post('/user/update/{userId}/{id}', 'Admin\DocumentUserController@update')->name('document.user.update');
    Route::post('/user/data-table/{userId}', 'Admin\DocumentUserController@dataTable')->name('document.user.data-table');

    // Land Payment
    Route::get('/payment/{paymentId}', 'Admin\DocumentPaymentController@index')->name('document.payment');
    Route::get('/payment/create/{paymentId}', 'Admin\DocumentPaymentController@create')->name('document.payment.create');
    Route::post('/payment/create/{paymentId}', 'Admin\DocumentPaymentController@store')->name('document.payment.create');
    Route::get('/payment/update/{paymentId}/{id}', 'Admin\DocumentPaymentController@edit')->name('document.payment.update');
    Route::post('/payment/update/{paymentId}/{id}', 'Admin\DocumentPaymentController@update')->name('document.payment.update');
    Route::post('/payment/data-table/{paymentId}', 'Admin\DocumentPaymentController@dataTable')->name('document.payment.data-table');

    // Service Process
    Route::get('/process/{processId}', 'Admin\DocumentLegalServiceProcessController@index')->name('document.process');
    Route::get('/process/create/{processId}', 'Admin\DocumentLegalServiceProcessController@create')->name('document.process.create');
    Route::post('/process/create/{processId}', 'Admin\DocumentLegalServiceProcessController@store')->name('document.process.create');
    Route::get('/process/update/{processId}/{id}', 'Admin\DocumentLegalServiceProcessController@edit')->name('document.process.update');
    Route::post('/process/update/{processId}/{id}', 'Admin\DocumentLegalServiceProcessController@update')->name('document.process.update');
    Route::post('/process/data-table/{processId}', 'Admin\DocumentLegalServiceProcessController@dataTable')->name('document.process.data-table');

    // Installment
    Route::get('/installment/{installmentId}', 'Admin\DocumentInstallmentController@index')->name('document.installment');
    Route::get('/installment/create/{installmentId}', 'Admin\DocumentInstallmentController@create')->name('document.installment.create');
    Route::post('/installment/create/{installmentId}', 'Admin\DocumentInstallmentController@store')->name('document.installment.create');
    Route::get('/installment/update/{installmentId}/{id}', 'Admin\DocumentInstallmentController@edit')->name('document.installment.update');
    Route::post('/installment/update/{installmentId}/{id}', 'Admin\DocumentInstallmentController@update')->name('document.installment.update');
    Route::post('/installment/data-table/{installmentId}', 'Admin\DocumentInstallmentController@dataTable')->name('document.installment.data-table');

});

