<?php

use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Admin (auth required for dashboard)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'))->middleware('auth');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings')->middleware('auth');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update')->middleware('auth');
    Route::get('/pages/home', [HomePageController::class, 'edit'])->name('pages.home')->middleware('auth');
    Route::post('/pages/home', [HomePageController::class, 'update'])->name('pages.home.update')->middleware('auth');
    Route::get('/pages/contact', [ContactPageController::class, 'edit'])->name('pages.contact')->middleware('auth');
    Route::post('/pages/contact', [ContactPageController::class, 'update'])->name('pages.contact.update')->middleware('auth');
    Route::get('/pages/about', [AboutPageController::class, 'edit'])->name('pages.about')->middleware('auth');
    Route::post('/pages/about', [AboutPageController::class, 'store'])->name('pages.about.store')->middleware('auth');
    Route::get('/pages/about/{teamMember}/edit', [AboutPageController::class, 'editMember'])->name('pages.about.edit-member')->middleware('auth');
    Route::put('/pages/about/{teamMember}', [AboutPageController::class, 'update'])->name('pages.about.update')->middleware('auth');
    Route::delete('/pages/about/{teamMember}', [AboutPageController::class, 'destroy'])->name('pages.about.destroy')->middleware('auth');
    Route::get('/partners', fn () => redirect()->route('admin.pages.home'))->name('partners')->middleware('auth');
    Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store')->middleware('auth');
    Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy')->middleware('auth');
});

Route::get('/what-we-do', function () {
    return view('what-we-do');
})->name('what-we-do');

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/partner-we-seek', function () {
    return view('partner-we-seek');
})->name('partner-we-seek');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
