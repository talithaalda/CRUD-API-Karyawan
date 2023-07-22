<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AuthController;


Route::middleware('auth:sanctum')->group( function () {
    Route::resource('karyawan', KaryawanController::class);
    Route::get('/first-three-joining', [KaryawanController::class, 'tigakaryawanpertama']);
    Route::get('/cutikaryawan', [KaryawanController::class, 'CutiKaryawan']);
    Route::get('/sisacutikaryawan', [KaryawanController::class, 'sisaCutiKaryawan']);
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
