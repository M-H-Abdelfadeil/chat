<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/save-msg', 'HomeController@store')->name('msg.store');


Route::resource('messages','MessageController');
