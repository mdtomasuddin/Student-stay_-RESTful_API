<?php

use App\Http\Controllers\Api\V1\BlogFeature\BlogController;
use App\Http\Controllers\Api\V1\CategoryFeature\CategoryController;
use App\Http\Controllers\Api\V1\CityFeature\CityController;
use App\Http\Controllers\Api\V1\ContactUs\ContactUsController;
use App\Http\Controllers\Api\V1\DigitalResourceFeature\DigitalResourceController;
use App\Http\Controllers\Api\V1\FAQ\FAQController;
use App\Http\Controllers\Api\V1\lettingAgent\AgentController;
use App\Http\Controllers\Api\V1\Property\PropertyController;
use App\Http\Controllers\Api\V1\user\PropertiesController;
use App\Http\Controllers\Api\V1\user\PropertyEnquirie\PropertyEnquirieController;
use App\Http\Controllers\Api\V1\Wishlist\wishlistController;
use Illuminate\Support\Facades\Route;

//faq
Route::apiResource('faq', FAQController::class);
Route::apiResource('city', CityController::class);
//All Category Routes
Route::apiResource('category', CategoryController::class);
//partner dashboard property routes->
Route::apiResource('property', PropertyController::class)->middleware('auth.jwt'); //CRUD

Route::apiResource('digital-resource', DigitalResourceController::class);
Route::apiResource('blogs', BlogController::class);
//letting_agent
Route::apiResource('agent', AgentController::class);
Route::apiResource('wishlist', wishlistController::class)->middleware('auth.jwt');

//user properties
Route::apiResource('properties', PropertiesController::class);
Route::apiResource('property-enquirie', PropertyEnquirieController::class)->middleware('auth.jwt'); //only create
Route::apiResource('contact-us', ContactUsController::class)->middleware('auth.jwt');               //only create
