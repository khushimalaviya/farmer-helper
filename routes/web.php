<?php

use App\Http\Controllers\{
    PageController,
    AuthController,
    WeatherController,
    HomeController,
    FarmerController,
    ProfileController,
    FarmDataController,
    CropRecommendationController,
    FarmerCrudController
};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;

// Home Page
Route::get('/', function () {
    return view('home');
})->name('home');

// Authentication Routes using Sanctum
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware(['auth:sanctum'])->post('/logout', [AuthController::class, 'logout'])->name('logout');

//  Forgot Password
Route::get('/forgot_password', [PageController::class, 'showForgotPasswordForm'])->name('password.request');

// Dashboard Route
Route::middleware(['auth:sanctum'])->get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

//  Admin Dashboard
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [PageController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/farmers', [PageController::class, 'farmers'])->name('admin.farmers');
    Route::get('/admin/crops', [PageController::class, 'crops'])->name('admin.crops');
    Route::get('/admin/weather', [WeatherController::class, 'showWeather'])->name('admin.weather');

    // Admin routes group
    Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
        // Route for showing all farmers (index)
        Route::get('farmers', [FarmerCrudController::class, 'index'])->name('farmers');

        // Route for creating a new farmer
        Route::get('farmers/create', [FarmerCrudController::class, 'create'])->name('farmers.create');
        Route::post('farmers', [FarmerCrudController::class, 'store'])->name('farmers.store');

        // Route for editing a farmer
        Route::get('farmers/{farmer}/edit', [FarmerCrudController::class, 'edit'])->name('farmers.edit');
        Route::put('farmers/{farmer}', [FarmerCrudController::class, 'update'])->name('farmers.update');

        // Route for deleting a farmer
        Route::delete('farmers/{farmer}', [FarmerCrudController::class, 'destroy'])->name('farmers.destroy');
    });

});

// User Dashboard
Route::middleware(['auth:sanctum', 'role:farmer'])->get('/user/dashboard', function () {
    return view('home');
})->name('user.dashboard');

// Weather Routes
Route::middleware(['auth:sanctum', 'role:farmer'])->group(function () {
    Route::get('/weather', [WeatherController::class, 'index'])->name('weather.index');
    Route::post('/weather', [WeatherController::class, 'getWeather'])->name('weather.get');
});

//  Farmer Profile Routes
Route::middleware(['auth:sanctum', 'role:farmer'])->group(function () {
    Route::get('/farmers/profile', [ProfileController::class, 'profile'])->name('farmers.profile');
    Route::post('/farmers/profile', [ProfileController::class, 'updateProfile'])->name('profile.submit');
});

// Farm Data Routes
Route::middleware(['auth:sanctum', 'role:farmer'])->group(function () {
    Route::get('/farmdata', [FarmerController::class, 'farmData'])->name('farmdata');
    Route::post('/farmdata', [FarmerController::class, 'submitFarmData'])->name('farmdata.submit');
});

// Static Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

//crop recommedation
// Show crop recommendation result (optional direct route)
Route::middleware(['auth:sanctum', 'role:farmer'])->get('/crop-recommendation', function () {
    return view('farmers.crop_recommendation');
})->name('crop.recommendation');

Route::get('download-report/{farmId}', [FarmerController::class, 'downloadReport'])->name('farmers.downloadReport');

Route::post('/weather-detail', [WeatherController::class, 'getWeatherDetail'])->name('weather.get.detail');
