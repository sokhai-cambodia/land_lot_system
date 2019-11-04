<?php

Route::group(['prefix' => 'todo'], function(){

    Route::get('', 'Cms\TodoController@index')->name('todo');
    Route::get('/create', 'Cms\TodoController@create')->name('todo.create');
    Route::post('/create', 'Cms\TodoController@store')->name('todo.create');
    Route::get('/update/{id}', 'Cms\TodoController@edit')->name('todo.update');
    Route::post('/update/{id}', 'Cms\TodoController@update')->name('todo.update');
    Route::get('/destroy/{id}', 'Cms\TodoController@destroy')->name('todo.delete');
    Route::get('/toggle/{id}', 'Cms\TodoController@toggle')->name('todo.toggle');
    Route::post('/datatable', 'Cms\TodoController@dataTable')->name('todo.data-table');

});

