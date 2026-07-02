<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyRequestController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\ThaiAddressController;
use App\Http\Controllers\AssetsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes – ERA Real Estate
|--------------------------------------------------------------------------
*/

// ── Home ─────────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::post('/properties/{property}/views', [PropertyController::class, 'recordView'])
    ->whereUuid('property')
    ->name('properties.views');
Route::get('/properties/{property}', [PropertyController::class, 'show'])
    ->whereUuid('property')
    ->name('properties.show');
Route::get('/property-requests', [PropertyRequestController::class, 'index'])->name('property-requests.index');
Route::post('/property-requests', [PropertyRequestController::class, 'store'])
    ->middleware('throttle:5,10')
    ->name('property-requests.store');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/sellers', [SellerController::class, 'index'])->name('sellers.index');
Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');



Route::get('/assets/view/{id}', [AssetsController::class, 'view'])->name('assets.view');


Route::prefix('api/thai-addresses')->name('api.thai-addresses.')->group(function () {
    Route::get('/provinces', [ThaiAddressController::class, 'provinces'])->name('provinces');
    Route::get('/districts', [ThaiAddressController::class, 'districts'])->name('districts');
    Route::get('/sub-districts', [ThaiAddressController::class, 'subDistricts'])->name('sub-districts');
});
