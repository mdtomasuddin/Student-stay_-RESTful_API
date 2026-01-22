<?php

use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\V1\CityFeatures\CityController;
use Illuminate\Support\Facades\Route;

// Route for Admin Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//Students Popular Cities
Route::post('/cities/status/{id}', [CityController::class, 'status'])->name('cities.status');
Route::resource('/cities', CityController::class);
