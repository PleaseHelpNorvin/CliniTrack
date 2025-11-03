<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Nurse\DashboardController as NurseDashboard;
use App\Http\Controllers\Staff\DashboardController as StaffDashboard;

Route::get('/', fn() => view('welcome'));

// Login routes
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Admin routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

// Nurse routes
Route::prefix('nurse')->middleware(['auth', 'role:nurse'])->group(function () {
    Route::get('/dashboard', [NurseDashboard::class, 'index'])->name('nurse.dashboard');
});

// Staff routes
Route::prefix('staff')->middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/dashboard', [StaffDashboard::class, 'index'])->name('staff.dashboard');
});