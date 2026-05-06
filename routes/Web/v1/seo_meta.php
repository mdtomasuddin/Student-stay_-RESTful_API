<?php

use App\Http\Controllers\Web\Backend\Settings\SeoMetaController;
use Illuminate\Support\Facades\Route;

//! Route for SEO Meta Settings
Route::controller(SeoMetaController::class)->group(function () {
    Route::get('/seo-meta/homepage', 'homepage')->name('seo.meta.homepage');
    Route::get('/seo-meta/accommodation', 'accommodation')->name('seo.meta.accommodation');
    Route::get('/seo-meta/student-resources', 'studentResources')->name('seo.meta.student_resources');
    Route::get('/seo-meta/blogs', 'blogs')->name('seo.meta.blogs');
    Route::get('/seo-meta/letting-agents', 'lettingAgents')->name('seo.meta.letting_agents');
    Route::patch('/seo-meta', 'update')->name('seo.meta.update');
});
