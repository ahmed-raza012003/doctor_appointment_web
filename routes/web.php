<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\DoctorController;

use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

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

});
