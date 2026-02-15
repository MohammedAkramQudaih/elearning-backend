<?php

use App\Http\Controllers\Api\CareerController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\MajorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/majors', [MajorController::class, 'getAll']);

Route::prefix('v1')->group(function () {
    
    // Public APIs - لا تحتاج مصادقة
    Route::get('/majors', [MajorController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/news', [HomeController::class, 'news']);
    Route::get('/testimonials', [HomeController::class, 'testimonials']);
    
    // Career submission
    Route::post('/career/apply', [CareerController::class, 'apply']);
});
