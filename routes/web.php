<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/index', 'index')->name('index');
Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

