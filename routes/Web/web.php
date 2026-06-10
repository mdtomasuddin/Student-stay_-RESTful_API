<?php

use App\Http\Controllers\ResetController;
use App\Http\Controllers\Web\Backend\ChatHistoryController;
use App\Http\Controllers\Web\Backend\V1\Agent\AgentMangementController;
use App\Http\Controllers\Web\Backend\V1\BlogFeatures\BlogController;
use App\Http\Controllers\Web\Backend\V1\CityFeatures\CityController;
use App\Http\Controllers\Web\Backend\V1\CMS\HomePage\HeroBannerCardController;
use App\Http\Controllers\Web\Backend\V1\CMS\HomePage\HeroBannerController;
use App\Http\Controllers\Web\Backend\V1\CMS\HomePage\HowItWorksController;
use App\Http\Controllers\Web\Backend\V1\CMS\LettingAgentPage\LettingAgentPageGenerateDemandController;
use App\Http\Controllers\Web\Backend\V1\CMS\LettingAgentPage\LettingAgentPageHeroBannerController;
use App\Http\Controllers\Web\Backend\V1\CMS\LettingAgentPage\LettingAgentPageWhoWeAreController;
use App\Http\Controllers\Web\Backend\V1\CMS\LettingAgentPage\LettingAgentPageWhyProvidersChooseUsController;
use App\Http\Controllers\Web\Backend\V1\CMS\PartnerPage\PartnerPageHeroBannerController;
use App\Http\Controllers\Web\Backend\V1\CMS\StudentBlog\StudentBlogHeroBannerController;
use App\Http\Controllers\Web\Backend\V1\DigitalResourceFeatures\DigitalResourceAccessController;
use App\Http\Controllers\Web\Backend\V1\DigitalResourceFeatures\DigitalResourceController;
use App\Http\Controllers\Web\Backend\V1\Property\PropertyManageController;
use App\Http\Controllers\Web\Backend\V1\Property\RoomListingController;
use App\Http\Controllers\Web\Backend\V1\StudentEnquiries\StudentEnquiriesController;
use App\Http\Controllers\Web\Backend\V1\Testimonial\TestimonialController;
use App\Http\Controllers\Web\Frontend\HomeController;
use App\Http\Controllers\Web\Backend\V1\Property\PropertyEnquiryController;
use App\Http\Controllers\Web\Backend\UserController;
use App\Http\Controllers\Web\Backend\V1\ContactUs\ContactUsController;
use Illuminate\Support\Facades\Route;

//Link for Web Routes
require 'v1/cms.php';
require 'v1/courses.php';
require 'v1/categoryFeatures.php';
require 'v1/seo_meta.php';

// Route for Reset Database and Optimize Clear and Cache
Route::get('/reset', [ResetController::class, 'Reset'])->name('reset');
Route::get('/cache', [ResetController::class, 'Cache'])->name('cache');
// Route for Landing Page
Route::get('/index', [HomeController::class, 'index'])->name('index');
// Students Popular Cities
Route::post('cities/status/{id}', [CityController::class, 'status'])->name('cities.status');
Route::resource('cities', CityController::class);
// digital resource
Route::post('digital-resources/status/{id}', [DigitalResourceController::class, 'status'])->name('digital-resources.status');
Route::resource('digital-resources', DigitalResourceController::class);
Route::get('digitals-resources/access', [DigitalResourceAccessController::class, 'index'])->name('digitals.resources.access');
// blogs
Route::post('ckeditor/upload-image', [BlogController::class, 'uploadImage'])->name('blogs.upload-image');
Route::post('blogs/{id}/status', [BlogController::class, 'status'])->name('blogs.status');
Route::post('blogs/{id}/toggle-featured', [BlogController::class, 'toggleFeatured'])->name('blogs.toggleFeatured');
Route::resource('blogs', BlogController::class);
// Property info routes
Route::resource('manage-properties', PropertyManageController::class);
Route::post('manage-properties/update-status', [PropertyManageController::class, 'updateStatus'])->name('manage-properties.update-status');
// Room Listing routes
Route::resource('room-listings', RoomListingController::class);
// agent management
Route::resource('manage-agents', AgentMangementController::class);
Route::post('manage-agents/update-status/{id}', [AgentMangementController::class, 'updateStatus'])->name('manage-agents.update-status');
// users management
Route::resource('users', UserController::class);
// student enquiries
Route::resource('student-enquiry', StudentEnquiriesController::class)->only(['index', 'show', 'destroy']);
// Testimonials
Route::post('/testimonials/status/{id}', [TestimonialController::class, 'status'])->name('testimonials.status');
Route::resource('testimonials', TestimonialController::class);

// Property Enquiries
Route::resource('property-enquiry', PropertyEnquiryController::class)->only(['index', 'show', 'destroy']);

// Contact Us
Route::resource('contact-us', ContactUsController::class)->only(['index', 'show', 'destroy']);

// Hero Banner Routes
Route::resource('homepage-hero', HeroBannerController::class);        // Home Page Hero section
Route::resource('hero-banner-card', HeroBannerCardController::class); // Hero Banner Cards
Route::resource('how-it-works', HowItWorksController::class)->only(['index', 'store']);
Route::resource('student-blog-hero', StudentBlogHeroBannerController::class);       // Student Blog Hero section
Route::resource('partner-page-hero', PartnerPageHeroBannerController::class);       // Partner Page Hero section
Route::resource('letting-agent-hero', LettingAgentPageHeroBannerController::class); // Letting Agent Page Hero section
// Letting Agent Page Routes
Route::resource('letting-agent-who-we-are', LettingAgentPageWhoWeAreController::class);                // Letting Agent Page Who we are
Route::resource('letting-agent-generate-demand', LettingAgentPageGenerateDemandController::class);     // Letting Agent Page How We Generate Student Demand
Route::resource('letting-agent-why-choose-us', LettingAgentPageWhyProvidersChooseUsController::class); // Letting Agent Page Why PBSA/HMO Providers Choose Us

// AI Chatbot history.
Route::resource('chat-history', ChatHistoryController::class);
