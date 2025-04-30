<?php

use App\Http\Controllers\{
    PageController, AuthController, WeatherController, 
    HomeController, FarmerController, ProfileController, 
    FarmDataController, CropRecommendationController
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
    Route::get('/admin/weather', [PageController::class, 'weather'])->name('admin.weather');
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

// 📌 Static Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
