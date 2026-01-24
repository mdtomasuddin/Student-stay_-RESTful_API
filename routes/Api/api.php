<?php

use App\Http\Controllers\Api\V1\BlogFeature\BlogController;
use App\Http\Controllers\Api\V1\CategoryFeature\AmenitiesController;
use App\Http\Controllers\Api\V1\CategoryFeature\BillIncludedsController;
use App\Http\Controllers\Api\V1\CategoryFeature\BlogCategoryController;
use App\Http\Controllers\Api\V1\CityFeature\CityController;
use App\Http\Controllers\Api\V1\DigitalResourceFeature\DigitalResourceController;
use App\Http\Controllers\Api\V1\FAQ\FAQController;
use App\Http\Controllers\Api\V1\lettingAgent\AgentController;
use App\Http\Controllers\Api\V1\Property\PropertyController;
use App\Http\Controllers\Web\Backend\V1\CategoryFeature\PropertyTypesController;
use Illuminate\Support\Facades\Route;

//faq
Route::apiResource('faq', FAQController::class);

Route::apiResource('city', CityController::class);
//Category Feature
Route::apiResource('amenitie', AmenitiesController::class);
Route::apiResource('bill-included', BillIncludedsController::class);
Route::apiResource('property-type', PropertyTypesController::class);
Route::apiResource('blog-category', BlogCategoryController::class);
Route::apiResource('digital-resource', DigitalResourceController::class);
Route::apiResource('blogs', BlogController::class);

//letting_agent
Route::apiResource('agent', AgentController::class);
Route::apiResource('property', PropertyController::class)->middleware('auth.jwt');
