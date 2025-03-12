<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('dashboard-admin');
});

Route::middleware(['auth', 'user'])->group(function(){
    Route::get('/user', [UserController::class, 'index'])->name('dashboard-user');
});

Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('requests/see', [RequestController::class, 'index'])->name('requests.see');
});


