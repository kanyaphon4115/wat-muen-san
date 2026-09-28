<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::view('/tiger-legend', 'tiger-legend')->name('tiger-legend');

Route::view('/history', 'history')->name('history');

Route::view('/places', 'places')->name('places');
