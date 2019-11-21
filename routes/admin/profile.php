<?php

Route::group(['prefix' => 'profile'], function(){
    Route::get('/update', 'Admin\ProfileController@edit')->name('profile.update');
    Route::post('/update', 'Admin\ProfileController@update')->name('profile.update');
    Route::get('/change-password', 'Admin\ProfileController@changePassword')->name('profile.change-password');
    Route::post('/change-password', 'Admin\ProfileController@updatePassword')->name('profile.change-password');

});

