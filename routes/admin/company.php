<?php

Route::group(['prefix' => 'company'], function(){
    Route::get('/', 'Admin\CompanyController@edit')->name('company');
    Route::post('/', 'Admin\CompanyController@update')->name('company');

});

