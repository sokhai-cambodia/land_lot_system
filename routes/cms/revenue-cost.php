<?php

Route::group(['prefix' => 'revenue-cost'], function(){

    Route::get('/category', 'Cms\RevenueCostCategoryController@index')->name('revenue-cost.category');
    Route::post('/category/data-table', 'Cms\RevenueCostCategoryController@dataTable')->name('revenue-cost.category.data-table');
    
    Route::get('/category/create', 'Cms\RevenueCostCategoryController@create')->name('revenue-cost.category.create');
    Route::post('/category/create', 'Cms\RevenueCostCategoryController@store')->name('revenue-cost.category.create');

    Route::get('/category/update/{id}', 'Cms\RevenueCostCategoryController@edit')->name('revenue-cost.category.update');
    Route::post('/category/update/{id}', 'Cms\RevenueCostCategoryController@update')->name('revenue-cost.category.update');
    
});

