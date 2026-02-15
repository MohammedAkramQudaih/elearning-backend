<?php

use App\Http\Controllers\Admin\AcademicLevelController;
use App\Http\Controllers\Admin\CareerSubmissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes (من Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Admin Routes - محمية بالمصادقة
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {

    // Dashboard
    // Route::get('/dashboard', function () {
    //     // return view('dashboard');
    //     return view('admin.index');
    // })->name('dashboard');
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    
    // Academic Levels
    Route::resource('academic-levels', AcademicLevelController::class);

    // Majors
    Route::resource('majors', MajorController::class);

    // Students
    Route::resource('students', StudentController::class);

    // Testimonials
    Route::resource('testimonials', TestimonialController::class);

    // News
    Route::resource('news', NewsController::class);

    // Career Submissions
    Route::resource('career-submissions', CareerSubmissionController::class)->only([
        'index',
        'show',
        'destroy'
    ]);
    Route::post(
        'career-submissions/{career_submission}/update-status',
        [CareerSubmissionController::class, 'updateStatus']
    )->name('career-submissions.update-status');
    Route::get(
        'career-submissions/{career_submission}/download-cv',
        [CareerSubmissionController::class, 'downloadCV']
    )->name('career-submissions.download-cv');
});

require __DIR__ . '/auth.php';
