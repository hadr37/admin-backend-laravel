<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtikelController;

// 🔹 CATEGORY ROUTES
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{category}', [CategoryController::class, 'update']);
Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);

// 🔹 BARANG ROUTES
Route::apiResource('barang', BarangController::class);

// 🔹 USER ROUTES
Route::apiResource('users', UserController::class);

// 🔹 ARTIKEL ROUTES
Route::get('/artikel', [ArtikelController::class, 'index']);
Route::post('/artikel', [ArtikelController::class, 'store']);
Route::get('/artikel/{artikel:slug}', [ArtikelController::class, 'show']);
Route::put('/artikel/{artikel:slug}', [ArtikelController::class, 'update']);
Route::delete('/artikel/{artikel:slug}', [ArtikelController::class, 'destroy']);

// 🔹 AUTH ROUTES
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// 🔹 Ambil data user login
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 🔹 PESAN ROUTES (PENTING)
Route::get('/pesan', [PesanController::class, 'index']);
Route::post('/pesan', [PesanController::class, 'store']);
Route::delete('/pesan/{id}', [PesanController::class, 'destroy']);