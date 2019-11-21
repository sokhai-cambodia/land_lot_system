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
    return redirect()->route('admin');
});


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){

    Route::get('', function () {
        return view('admin.blank');
    })->name('admin');

    // PROFILE
    require_once __DIR__.'/admin/profile.php';

    // Comapny
    require_once __DIR__.'/admin/company.php';

    // User
    require_once __DIR__.'/admin/user.php';
    
    // Land
    require_once __DIR__.'/admin/land.php';

    // Land Payment
    require_once __DIR__.'/admin/land-payment.php';

    // Legal Service
    require_once __DIR__.'/admin/legal-service.php';

    // Revenue Cost
    require_once __DIR__.'/admin/revenue-cost.php';

    // Document
    require_once __DIR__.'/admin/document.php';

    // Report
    require_once __DIR__.'/admin/report.php';

});