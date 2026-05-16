<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\FinanceController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.submit');
Route::get('/signup', [AuthenticationController::class, 'signUp'])->name('signUp');
Route::post('/signup', [AuthenticationController::class, 'store'])->name('signup.store');
Route::get('/reset-password', [AuthenticationController::class, 'resetPassword'])->name('reset-password');
Route::post('/reset-password', [AuthenticationController::class, 'checkResetEmail'])->name('reset-password.check');
Route::get('/new-password', [AuthenticationController::class, 'newPassword'])->name('new-password');
Route::post('/new-password', [AuthenticationController::class, 'updatePassword'])->name('new-password.update');

Route::middleware('auth')->group(function () {
    Route::view('/index', 'index')->name('index');
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    Route::get('/account', [AccountController::class, 'show'])->name('account.show');
    Route::get('/account/photo', [AccountController::class, 'photo'])->name('account.photo');
    Route::put('/account', [AccountController::class, 'update'])->name('account.update');

    Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');
    Route::post('/finance', [FinanceController::class, 'store'])->name('finance.store');
    Route::put('/finance/{finance}', [FinanceController::class, 'update'])->name('finance.update');
    Route::delete('/finance/{finance}', [FinanceController::class, 'destroy'])->name('finance.destroy');
});
