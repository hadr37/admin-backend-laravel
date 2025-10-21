<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArtikelController;

Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{category}', [CategoryController::class, 'update']);
Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);

Route::apiResource('barang', BarangController::class);
Route::apiResource('users', UserController::class);
Route::get('/artikel', [ArtikelController::class, 'index']);
Route::post('/artikel', [ArtikelController::class, 'store']);
Route::get('/artikel/{artikel:slug}', [ArtikelController::class, 'show']); // ✅ pakai slug
Route::put('/artikel/{artikel:slug}', [ArtikelController::class, 'update']); // ✅ pakai slug
Route::delete('/artikel/{artikel:slug}', [ArtikelController::class, 'destroy']); // ✅ pakai slug