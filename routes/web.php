<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\FinanceController;
use Illuminate\Support\Facades\Route;

// Welcome page
Route::get('/', function () { return view('welcome'); });

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
    Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// UMKM Owner Routes
Route::middleware(['auth', 'role:UMKM Owner'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::delete('/reports/{transaction}', [ReportController::class, 'destroy'])->name('reports.destroy');
    Route::get('/analysis', [AnalysisController::class, 'index'])->name('analysis.index');
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('articles', AdminArticleController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/analyze-form', function () {
    return view('finance-analyzer');
});

Route::post('/finance/analyze', [FinanceController::class, 'analyzeFinancialData']);

// Settings Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.updateProfile');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.updatePassword');
    Route::put('/settings/preferences', [SettingsController::class, 'updatePreferences'])->name('settings.updatePreferences');
    Route::put('/settings/security', [SettingsController::class, 'updateSecurity'])->name('settings.updateSecurity');
});