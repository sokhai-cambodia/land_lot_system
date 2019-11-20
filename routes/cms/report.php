<?php

Route::group(['prefix' => 'report'], function(){
    Route::get('/daily', 'Cms\ReportController@index')->name('report.daily');
    Route::get('/monthly', 'Cms\ReportController@monthly')->name('report.monthly');
    Route::get('/land-layout', 'Cms\ReportController@landLayout')->name('report.land-layout');
    Route::get('/sold-land', 'Cms\ReportController@soldLand')->name('report.sold-land');

});

