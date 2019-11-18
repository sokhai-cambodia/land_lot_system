<?php

Route::group(['prefix' => 'land-payment'], function(){

    Route::get('', 'Cms\LandPaymentController@index')->name('land.payment');
    Route::post('/datatable', 'Cms\LandPaymentController@dataTable')->name('land.payment.data-table');
    
    Route::get('/installment/{paymentId}', 'Cms\LandPaymentController@installmentList')->name('land.installment-payment');
    Route::post('/installment/detail', 'Cms\LandPaymentController@installmentDetail')->name('land.installment-payment.detail');
    Route::post('/installment/pay/{id}', 'Cms\LandPaymentController@installmentPay')->name('land.installment-payment.pay');

    Route::get('/create/{landId}', 'Cms\LandPaymentController@create')->name('land.payment.create');
    Route::post('/create/{landId}', 'Cms\LandPaymentController@store')->name('land.payment.create');
    Route::post('/create/installment/generate', 'Cms\LandPaymentController@generateInstallment')->name('land.installment-payment.generate');
    
    Route::get('/create/installment/{landId}', 'Cms\LandPaymentController@createInstallment')->name('land.installment-payment.create');
    Route::post('/create/installment/{landId}', 'Cms\LandPaymentController@storeInstallment')->name('land.installment-payment.create');
    
});

