<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StudentController as AdminStudent;
use App\Http\Controllers\Admin\ReportController as AdminReports;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Nurse\DashboardController as NurseDashboard;
use App\Http\Controllers\Nurse\DiagnosisController;
use App\Http\Controllers\Nurse\StudentController as NurseStudent;
use App\Http\Controllers\Nurse\ReportController as NurseReports;
use App\Http\Controllers\Nurse\VisitController;
use App\Http\Controllers\Public\PublicFormController;
use App\Http\Controllers\Nurse\ReferralController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboard;
use App\Models\Form;

// Route::get('/', fn() => view('welcome'));
// Landing Page Routes
Route::get('/', [LandingPageController::class,'index'])->name('landing');
// Login routes
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix('public')->group(function() {
    Route::get('/student-profile/create', [PublicFormController::class, 'createStudentProfile'])->name('public.students.create');
    Route::post('/student-profile/store', [PublicFormController::class, 'StoreStudentProfile'])->name('public.students.store');
    Route::get('/visit/create', [PublicFormController::class, 'createVisit'])->name('public.visit.create');
    Route::post('/visit/store', [PublicFormController::class, 'storeVisit'])->name('public.visit.store');
    Route::prefix('referral_histories')->group(function() {
        Route::get('/', [PublicFormController::class, 'indexReferralHistory'])->name('public.referral_histories.index');
        Route::get('/create/{referral}',[PublicFormController::class,'createReferralHistory'])->name('public.referral_histories.create');
        Route::post('/store/{referral}/history',[PublicFormController::class,'storeReferralHistory'])->name('public.referral_histories.store');
        Route::post('/store/{referral}/attachment', [PublicFormController::class,'storeReferralAttachment'])->name('public.referral_attachments.store');
        
    });
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::prefix('users')->group(function (){
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/store', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::post('/update/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/delete/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    }); 

    Route::prefix('students')->group(function (){
        Route::get('/', [AdminStudent::class, 'index'])->name('admin.students.index');
        Route::get('/create', [AdminStudent::class, 'create'])->name('admin.students.create');
        Route::post('/store', [AdminStudent::class, 'store'])->name('admin.students.store');
        Route::get('/view/{student}',[AdminStudent::class, 'view'])->name('admin.students.view');
        Route::get('/edit/{student}',[AdminStudent::class, 'edit'])->name('admin.students.edit');
        Route::post('/update/{student}',[AdminStudent::class, 'update'])->name('admin.students.update');
        Route::delete('/students/{student}', [AdminStudent::class, 'destroy'])->name('admin.students.destroy');
    }); 

    Route::prefix('documents')->group(function () {
        Route::get('/create/{student}', [DocumentController::class, 'create'])->name('admin.documents.create');
        Route::post('/store', [DocumentController::class, 'store'])->name('admin.documents.store');
        Route::delete('/destroy/{document}', [DocumentController::class, 'destroy'])->name('admin.documents.destroy');
    });

    Route::prefix('forms')->group(function (){
        Route::get('/create', [FormController::class,'create'])->name('admin.forms.create');
        Route::post('/store', [FormController::class,'store'])->name('admin.forms.store');
        Route::get('/edit/{form}', [FormController::class, 'edit'])->name('admin.forms.edit');
        Route::post('/update/{form}', [FormController::class, 'update'])->name('admin.forms.update');
        Route::delete('/destroy/{form}', [FormController::class,'destroy'])->name('admin.forms.destroy');
    });
    Route::prefix('reports')->group(function (){
        Route::get('/', [AdminReports::class, 'index'])->name('admin.reports.index');
        Route::get('/export/{format}', [AdminReports::class, 'export'])->name('admin.reports.export');

    }); 
    Route::prefix('logs')->group(function (){
        Route::get('/', [ActivityLogController::class, 'index'])->name('admin.logs.index');
    }); 
    Route::prefix('settings')->group(function (){
    Route::get('/confirm-password', [SettingController::class, 'confirmPasswordForm'])->name('admin.settings.confirm-password');
    Route::post('/check-password', [SettingController::class, 'checkPassword'])->name('admin.settings.check-password');
    Route::get('/', [SettingController::class, 'index'])
        ->middleware('password.confirm') // optional, Laravel built-in
        ->name('admin.settings.index');
    });
});

// Nurse routes
Route::prefix('nurse')->middleware(['auth', 'role:nurse'])->group(function () {
    Route::get('/dashboard', [NurseDashboard::class, 'index'])->name('nurse.dashboard');
    Route::post('/assign-self/{id}', [NurseDashboard::class, 'assignSelf'])->name('nurse.assignSelf');

    Route::prefix('students')->group(function (){
        Route::get('/', [NurseStudent::class, 'index'])->name('nurse.students.index');
        Route::get('/create', [NurseStudent::class, 'create'])->name('nurse.students.create');
        Route::post('/store', [NurseStudent::class, 'store'])->name('nurse.students.store');
        Route::get('/view/{student}', [NurseStudent::class, 'view'])->name('nurse.students.view');
        Route::get('/edit/{student}', [NurseStudent::class, 'edit'])->name('nurse.students.edit');
        Route::post('/update/{student}', [NurseStudent::class, 'update'])->name('nurse.students.update');
        Route::delete('destroy/{student}', [NurseStudent::class, 'destroy'])->name('nurse.students.destroy');
    });
    Route::prefix('diagnosis')->group(function (){
        Route::get('/', [DiagnosisController::class, 'index'])->name('nurse.diagnosis.index'); // list all visits
        Route::post('/{visit}', [DiagnosisController::class, 'store'])->name('nurse.diagnosis.store'); // view a visit
    });

    Route::prefix('referrals')->group(function() {
        Route::get('/', [ReferralController::class, 'index'])->name('nurse.referral.index');
        Route::get('/{referral}', [ReferralController::class, 'show'])->name('nurse.referral.show');
        Route::get('/{referral}/edit', [ReferralController::class, 'edit'])->name('nurse.referral.edit');
        Route::post('/{referral}', [ReferralController::class, 'update'])->name('nurse.referral.update');
    });

    Route::prefix('visits')->group(function () {
        Route::get('/', [VisitController::class, 'index'])->name('nurse.visits.index');
        Route::get('/create', [VisitController::class, 'create'])->name('nurse.visits.create'); 
        Route::post('/store', [VisitController::class, 'store'])->name('nurse.visits.store'); 
        Route::get('/view/{visit}', [VisitController::class, 'view'])->name('nurse.visits.view'); 
        Route::get('/edit/{visit}', [VisitController::class, 'edit'])->name('nurse.visits.edit');
        Route::put('/update/{visit}', [VisitController::class, 'update'])->name('nurse.visits.update');
        Route::delete('/destroy/{visit}', [VisitController::class, 'destroy'])->name('nurse.visits.destroy');
    });

    Route::prefix('documents')->group(function () {
        Route::get('/create/{student}', [DocumentController::class, 'create'])->name('nurse.documents.create');
        Route::post('/store', [DocumentController::class, 'store'])->name('nurse.documents.store');
        Route::delete('/destroy/{document}', [DocumentController::class, 'destroy'])->name('nurse.documents.destroy');
    });

    Route::prefix('reports')->group(function (){
        Route::get('/', [NurseReports::class, 'index'])->name('nurse.reports.index');
    }); 
});

