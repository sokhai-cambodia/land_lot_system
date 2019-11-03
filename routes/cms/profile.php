<?php

Route::group(['prefix' => 'profile'], function(){
    Route::get('/update', 'Cms\ProfileController@edit')->name('profile.update');
    Route::post('/update', 'Cms\ProfileController@update')->name('profile.update');
    Route::get('/change-password', 'Cms\ProfileController@changePassword')->name('profile.change-password');
    Route::post('/change-password', 'Cms\ProfileController@updatePassword')->name('profile.change-password');

});

