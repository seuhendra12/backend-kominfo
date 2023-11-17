<?php

use App\Http\Controllers\Api\v1\AgendaController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\GaleriController;
use App\Http\Controllers\Api\v1\HalamanController;
use App\Http\Controllers\Api\v1\KategoriController;
use App\Http\Controllers\Api\v1\KontenController;
use App\Http\Controllers\Api\v1\PermissionController;
use App\Http\Controllers\Api\v1\RoleController;
use App\Http\Controllers\Api\v1\TagController;
use App\Http\Controllers\Api\v1\UnitKerjaController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

// User API
Route::middleware('auth:sanctum')->resource('users', UserController::class);

// Permission API
Route::middleware('auth:sanctum')->resource('permissions', PermissionController::class);

// Role API
Route::middleware('auth:sanctum')->resource('roles', RoleController::class);

// Tag API
Route::middleware('auth:sanctum')->resource('tags', TagController::class);

// Kategori API
Route::middleware('auth:sanctum')->resource('kategoris', KategoriController::class);

// Unit Kerja API
Route::middleware('auth:sanctum')->resource('unitKerjas', UnitKerjaController::class);

// Halaman API
Route::middleware('auth:sanctum')->resource('halamans', HalamanController::class);

// Konten API
Route::middleware('auth:sanctum')->resource('kontens', KontenController::class);

// Galeri API
Route::middleware('auth:sanctum')->resource('galeris', GaleriController::class);

// Agenda Api
Route::middleware('auth:sanctum')->resource('agendas', AgendaController::class);


