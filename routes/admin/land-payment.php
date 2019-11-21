<?php

Route::group(['prefix' => 'land-payment'], function(){

    Route::get('', 'Admin\LandPaymentController@index')->name('land.payment');
    Route::post('/datatable', 'Admin\LandPaymentController@dataTable')->name('land.payment.data-table');
    Route::post('/pay-more/{id}', 'Admin\LandPaymentController@payMore')->name('land.payment.pay-more');
    Route::post('/view-invoice/{id}', 'Admin\LandPaymentController@viewInvoice')->name('land.payment.view-invoice');
    Route::post('/view-receipt/{id}', 'Admin\LandPaymentController@viewReceipt')->name('land.payment.view-receipt');
    
    Route::get('/installment/{paymentId}', 'Admin\LandPaymentController@installmentList')->name('land.installment-payment');
    Route::post('/installment/detail', 'Admin\LandPaymentController@installmentDetail')->name('land.installment-payment.detail');
    Route::post('/installment/pay/{id}', 'Admin\LandPaymentController@installmentPay')->name('land.installment-payment.pay');

    Route::get('/create/{landId}', 'Admin\LandPaymentController@create')->name('land.payment.create');
    Route::post('/create/{landId}', 'Admin\LandPaymentController@store')->name('land.payment.create');
    Route::post('/create/installment/generate', 'Admin\LandPaymentController@generateInstallment')->name('land.installment-payment.generate');
    
    Route::get('/create/installment/{landId}', 'Admin\LandPaymentController@createInstallment')->name('land.installment-payment.create');
    Route::post('/create/installment/{landId}', 'Admin\LandPaymentController@storeInstallment')->name('land.installment-payment.create');
    
});

