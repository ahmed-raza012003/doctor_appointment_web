<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BlogController;

Route::get('/services', [ServiceController::class, 'apiIndex']);
Route::get('/categories', [CategoryController::class, 'apiIndex']);
Route::get('/blogs', action: [BlogController::class, 'apiIndex']);



