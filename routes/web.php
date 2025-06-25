<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ServiceController;


use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Guest routes
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

// Admin routes with explicit GET and POST
Route::prefix('admin')->middleware([])->group(function () {
    // List specializations
    Route::get('specializations', [SpecializationController::class, 'index'])->name('admin.specializations.index');

    // Show create form
    Route::get('specializations/create', [SpecializationController::class, 'create'])->name('admin.specializations.create');

    // Store new specialization
    Route::post('specializations', [SpecializationController::class, 'store'])->name('admin.specializations.store');
Route::get('specializations/{specialization}/edit', [SpecializationController::class, 'edit'])->name('admin.specializations.edit');
    Route::put('specializations/{specialization}', [SpecializationController::class, 'update'])->name('admin.specializations.update');
    Route::delete('specializations/{specialization}', [SpecializationController::class, 'destroy'])->name('admin.specializations.destroy');

    // Doctor and Patient management
 Route::get('doctors', [DoctorController::class, 'index'])->name('admin.doctors.index');
    Route::get('doctors/create', [DoctorController::class, 'create'])->name('admin.doctors.create');
    Route::post('doctors', [DoctorController::class, 'store'])->name('admin.doctors.store');
   Route::get('doctors/{doctor}/edit', [DoctorController::class, 'edit'])->name('admin.doctors.edit');
    Route::put('doctors/{doctor}', [DoctorController::class, 'update'])->name('admin.doctors.update');
    Route::delete('doctors/{doctor}', [DoctorController::class, 'destroy'])->name('admin.doctors.destroy');
   
   
   
    Route::get('patients', [PatientController::class, 'index'])->name('admin.patients.index');
    Route::get('patients/create', [PatientController::class, 'create'])->name('admin.patients.create');
    Route::post('patients', [PatientController::class, 'store'])->name('admin.patients.store');
    Route::get('patients/{patient}/edit', [PatientController::class, 'edit'])->name('admin.patients.edit');
    Route::put('patients/{patient}', [PatientController::class, 'update'])->name('admin.patients.update');
    Route::delete('patients/{patient}', [PatientController::class, 'destroy'])->name('admin.patients.destroy');
Route::get('consultations', [ConsultationController::class, 'index'])->name('admin.Consultations.index');
    Route::get('consultations/create', [ConsultationController::class, 'create'])->name('admin.consultations.create');
    Route::post('consultations', [ConsultationController::class, 'store'])->name('admin.consultations.store');
    Route::get('consultations/{consultation}/edit', [ConsultationController::class, 'edit'])->name('admin.consultations.edit');
    Route::put('consultations/{consultation}', [ConsultationController::class, 'update'])->name('admin.consultations.update');
    Route::delete('consultations/{consultation}', [ConsultationController::class, 'destroy'])->name('admin.consultations.destroy');
Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
Route::get('blogs', [BlogController::class, 'index'])->name('admin.blogs.index');
    Route::get('blogs/create', [BlogController::class, 'create'])->name('admin.blogs.create');
    Route::post('blogs', [BlogController::class, 'store'])->name('admin.blogs.store');
    Route::get('blogs/{blog}/edit', [BlogController::class, 'edit'])->name('admin.blogs.edit');
    Route::put('blogs/{blog}', [BlogController::class, 'update'])->name('admin.blogs.update');
    Route::delete('blogs/{blog}', [BlogController::class, 'destroy'])->name('admin.blogs.destroy');
    Route::get('blogs/{blog}', [BlogController::class, 'show'])->name('admin.blogs.show');
    Route::get('services', [ServiceController::class, 'index'])->name('admin.services.index');
    Route::get('services/create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::post('services', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('services/{service}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('admin.services.destroy'); 

});

