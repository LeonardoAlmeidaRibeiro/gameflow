<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

Route::get('/', function () {
    return view('authentication.sign-up');
});

Route::view('/index', 'index')->name('index');
Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.submit');
Route::get('/signup', [AuthenticationController::class, 'signUp'])->name('signUp');
Route::post('/signup', [AuthenticationController::class, 'store'])->name('signup.store');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
Route::get('/reset-password', [AuthenticationController::class, 'resetPassword'])->name('reset-password');
Route::post('/reset-password', [AuthenticationController::class, 'checkResetEmail'])->name('reset-password.check');
Route::get('/new-password', [AuthenticationController::class, 'newPassword'])->name('new-password');
Route::post('/new-password', [AuthenticationController::class, 'updatePassword'])->name('new-password.update');
