<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifikatorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// User Routes
Route::post('/register', [UserController::class, 'register'])->middleware('guest');

// Admin Routes
Route::middleware(['auth','role:Admin'])->group(function () {
    Route::get('/users', [AdminController::class, 'getAllUsers']);
    Route::post('/register-verifikator', [AdminController::class, 'registerVerifikator']);
    Route::put('/user/{id}/make-verifikator', [AdminController::class, 'promoteUser']);
    Route::get('/izin', [AdminController::class, 'getIzinRequests']);
    Route::post('/user/{id}/reset-password', [AdminController::class, 'resetPassword']);
});

//Verifikator Routes
Route::middleware(['auth','role:Verifikator'])->group(function () {
    Route::post('/verifikasi-pendaftaran', [VerifikatorController::class, 'verifikasiPendaftaran']);
    Route::put('/izin/{id}/verifikasi', [VerifikatorController::class, 'verifikasiIzin']);
});
//User Routes
Route::middleware(['auth','role:User'])->group(function () {
    Route::post('/ajukan-izin', [UserController::class, 'ajukanIzin']);
    Route::get('/izin-saya', [UserController::class, 'getPermissionHistory']);
    Route::put('/izin/{id}/update', [UserController::class, 'updatePermissionHistory']);
    Route::get('/izin/{id}/status', [UserController::class, 'getPermissionStatus']);
    Route::delete('/izin/{id}', [UserController::class, 'batalIzin']);
    Route::delete('/izin/{id}/delete', [UserController::class, 'hapusIzin']);
    Route::put('/update-password', [UserController::class, 'updatePassword']);
});