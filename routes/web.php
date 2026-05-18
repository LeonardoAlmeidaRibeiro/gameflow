<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\MuscleGroupController;
use App\Http\Controllers\ExerciseCategoryController;



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
    Route::get('/index', [FinanceController::class, 'dashboard'])->name('index');
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    Route::get('/account', [AccountController::class, 'show'])->name('account.show');
    Route::get('/account/photo', [AccountController::class, 'photo'])->name('account.photo');
    Route::put('/account', [AccountController::class, 'update'])->name('account.update');

    Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');
    Route::post('/finance', [FinanceController::class, 'store'])->name('finance.store');
    Route::put('/finance/{finance}', [FinanceController::class, 'update'])->name('finance.update');
    Route::delete('/finance/{finance}', [FinanceController::class, 'destroy'])->name('finance.destroy');
    Route::post('/finance/payment-methods', [FinanceController::class, 'storePaymentMethod'])->name('finance.payment-methods.store');
    Route::put('/finance/payment-methods/{paymentMethod}', [FinanceController::class, 'updatePaymentMethod'])->name('finance.payment-methods.update');
    Route::delete('/finance/payment-methods/{paymentMethod}', [FinanceController::class, 'destroyPaymentMethod'])->name('finance.payment-methods.destroy');

    Route::get('/categoria', [CategoriaController::class, 'index'])->name('categoria.index');
    Route::post('/categoria', [CategoriaController::class, 'store'])->name('categoria.store');
    Route::put('/categoria/{categoria}', [CategoriaController::class, 'update'])->name('categoria.update');
    Route::delete('/categoria/{categoria}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');

    Route::get('/workouts', [WorkoutController::class, 'index'])->name('workouts.index');
    Route::post('/workouts', [WorkoutController::class, 'storeWorkout'])->name('workouts.store');
    Route::put('/workouts/{workout}', [WorkoutController::class, 'updateWorkout'])->name('workouts.update');
    Route::delete('/workouts/{workout}', [WorkoutController::class, 'destroyWorkout'])->name('workouts.destroy');
    Route::post('/workouts/progress', [WorkoutController::class, 'storeProgress'])->name('workouts.progress.store');
    Route::put('/workouts/progress/{progress}', [WorkoutController::class, 'updateProgress'])->name('workouts.progress.update');
    Route::delete('/workouts/progress/{progress}', [WorkoutController::class, 'destroyProgress'])->name('workouts.progress.destroy');
    Route::post('/workouts/divisions', [WorkoutController::class, 'storeDivision'])->name('workouts.divisions.store');
    Route::put('/workouts/divisions/{division}', [WorkoutController::class, 'updateDivision'])->name('workouts.divisions.update');
    Route::delete('/workouts/divisions/{division}', [WorkoutController::class, 'destroyDivision'])->name('workouts.divisions.destroy');
    Route::post('/workouts/exercises', [WorkoutController::class, 'storeExercise'])->name('workouts.exercises.store');
    Route::put('/workouts/exercises/{exercise}', [WorkoutController::class, 'updateExercise'])->name('workouts.exercises.update');
    Route::delete('/workouts/exercises/{exercise}', [WorkoutController::class, 'destroyExercise'])->name('workouts.exercises.destroy');
    Route::post('/workouts/routines', [WorkoutController::class, 'storeRoutine'])->name('workouts.routines.store');
    Route::put('/workouts/routines/{routine}', [WorkoutController::class, 'updateRoutine'])->name('workouts.routines.update');
    Route::delete('/workouts/routines/{routine}', [WorkoutController::class, 'destroyRoutine'])->name('workouts.routines.destroy');
    Route::post('/workouts/checkins', [WorkoutController::class, 'storeCheckin'])->name('workouts.checkins.store');

    Route::get('/muscle-group', [MuscleGroupController::class, 'index'])->name('muscle-group.index');
    Route::post('/muscle-group', [MuscleGroupController::class, 'store'])->name('muscle-group.store');
    Route::put('/muscle-group/{muscleGroup}', [MuscleGroupController::class, 'update'])->name('muscle-group.update');
    Route::delete('/muscle-group/{muscleGroup}', [MuscleGroupController::class, 'destroy'])->name('muscle-group.destroy');

    Route::get('/exercise_categories', [ExerciseCategoryController::class, 'index'])->name('exercise_categories.index');
    Route::post('/exercise_categories', [ExerciseCategoryController::class, 'store'])->name('exercise_categories.store');
    Route::put('/exercise_categories/{exerciseCategory}', [ExerciseCategoryController::class, 'update'])->name('exercise_categories.update');
    Route::delete('/exercise_categories/{exerciseCategory}', [ExerciseCategoryController::class, 'destroy'])->name('exercise_categories.destroy');
});
