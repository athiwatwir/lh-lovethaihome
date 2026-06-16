<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyRequestController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes – ERA Real Estate
|--------------------------------------------------------------------------
*/

// ── Home ─────────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property}', [PropertyController::class, 'show'])
    ->whereUuid('property')
    ->name('properties.show');
Route::get('/property-requests', [PropertyRequestController::class, 'index'])->name('property-requests.index');
Route::post('/property-requests', [PropertyRequestController::class, 'store'])
    ->middleware('throttle:5,10')
    ->name('property-requests.store');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
