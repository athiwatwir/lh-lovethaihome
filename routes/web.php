<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes – ERA Real Estate
|--------------------------------------------------------------------------
*/

// ── Home ─────────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
