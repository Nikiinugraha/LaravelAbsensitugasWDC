<?php

use App\Models\Presence;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PresenceDetailController;

Route::get('/', function () {
    $presences = \App\Models\Presence::latest()->get();
    return view('pages.index', compact('presences'));
})->name('home');

// Admin
Route::resource('presence', PresenceController::class);
Route::delete('presence-detail/{id}', [PresenceDetailController::class, 'destroy'])->name('presence-detail.destroy'); 

// Publik
Route::get('absen/{slug}', [AbsenController::class, 'index'])->name('absen.index');
Route::post('absen', [AbsenController::class, 'store'])->name('absen.store');



// Route untuk halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk register (opsional)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);