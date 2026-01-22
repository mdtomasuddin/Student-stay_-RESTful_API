<?php

use App\Http\Controllers\Api\V1\CategoryFeature\AmenitiesController;
use App\Http\Controllers\Api\V1\CategoryFeature\BillIncludedsController;
use App\Http\Controllers\Api\V1\CategoryFeature\BlogCategoryController;
use App\Http\Controllers\Api\V1\CityFeature\CityController;
use App\Http\Controllers\Api\V1\FAQ\FAQController;
use App\Http\Controllers\Api\V1\Property\PropertyController;
use App\Http\Controllers\Web\Backend\V1\CategoryFeature\PropertyTypesController;
use Illuminate\Support\Facades\Route;

//faq
Route::apiResource('faq', FAQController::class);

// property
// Route::apiResource('property', PropertyController::class);
Route::apiResource('city', CityController::class);
//Category Feature 
Route::apiResource('amenitie', AmenitiesController::class);
Route::apiResource('bill-included', BillIncludedsController::class);
Route::apiResource('property-type', PropertyTypesController::class);
Route::apiResource('blog-category', BlogCategoryController::class);
