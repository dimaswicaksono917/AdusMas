<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Admin\DatatableController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardAdminController;

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

Route::get('/', function () {
    return view('landing');
});

Route::get('register', [AuthUserController::class, 'register'])->name('register');
Route::post('register', [AuthUserController::class, 'storeRegister'])->name('store.register');
Route::get('login', [AuthUserController::class, 'login'])->name('login');
Route::post('authenticate', [AuthUserController::class, 'authenticate'])->name('authenticate');
Route::get('logout', [AuthUserController::class, 'logout'])->name('logout');

Route::prefix('masyarakat')->name('masyarakat')->middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::Class, 'index'])->name('.dashboard');
    Route::get('get-pengaduan', [PengaduanController::class, 'getPengaduan'])->name('.get-pengaduan');
    Route::prefix('pengaduan')->name('.pengaduan')->group(function () {
        Route::get('/', [PengaduanController::class, 'index'])->name('.index');
        Route::get('/create', [PengaduanController::class, 'create'])->name('.create');
        Route::post('/store', [PengaduanController::class, 'store'])->name('.store');
    });
});

Route::prefix('webmin')->name('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('.login');
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('.authenticate');
    Route::get('/logout', [LoginController::class, 'logout'])->name('.logout');

    Route::middleware(['auth:petugas'])->group(function () {
        Route::get('dashboard', [DashboardAdminController::class, 'index'])->name('.dashboard');

        Route::get('masyarakat-verif', function(){ return view('admin.masyarakat.verif'); })->name('.masyarakat-verif');
        Route::get('get-verif', [DatatableController::class, 'masyarakatVerif'])->name('.get-verif');
    });
});
