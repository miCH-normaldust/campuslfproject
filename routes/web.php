<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Public Welcome Landing Page (Exclusively for Guests)
Route::get('/', [DashboardController::class, 'welcome'])->name('welcome');

// Public Guest Feed/Browse Route
Route::get('/guest/feed', [DashboardController::class, 'guest'])->name('guest.dashboard');

// Auth Routes (Unauthenticated Guests Only)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout (Authenticated Users)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Dashboards
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'user'])->name('user.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
});