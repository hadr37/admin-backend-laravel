<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenawaranController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\AuthController;
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
Route::get('/artikel/{artikel:slug}', [ArtikelController::class, 'show']);
Route::put('/artikel/{artikel:slug}', [ArtikelController::class, 'update']);
Route::delete('/artikel/{artikel:slug}', [ArtikelController::class, 'destroy']);

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/pesan', [PesanController::class, 'index']);
Route::post('/pesan', [PesanController::class, 'store']);
Route::delete('/pesan/{id}', [PesanController::class, 'destroy']);

Route::post('/penawarans', [PenawaranController::class, 'store']);
Route::get('/penawarans', [PenawaranController::class, 'index']);
Route::delete('/penawarans/{id}', [PenawaranController::class, 'destroy']);