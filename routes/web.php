<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ReportController as AdminReports;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\SettingController;

use App\Http\Controllers\Nurse\DashboardController as NurseDashboard;
use App\Http\Controllers\Nurse\PatientController;
use App\Http\Controllers\Nurse\ReportController as NurseReports;
use App\Http\Controllers\Nurse\VisitController;

use App\Http\Controllers\Staff\DashboardController as StaffDashboard;



Route::get('/', fn() => view('welcome'));

// Login routes
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Admin routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::prefix('users')->group(function (){
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
    }); 
    Route::prefix('students')->group(function (){
        Route::get('/', [StudentController::class, 'index'])->name('admin.students.index');
    }); 
    Route::prefix('reports')->group(function (){
        Route::get('/', [AdminReports::class, 'index'])->name('admin.reports.index');
    }); 
    Route::prefix('logs')->group(function (){
        Route::get('/', [ActivityLogController::class, 'index'])->name('admin.logs.index');
    }); 
    Route::prefix('settings')->group(function (){
        Route::get('/', [SettingController::class, 'index'])->name('admin.settings.index');
    }); 
});

// Nurse routes
Route::prefix('nurse')->middleware(['auth', 'role:nurse'])->group(function () {
    Route::get('/dashboard', [NurseDashboard::class, 'index'])->name('nurse.dashboard');
    Route::prefix('patients')->group(function (){
        Route::get('/', [PatientController::class, 'index'])->name('nurse.patients.index');
    }); 
    Route::prefix('visits')->group(function (){
        Route::get('/', [VisitController::class, 'index'])->name('nurse.visits.index');
    }); 
    Route::prefix('reports')->group(function (){
        Route::get('/', [NurseReports::class, 'index'])->name('nurse.reports.index');
    }); 
});

// Staff routes
Route::prefix('staff')->middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/dashboard', [StaffDashboard::class, 'index'])->name('staff.dashboard');
});