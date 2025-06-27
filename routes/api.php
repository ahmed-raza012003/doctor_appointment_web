<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BlogController;

Route::get('/services', [ServiceController::class, 'apiIndex']);
Route::get('specializations', [ServiceController::class, 'apiIndex']);
Route::get('/categories', [CategoryController::class, 'apiIndex']);
Route::get('/blogs', action: [BlogController::class, 'apiIndex']);
Route::get('/doctors', [DoctorController::class, 'apiIndex']);




