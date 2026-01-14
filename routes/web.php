<?php

use App\Http\Controllers\AuthPageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordResetOtpController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthPageController::class, 'index'])->name('auth');
Route::get('/auth', [AuthPageController::class, 'index']);
Route::post('/auth/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/auth/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/auth/reset', [PasswordResetOtpController::class, 'send'])->name('password.otp.send');
Route::view('/dashboard', 'dashboard')->middleware('auth')->name('dashboard');
Route::view('/jurnal', 'jurnal')->middleware('auth')->name('jurnal');
Route::view('/insomnia', 'insomnia')->middleware('auth')->name('insomnia');
Route::view('/database-user', 'databaseuser')->middleware('auth')->name('database.user');
Route::view('/database-user/update', 'databaseuser')->middleware('auth')->name('users.update');
Route::view('/database-user/reset-password', 'databaseuser')->middleware('auth')->name('users.reset-password');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('auth', ['page' => 'masuk']);
})->name('logout');
