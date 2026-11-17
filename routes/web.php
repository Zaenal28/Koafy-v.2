<?php

use Illuminate\Support\Facades\Route;

// Client-side SPA routes for Koafy E-Commerce, Auth, and Admin Dashboard
Route::get('/{any?}', function () {
    return view('welcome');
})->where('any', '.*');

