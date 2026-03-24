<?php

use App\Http\Controllers\Api\V1\Agent\LettingAgentController;
use App\Http\Controllers\Api\V1\BlogFeature\BlogController;
use App\Http\Controllers\Api\V1\CategoryFeature\CategoryController;
use App\Http\Controllers\Api\V1\CityFeature\CityController;
use App\Http\Controllers\Api\V1\CMS\HeroSectionController;
use App\Http\Controllers\Api\V1\CMS\SocialMediaController;
use App\Http\Controllers\Api\V1\CMS\SystemSettingOwnerInformationController;
use App\Http\Controllers\Api\V1\CMS\TermsAndConditionsController;
use App\Http\Controllers\Api\V1\ContactUs\ContactUsController;
use App\Http\Controllers\Api\V1\Course\CourseController;
use App\Http\Controllers\Api\V1\Course\ModuleController;
use App\Http\Controllers\Api\V1\Course\VideoController;
use App\Http\Controllers\Api\V1\DigitalResourceFeature\DigitalResourceAccessController;
use App\Http\Controllers\Api\V1\DigitalResourceFeature\DigitalResourceController;
use App\Http\Controllers\Api\V1\FAQ\FAQController;
use App\Http\Controllers\Api\V1\lettingAgent\AgentController;
use App\Http\Controllers\Api\V1\Property\PropertyController;
use App\Http\Controllers\Api\V1\Property\UniversityController;
use App\Http\Controllers\Api\V1\RoomListing\RoomListingController;
use App\Http\Controllers\Api\V1\StudentEnquirie\StudentEnquirieController;
use App\Http\Controllers\Api\V1\Testimonial\TestimonialController;
use App\Http\Controllers\Api\V1\User\PropertiesController;
use App\Http\Controllers\Api\V1\User\PropertyEnquirie\PropertyEnquiriesController;
use App\Http\Controllers\Api\V1\Wishlist\wishlistController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

/**
 * Public Routes->
 */
Route::apiResource('category', CategoryController::class); // All Category Routes
Route::apiResource('agent', AgentController::class);       // letting_agent
Route::apiResource('faq', FAQController::class);
Route::get('social-media', [SocialMediaController::class, 'index']);                        // Social Media
Route::get('owner-information', [SystemSettingOwnerInformationController::class, 'index']); // Owner Information
Route::apiResource('city', CityController::class);
Route::apiResource('testimonials', TestimonialController::class);

/**
 * partner dashboard property routes->
 */
Route::apiResource('property', PropertyController::class)->middleware('auth.jwt');
Route::apiResource('university', UniversityController::class)->middleware('auth.jwt');
Route::apiResource('property-room', RoomListingController::class)->middleware('auth.jwt');

// letting agent routes
Route::apiResource('letting-agent/properties', LettingAgentController::class);
Route::get('letting-agent/cms', [LettingAgentController::class, 'AllCMS']);

/**
 * Student Routes ->
 */
Route::apiResource('wishlist', wishlistController::class)->middleware('auth.jwt');
Route::apiResource('digital-resource', DigitalResourceController::class);
Route::apiResource('digital-resource-access', DigitalResourceAccessController::class)->middleware('auth.jwt');
Route::apiResource('blogs', BlogController::class);
Route::apiResource('properties', PropertiesController::class);
Route::get('properties-room-types', [PropertiesController::class, 'roomTypes']);
Route::apiResource('property-enquiries', PropertyEnquiriesController::class)->middleware('auth.jwt'); // only create
Route::apiResource('contact-us', ContactUsController::class)->middleware('auth.jwt');                 // only create
Route::apiResource('student-enquiries', StudentEnquirieController::class);                            // only create

Route::get('hero', [HeroSectionController::class, 'AllHeroSections']); // All Hero Sections
Route::get('content/{type?}', [TermsAndConditionsController::class, 'index']);

// Course Management API.
Route::get('video-courses', [CourseController::class, 'videoCourseList']);
Route::apiResource('courses', CourseController::class);
Route::apiResource('modules', ModuleController::class);
Route::apiResource('videos', VideoController::class);
// AI Chatbot API
Route::post('chat', [ChatController::class, 'chat']);
