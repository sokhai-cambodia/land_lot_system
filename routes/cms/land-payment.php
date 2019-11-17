<?php

Route::group(['prefix' => 'land-payment'], function(){

    Route::get('/create/{landId}', 'Cms\LandPaymentController@create')->name('land.payment.create');
    Route::post('/create/{landId}', 'Cms\LandPaymentController@store')->name('land.payment.create');
    
});

