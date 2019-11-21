<?php

Route::group(['prefix' => 'revenue-cost'], function(){
    // Category
    Route::get('/category', 'Admin\RevenueCostCategoryController@index')->name('revenue-cost.category');
    Route::post('/category/data-table', 'Admin\RevenueCostCategoryController@dataTable')->name('revenue-cost.category.data-table');
    
    Route::get('/category/create', 'Admin\RevenueCostCategoryController@create')->name('revenue-cost.category.create');
    Route::post('/category/create', 'Admin\RevenueCostCategoryController@store')->name('revenue-cost.category.create');

    Route::get('/category/update/{id}', 'Admin\RevenueCostCategoryController@edit')->name('revenue-cost.category.update');
    Route::post('/category/update/{id}', 'Admin\RevenueCostCategoryController@update')->name('revenue-cost.category.update');
    
    // Revenue Cost
    Route::get('', 'Admin\RevenueCostController@index')->name('revenue-cost');
    Route::post('/data-table', 'Admin\RevenueCostController@dataTable')->name('revenue-cost.data-table');

    Route::get('/create/revenue', 'Admin\RevenueCostController@createRevenue')->name('revenue-cost.create.revenue');
    Route::get('/create/cost', 'Admin\RevenueCostController@createCost')->name('revenue-cost.create.cost');
    Route::post('/create/{type}', 'Admin\RevenueCostController@store')->name('revenue-cost.create');

    Route::get('/update/{id}', 'Admin\RevenueCostController@edit')->name('revenue-cost.update');
    Route::post('/update/{id}', 'Admin\RevenueCostController@update')->name('revenue-cost.update');
});

