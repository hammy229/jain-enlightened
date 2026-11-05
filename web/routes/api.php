<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API as API;

Route::get('unauthorized-user', function(){
    return response()->json(['status' => 401,'message' => 'unauthorized user'], 401);
})->name('unauthorized-user');

Route::controller(API\BaseController::class)->group(function () {
    Route::get('/general-data', 'index');
    Route::get('/app-update', 'app_update');
    Route::get('/store-link', 'store_link');
});

Route::controller(API\HomeController::class)->group(function () {
    Route::get('/home', 'index');
});

Route::controller(API\BlogController::class)->group(function () {
    Route::get('/blogs', 'index');
    Route::get('/blog/{id}', 'view');
});

Route::controller(API\LessonController::class)->group(function () {
    Route::get('/lessons/{language_id?}', 'index');
    Route::get('/lesson/{id}', 'view');
});

Route::controller(API\PodcastController::class)->group(function () {
    Route::get('/podcasts', 'index');
});

Route::controller(API\ResearchController::class)->group(function () {
    Route::get('/researches/{resource_type?}', 'index');
});

Route::controller(API\ImpactController::class)->group(function () {
    Route::get('/impacts', 'index');
});

Route::controller(API\GalleryController::class)->group(function () {
    Route::get('/galleries/{gallery_type?}', 'index');
});

Route::controller(API\BankDetailController::class)->group(function () {
    Route::get('/help-us-grow', 'index');
});

Route::controller(API\TermAndConditionController::class)->group(function () {
    Route::get('/term-and-condition', 'index');
});

Route::controller(API\PrivacyPolicyController::class)->group(function () {
    Route::get('/privacy-policy', 'index');
});

Route::controller(API\AboutUsController::class)->group(function () {
    Route::get('/about-us', 'index');
});

Route::controller(API\ContactUsController::class)->group(function () {
    Route::get('/contact-us', 'index');
    Route::post('/contact-us/store', 'store');
});

Route::controller(API\InternshipOpportunityController::class)->group(function () {
    Route::get('/internship-opportunity', 'index');
    Route::post('/internship-opportunity/store', 'store');
});

Route::controller(API\FounderMessageController::class)->group(function () {
    Route::get('/founder-message', 'index');
});

