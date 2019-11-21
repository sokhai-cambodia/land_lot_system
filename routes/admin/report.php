<?php

Route::group(['prefix' => 'report'], function(){
    Route::get('/daily', 'Admin\ReportController@index')->name('report.daily');
    Route::get('/print/daily', 'Admin\ReportController@printDaily')->name('report.print.daily');
    
    Route::get('/monthly', 'Admin\ReportController@monthly')->name('report.monthly');
    Route::get('/print/monthly', 'Admin\ReportController@printMonthly')->name('report.print-monthly');

    Route::get('/sold-land', 'Admin\ReportController@soldLand')->name('report.sold-land');
    Route::get('/print/sold-land', 'Admin\ReportController@printSoldLand')->name('report.print-sold-land');
    
    Route::get('/print/receipt/{id}', 'Admin\ReportController@printReceipt')->name('report.print-receipt');
    
});

