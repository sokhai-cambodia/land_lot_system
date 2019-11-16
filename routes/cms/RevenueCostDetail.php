<?php

Route::group(['prefix' => 'revenue-cost'], function(){
    Route::get('/detail/{revenueId}', 'Cms\RevenueCostCategoryController@index')->name('revenue-cost-detail');
    Route::get('/detail/create/{revenueId}', 'Cms\RevenueCostCategoryController@create')->name('revenue-cost-detail.create');
    Route::post('/detail/create/{revenueId}', 'Cms\RevenueCostCategoryController@store')->name('revenue-cost-detail.create');
    Route::get('/detail/update/{revenueId}', 'Cms\RevenueCostCategoryController@edit')->name('revenue-cost-detail.update');
    Route::post('/detail/update/{revenueId}/{id}', 'Cms\RevenueCostCategoryController@update')->name('revenue-cost-detail.update');
    Route::get('/detail/destroy/{revenueId}/{id}', 'Cms\RevenueCostCategoryController@destroy')->name('revenue-cost-detail.delete');
    Route::get('/detail//toggle/{revenueId}/{id}', 'Cms\RevenueCostCategoryController@toggle')->name('revenue-cost-detail.toggle');
    Route::post('/detail/datatable/{revenueId}', 'Cms\RevenueCostCategoryController@dataTable')->name('revenue-cost-detail.data-table');

    Route::post('/detail/list', 'Cms\RevenueCostCategoryController@list');

});

