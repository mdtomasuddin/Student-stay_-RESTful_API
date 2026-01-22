<?php

use App\Http\Controllers\Api\V1\FAQ\FAQController;
use App\Http\Controllers\Api\V1\Property\PropertyController;
use Illuminate\Support\Facades\Route;


//faq
Route::apiResource('faq', FAQController::class);


// property
Route::apiResource('property', PropertyController::class);