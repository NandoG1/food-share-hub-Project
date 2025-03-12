<?php

use App\Http\Controllers\AidHistoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodRequestController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('guest')->group(function () {
    // Registration
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Login routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/food-requests/create', [FoodRequestController::class, 'create'])->name('food-requests.create');
    Route::post('/food-requests', [FoodRequestController::class, 'store'])->name('food-requests.store');
    Route::get('/food-requests', [FoodRequestController::class, 'index'])->name('food-requests.index');
    Route::get('/food-requests/{foodRequest}', [FoodRequestController::class, 'show'])->name('food-requests.show');

    Route::get('/aid-history', [AidHistoryController::class, 'index'])->name('aid-history.index');
    Route::get('/aid-history/{foodRequest}', [AidHistoryController::class, 'show'])->name('aid-history.show');
    Route::get('/aid-history/export', [AidHistoryController::class, 'export'])->name('aid-history.export');

    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');
});
