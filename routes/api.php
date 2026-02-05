<?php

use App\Http\Controllers\API\BookASiteVisitController;
use App\Http\Controllers\API\CompaniesController;
use App\Http\Controllers\API\ContactUsController;
use App\Http\Controllers\API\LatestNewsController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\RequestAQuoteController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//reviews
Route::get('/reviews', [ReviewController::class, 'index']);
Route::get('/reviews/{id}', [ReviewController::class, 'show']);

//latest news
Route::get('/latest-news', [LatestNewsController::class, 'index']);
Route::get('/latest-news/{id}', [LatestNewsController::class, 'show']);

//companies
Route::get('/companies', [CompaniesController::class, 'index']);

//Services
Route::get('/services', [ServiceController::class, 'index']);

//contact us
Route::get('/contact-us-form-data', [ContactUsController::class, 'formData']);
Route::post('/contact-us',[ContactUsController::class,'store']);

//request-for-a-quote
Route::get('/request-for-a-quote-form-data', [RequestAQuoteController::class, 'formData']);
Route::post('/request-for-a-quote',[RequestAQuoteController::class,'store']);

//Book a site visit
Route::get('/book-a-site-visit-form-data', [BookASiteVisitController::class, 'formData']);
Route::post('/book-a-site-visit',[BookASiteVisitController::class,'store']);

Route::prefix('projects')->group(function () {

    Route::get('/simple', [ProjectController::class, 'simple']);

    Route::get('/', [ProjectController::class, 'index']);

    Route::get('/{id}', [ProjectController::class, 'show']);

});
