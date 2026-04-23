<?php

use App\Http\Controllers\Web\Backend\V1\CategoryFeature\AmenitiesController;
use App\Http\Controllers\Web\Backend\V1\CategoryFeature\BillIncludedController;
use App\Http\Controllers\Web\Backend\V1\CategoryFeature\BlogCategoryController;
use App\Http\Controllers\Web\Backend\V1\CategoryFeature\PlaceOfStudyController;
use App\Http\Controllers\Web\Backend\V1\CategoryFeature\PropertyTypeController;
use App\Http\Controllers\Web\Backend\V1\CategoryFeature\ReferralSourceCategoryController;
use App\Http\Controllers\Web\Backend\V1\CategoryFeature\RoomTypeCategoryController;
use Illuminate\Support\Facades\Route;

/**
 * All Category Features routes
 */
Route::post('amenities/status/{id}', [AmenitiesController::class, 'status'])->name('amenities.status');
Route::resource('amenities', AmenitiesController::class);
Route::post('bill-includeds/status/{id}', [BillIncludedController::class, 'status'])->name('bill-includeds.status');
Route::resource('bill-includeds', BillIncludedController::class);
Route::post('property-types/status/{id}', [PropertyTypeController::class, 'status'])->name('property-types.status');
Route::resource('property-types', PropertyTypeController::class);
Route::post('blog-categories/status/{id}', [BlogCategoryController::class, 'status'])->name('blog-categories.status');
Route::resource('blog-categories', BlogCategoryController::class);
Route::post('room-types/status/{id}', [RoomTypeCategoryController::class, 'status'])->name('room-types.status');
Route::resource('room-types', RoomTypeCategoryController::class);
Route::post('place-of-studies/status/{id}', [PlaceOfStudyController::class, 'status'])->name('place-of-studies.status');
Route::resource('place-of-studies', PlaceOfStudyController::class);
Route::post('referral-sources/status/{id}', [ReferralSourceCategoryController::class, 'status'])->name('referral-sources.status');
Route::resource('referral-sources', ReferralSourceCategoryController::class);
