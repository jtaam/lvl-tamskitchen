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

Route::get('/', 'HomeController@index' )->name('welcome');

Route::post('reservation','ReservationController@reserve')->name('reservation.reserve');

Route::post('contact','ContactController@sendMessage')->name('contact.send');

Auth::routes();

Route::group(['prefix'=>'admin','middleware'=>'auth','namespace'=>'admin'], function(){
    // Dashboard
    Route::get('dashboard','DashboardController@index')->name('admin.dashboard');
    // Slider
    Route::resource('slider','SliderController');
    // Category
    Route::resource('category','CategoryController');
    // Item
    Route::resource('item','ItemController');
    // Reservation
    Route::get('reservation','ReservationController@index')->name('reservation.index');
    Route::post('reservation/{id}','ReservationController@status')->name('reservation.status');
    Route::delete('reservation/{id}','ReservationController@destroy')->name('reservation.destroy');
    // Contact
    Route::get('contact','ContactController@index')->name('contact.index');
    Route::get('contact/{id}','ContactController@show')->name('contact.show');
    Route::delete('contact/{id}','ContactController@destroy')->name('contact.destroy');
    // Cloudinary
    Route::resource('cloudinary', 'CloudinaryController');
});