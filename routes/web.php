<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;

// Public routes (accessible without authentication)
Route::middleware('guest')->group(function () {
    // Welcome page (public landing page)
    Route::get('test', function () {
        return view('test');
    })->name('test');
    
    // Login routes
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    
    // Registration routes
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
    Route::get('companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('companies', [CompanyController::class, 'store'])->name('companies.store');

});

// Authenticated routes (require login)
Route::middleware('auth')->group(function () {
    Route::get('home', [HomeController::class, 'redirectToHome'])->name('home');

    
    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');
    });

