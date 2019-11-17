<?php

Route::group(['prefix' => 'land-payment'], function(){

    Route::get('/create/{landId}', 'Cms\LandPaymentController@create')->name('land.payment.create');
    Route::post('/create/{landId}', 'Cms\LandPaymentController@store')->name('land.payment.create');
    Route::post('/create/installment/generate', 'Cms\LandPaymentController@generateInstallment')->name('land.installment-payment.generate');
    
    Route::get('/create/installment/{landId}', 'Cms\LandPaymentController@createInstallment')->name('land.installment-payment.create');
    Route::post('/create/installment/{landId}', 'Cms\LandPaymentController@storeInstallment')->name('land.installment-payment.create');

});

