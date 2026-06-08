<?php

use App\Http\Controllers\PrototypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

/**
 * Root redirect: send visitors directly to the admin panel.
 * This is an admin-only tool so there is no public homepage.
 */
Route::get('/', function () {
    return redirect()->route('portfolio');
});

Route::get('/run-migrations', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'MarketingServiceSeeder', '--force' => true]);
    return 'Migrations and Seeders ran successfully. <a href="/">Go back</a>';
});

// Fallback route to serve uploaded files on Shared Hosting
Route::get('/uploads/{path}', function ($path) {
    $filePath = public_path('uploads/' . $path);
    if (!file_exists($filePath)) {
        abort(404);
    }
    return response()->file($filePath);
})->where('path', '.*');

// Portfolio and Case Study routes
Route::get('/portfolio', function () {
    $categories = \App\Models\Category::orderBy('sort_order')->get();
    $caseStudies = \App\Models\CaseStudy::where('is_published', true)->latest()->take(6)->get();
    $marketingServices = \App\Models\MarketingService::where('is_active', true)->orderBy('sort_order')->get();
    return view('profile', compact('categories', 'caseStudies', 'marketingServices'));
})->name('portfolio');
Route::get('/case-study/{slug}', [\App\Http\Controllers\CaseStudyController::class, 'show'])->name('case-study.show');

// Category route
Route::get('/category/{category:slug}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');

/**
 * Public Prototype Preview Route
 *
 * URL:    /p/{slug}
 * Method: GET
 * Name:   prototype.preview
 *
 * Accessible to anyone (no authentication required).
 * Returns 404 if the prototype does not exist or is_public = false.
 */
Route::get('/p/{slug}', [PrototypeController::class, 'show'])
    ->name('prototype.preview')
    ->where('slug', '[a-z0-9\-]+'); // Only allow valid slug characters
