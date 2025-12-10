<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('home',[HomeController::class,'index'])->name('home');
Route::get('/',[HomeController::class,'index']);

Route::get('register',[RegisterController::class,'index'])->name('register');
Route::post('register',[RegisterController::class,'store']);

Route::get('login',[LoginController::class,'index'])->name('login');
Route::post('login',[LoginController::class,'store']);
Route::get('logout',[LoginController::class,'logout']);
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::get('tasks',[TaskController::class,'index'])->name('tasks');
    Route::get('tasks/create',[TaskController::class,'create']);
    Route::post('tasks',[TaskController::class,'store']);
    Route::get('tasks/edit/{id}',[TaskController::class,'edit']);
    Route::put('tasks/editing/{id}',[TaskController::class,'update']);
    Route::get('tasks/destroy/{id}',[TaskController::class,'destroy']);
    Route::get('tasks/complete/{id}',[TaskController::class,'markComplete']);
    Route::get('tasks/incomplete/{id}',[TaskController::class,'markPending']);

    Route::get('users',[\App\Http\Controllers\UserController::class ,'index'])->name('users');
    Route::get('users/create',[\App\Http\Controllers\UserController::class ,'create']);
    Route::post('users',[\App\Http\Controllers\UserController::class ,'store']);
    Route::get('users/edit/{id}',[\App\Http\Controllers\UserController::class ,'edit']);
    Route::put('users/editing/{id}',[\App\Http\Controllers\UserController::class ,'update']);
    Route::get('users/delete/{id}',[\App\Http\Controllers\UserController::class ,'destroy']);

    Route::get('roles',[\App\Http\Controllers\RoleController::class ,'index'])->name('roles');
    Route::get('roles/create',[\App\Http\Controllers\RoleController::class ,'create']);
    Route::post('roles',[\App\Http\Controllers\RoleController::class ,'store']);
    Route::get('roles/edit/{id}',[\App\Http\Controllers\RoleController::class ,'edit']);
    Route::put('roles/editing/{id}',[\App\Http\Controllers\RoleController::class ,'update']);
    Route::get('roles/delete/{id}',[\App\Http\Controllers\RoleController::class ,'destroy']);

    Route::get('audit',[\App\Http\Controllers\AuditTrailController::class,'index'])->name('audit');

    Route::get('notifications/read-all', [App\Http\Controllers\NotificationController::class, 'readAll'])
        ->name('notifications');
});

