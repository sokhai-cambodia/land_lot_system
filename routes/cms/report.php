<?php

Route::group(['prefix' => 'report'], function(){
    Route::get('/daily', 'Cms\ReportController@index')->name('report.daily');
    
    Route::get('/monthly', 'Cms\ReportController@monthly')->name('report.monthly');
    Route::get('/print/monthly', 'Cms\ReportController@printMonthly')->name('report.print-monthly');

    Route::get('/sold-land', 'Cms\ReportController@soldLand')->name('report.sold-land');
    Route::get('/print/sold-land', 'Cms\ReportController@printSoldLand')->name('report.print-sold-land');
    
    Route::get('/print/receipt/{id}', 'Cms\ReportController@printReceipt')->name('report.print-receipt');
    
});

