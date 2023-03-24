<?php

use App\Http\Controllers\AbsensiSiswaController;
use App\Http\Controllers\AbsensiUdController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\AbsensiController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
//log-viewers
Route::get('log-viewers', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['verify' => true]);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('absensi', [AbsensiController::class, 'index']);


Route::prefix('admin')->middleware('auth', 'admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);

    // user
    Route::get('user', [UserController::class, 'index'])->name('indexUser');
    Route::post('user/edit', [UserController::class, 'edit']);
    Route::post('user/update', [UserController::class, 'update']);
    Route::post('user/delete', [UserController::class, 'destroy']);

    // kelas
    Route::get('kelas', [KelasController::class, 'index'])->name('indexKelas');
    Route::post('kelas/store', [KelasController::class, 'store']);
    Route::post('kelas/edit', [KelasController::class, 'edit']);
    Route::post('kelas/update', [KelasController::class, 'update']);
    Route::post('kelas/delete', [KelasController::class, 'destroy']);

    // siswa
    Route::get('siswa', [SiswaController::class, 'index'])->name('index');
    Route::post('siswa/store', [SiswaController::class, 'store']);
    Route::post('siswa/edit', [SiswaController::class, 'edit']);
    Route::post('siswa/update', [SiswaController::class, 'update']);
    Route::post('siswa/delete', [SiswaController::class, 'destroy']);


    // guru
    Route::get('guru', [GuruController::class, 'index'])->name('indexGuru');
    Route::post('guru/store', [GuruController::class, 'store']);
    Route::post('guru/edit', [GuruController::class, 'edit']);
    Route::post('guru/update', [GuruController::class, 'update']);
    Route::post('guru/delete', [GuruController::class, 'destroy']);

    // jadwal
    Route::get('jadwal', [JadwalController::class, 'index'])->name('indexJadwal');
    Route::post('jadwal/store', [JadwalController::class, 'store']);
    Route::post('jadwal/edit', [JadwalController::class, 'edit']);
    Route::post('jadwal/update', [JadwalController::class, 'update']);
    Route::post('jadwal/delete', [JadwalController::class, 'destroy']);

    // Info / Pengumuman
    Route::get('info', [InfoController::class, 'index'])->name('indexInfo');
    Route::post('info/store', [InfoController::class, 'store']);
    Route::post('info/edit', [InfoController::class, 'edit']);
    Route::post('info/update', [InfoController::class, 'update']);
    Route::post('info/delete', [InfoController::class, 'destroy']);

    // absensi Usia Dini
    Route::get('usia-dini',[AbsensiUdController::class,'index']);

});
