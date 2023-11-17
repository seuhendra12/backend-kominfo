<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\HalamanHistoriController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KontenController;
use App\Http\Controllers\KontenHistoriController;
use App\Http\Controllers\UnitKerjaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

// User
Route::middleware(['throttle:10,15'])->group(function () {
    Route::get('/login', [SessionController::class, 'index'])->name('login')->middleware('guest');
    Route::post('/sesi-login', [SessionController::class, 'login'])->middleware('guest');
    Route::post('logout', [SessionController::class,'logout'])->middleware('auth');
});
Route::get('/reload-captcha', [SessionController::class, 'reloadCaptcha']);

// Manajemen Pengguna
Route::resource('data-permission', PermissionController::class)->middleware('auth');
Route::resource('data-role', RoleController::class)->middleware('auth');
Route::resource('data-pengguna', UserController::class)->middleware('auth');

// Manajemen Referensi
Route::resource('tags', TagController::class)->middleware('auth');
Route::resource('kategoris', KategoriController::class)->middleware('auth');
Route::resource('unitKerja', UnitKerjaController::class)->middleware('auth');


// Manajemen Konten
Route::resource('galeri', GaleriController::class)->middleware('auth');
Route::resource('konten', KontenController::class)->middleware('auth');
Route::get('/konten-histori', [KontenHistoriController::class, 'index'])->name('konten-histori.index');
Route::get('/konten-histori/{id}', [KontenHistoriController::class, 'show'])->name('konten-histori.show');
Route::get('/restore/{id}', [KontenHistoriController::class, 'restore'])->name('konten-histori.restore');
Route::resource('agenda', AgendaController::class)->middleware('auth');
Route::resource('halaman', HalamanController::class)->middleware('auth');
Route::get('/halaman-histori', [HalamanHistoriController::class, 'index'])->name('halaman-histori.index');
Route::get('/halaman-histori/{id}', [HalamanHistoriController::class, 'show'])->name('halaman-histori.show');
Route::get('/halaman-restore/{id}', [HalamanHistoriController::class, 'restore'])->name('halaman-histori.restore');