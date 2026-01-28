<?php

use App\Http\Controllers\ResetController;
use App\Http\Controllers\Web\Backend\FAQController;
use App\Http\Controllers\Web\Backend\V1\Agent\AgentMangementController;
use App\Http\Controllers\Web\Backend\V1\BlogFeatures\BlogController;
use App\Http\Controllers\Web\Backend\V1\CategoryFeature\AmenitiesController;
use App\Http\Controllers\Web\Backend\V1\CategoryFeature\BillIncludedController;
use App\Http\Controllers\Web\Backend\V1\CategoryFeature\BlogCategoryController;
use App\Http\Controllers\web\Backend\V1\CategoryFeature\PlaceOfStudyController;
use App\Http\Controllers\Web\Backend\V1\CategoryFeature\PropertyTypeController;
use App\Http\Controllers\web\Backend\V1\CategoryFeature\ReferralSourceCategoryController;
use App\Http\Controllers\web\Backend\V1\CategoryFeature\RoomTypeCategoryController;
use App\Http\Controllers\Web\Backend\V1\CityFeatures\CityController;
use App\Http\Controllers\Web\Backend\V1\DigitalResourceFeatures\DigitalResourceAccessController;
use App\Http\Controllers\Web\Backend\V1\DigitalResourceFeatures\DigitalResourceController;
use App\Http\Controllers\Web\Backend\V1\Property\PropertyManageController;
use App\Http\Controllers\Web\Backend\V1\StudentEnquiries\StudentEnquiriesController;
use App\Http\Controllers\Web\Backend\V1\Testimonial\TestimonialController;
use App\Http\Controllers\Web\Frontend\HomeController;
use App\Http\Controllers\Web\Frontend\PageController;
use Illuminate\Support\Facades\Route;

// Route for Reset Database and Optimize Clear and Cache
Route::get('/reset', [ResetController::class, 'Reset'])->name('reset');
Route::get('/cache', [ResetController::class, 'Cache'])->name('cache');

// Route for Landing Page
Route::get('/index', [HomeController::class, 'index'])->name('index');

// Route for Dynamic Pages (Privacy Policy, Terms and Conditions)
Route::get('/page/{type}', [PageController::class, 'dynamicPage'])
    ->whereIn('type', ['privacyPolicy', 'termsAndConditions'])
    ->name('dynamicPage.show');

// Route for FAQ Page
Route::controller(FAQController::class)->group(function () {
    Route::get('/faq', 'index')->name('faq.index');
    Route::get('/faq/show/{id}', 'show')->name('faq.show');
    Route::get('/faq/create', 'create')->name('faq.create');
    Route::post('/faq/store', 'store')->name('faq.store');
    Route::get('/faq/edit/{id}', 'edit')->name('faq.edit');
    Route::put('/faq/update/{id}', 'update')->name('faq.update');
    Route::get('/faq/status/{id}', 'status')->name('faq.status');
    Route::delete('/faq/destroy/{id}', 'destroy')->name('faq.destroy');
});
//Students Popular Cities
Route::post('cities/status/{id}', [CityController::class, 'status'])->name('cities.status');
Route::resource('cities', CityController::class);
//All Category Features Starting----->
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
//All Category Features Ending----->

//digital resource
Route::post('digital-resources/status/{id}', [DigitalResourceController::class, 'status'])->name('digital-resources.status');
Route::resource('digital-resources', DigitalResourceController::class);
Route::get('digitals-resources/access', [DigitalResourceAccessController::class, 'index'])->name('digitals.resources.access');

//blogs
Route::post('ckeditor/upload-image', [BlogController::class, 'uploadImage'])->name('blogs.upload-image');
Route::post('blogs/{id}/status', [BlogController::class, 'status'])->name('blogs.status');
Route::post('blogs/{id}/toggle-featured', [BlogController::class, 'toggleFeatured'])->name('blogs.toggleFeatured');
Route::resource('blogs', BlogController::class);

//Property info routes
Route::resource('manage-properties', PropertyManageController::class);
Route::post('manage-properties/update-status', [PropertyManageController::class, 'updateStatus'])->name('manage-properties.update-status');
//agent management
Route::resource('manage-agents', AgentMangementController::class);
Route::post('manage-agents/update-status/{id}', [AgentMangementController::class, 'updateStatus'])->name('manage-agents.update-status');
//student enquiries
Route::get('student-enquiry', [StudentEnquiriesController::class, 'index'])->name('student-enquiry.index');

// Testimonials
Route::post('/testimonials/status/{id}', [TestimonialController::class, 'status'])->name('testimonials.status');
Route::resource('testimonials', TestimonialController::class);
