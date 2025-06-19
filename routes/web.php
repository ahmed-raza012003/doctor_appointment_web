<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;

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
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Admin routes with explicit GET and POST
Route::prefix('admin')->middleware([])->group(function () {
    // List specializations
    Route::get('specializations', [SpecializationController::class, 'index'])->name('admin.specializations.index');

    // Show create form
    Route::get('specializations/create', [SpecializationController::class, 'create'])->name('admin.specializations.create');

    // Store new specialization
    Route::post('specializations', [SpecializationController::class, 'store'])->name('admin.specializations.store');

 Route::get('doctors', [DoctorController::class, 'index'])->name('admin.doctors.index');
    Route::get('doctors/create', [DoctorController::class, 'create'])->name('admin.doctors.create');
    Route::post('doctors', [DoctorController::class, 'store'])->name('admin.doctors.store');
   Route::get('patients', [PatientController::class, 'index'])->name('admin.patients.index');
    Route::get('patients/create', [PatientController::class, 'create'])->name('admin.patients.create');
    Route::post('patients', [PatientController::class, 'store'])->name('admin.patients.store');
    Route::get('patients/{patient}/edit', [PatientController::class, 'edit'])->name('admin.patients.edit');
    Route::put('patients/{patient}', [PatientController::class, 'update'])->name('admin.patients.update');
    Route::delete('patients/{patient}', [PatientController::class, 'destroy'])->name('admin.patients.destroy');
Route::get('services', [ServiceController::class, 'index'])->name('admin.services.index');
    Route::get('services/create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::post('services', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('services/{service}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');
});

