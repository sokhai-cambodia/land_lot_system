<?php

Route::group(['prefix' => 'revenue-cost'], function(){
    // Category
    Route::get('/category', 'Cms\RevenueCostCategoryController@index')->name('revenue-cost.category');
    Route::post('/category/data-table', 'Cms\RevenueCostCategoryController@dataTable')->name('revenue-cost.category.data-table');
    
    Route::get('/category/create', 'Cms\RevenueCostCategoryController@create')->name('revenue-cost.category.create');
    Route::post('/category/create', 'Cms\RevenueCostCategoryController@store')->name('revenue-cost.category.create');

    Route::get('/category/update/{id}', 'Cms\RevenueCostCategoryController@edit')->name('revenue-cost.category.update');
    Route::post('/category/update/{id}', 'Cms\RevenueCostCategoryController@update')->name('revenue-cost.category.update');
    
    // Revenue Cost
    Route::get('', 'Cms\RevenueCostController@index')->name('revenue-cost');
    Route::post('/data-table', 'Cms\RevenueCostController@dataTable')->name('revenue-cost.data-table');

    Route::get('/create/revenue', 'Cms\RevenueCostController@createRevenue')->name('revenue-cost.create.revenue');
    Route::get('/create/cost', 'Cms\RevenueCostController@createCost')->name('revenue-cost.create.cost');
    Route::post('/create/{type}', 'Cms\RevenueCostController@store')->name('revenue-cost.create');

    Route::get('/update/{id}', 'Cms\RevenueCostController@edit')->name('revenue-cost.update');
    Route::post('/update/{id}', 'Cms\RevenueCostController@update')->name('revenue-cost.update');
});

