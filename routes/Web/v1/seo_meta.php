<?php

use App\Http\Controllers\Web\Backend\Settings\SeoMetaController;
use Illuminate\Support\Facades\Route;

//! Route for SEO Meta Settings
Route::controller(SeoMetaController::class)->group(function () {
    Route::get('/seo-meta/homepage', 'homepage')->name('seo.meta.homepage');
    Route::patch('/seo-meta', 'update')->name('seo.meta.update');
});
