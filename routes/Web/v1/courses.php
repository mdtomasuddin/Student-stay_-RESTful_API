<?php

use App\Http\Controllers\Web\Backend\V1\Course\CourseController;
use App\Http\Controllers\Web\Backend\V1\Course\ModuleController;
use App\Http\Controllers\Web\Backend\V1\Course\VideoController;
use Illuminate\Support\Facades\Route;

/**
 * Course Management Routes
 * These routes are prefixed with 'admin' and are used for managing courses, modules,
 * videos within the application.
 */
Route::prefix('admin')->group(function () {
    Route::get('/course/status/{id}', [CourseController::class, 'status'])->name('course.status');
    Route::resource('course', CourseController::class);
    Route::get('/module/status/{id}', [ModuleController::class, 'status'])->name('module.status');
    Route::resource('module', ModuleController::class);
    Route::get('/video/status/{id}', [VideoController::class, 'status'])->name('video.status');
    Route::get('/get-modules/{course_id}', [VideoController::class, 'getModules'])->name('video.getModules');
    Route::resource('video', VideoController::class);
});
