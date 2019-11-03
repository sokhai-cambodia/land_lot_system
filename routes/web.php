<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear-cache', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return 'CLEAR-CACHE DONE'; //Return anything
});

// Login
Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@login')->name('login');
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'cms', 'middleware' => ['auth']], function(){

    Route::get('', function () {
        return view('cms.blank');
    })->name('cms');

    // PROFILE
    require_once __DIR__.'/cms/profile.php';

    // Brand
    require_once __DIR__.'/cms/todo.php';

});