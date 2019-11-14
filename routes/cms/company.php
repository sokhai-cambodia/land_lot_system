<?php

Route::group(['prefix' => 'company'], function(){
    Route::get('/', 'Cms\CompanyController@edit')->name('company');
    Route::post('/', 'Cms\CompanyController@update')->name('company');

});

