<?php

use App\Http\Controllers\AbsensiSiswaController;
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
    Route::get('user', [UserController::class, 'index']);
    Route::get('user/{id}', [UserController::class, 'edit']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::get('user/delete/{id}', [UserController::class, 'destroy']);

    // kelas
    Route::get('kelas', [KelasController::class, 'index'])->name('indexKelas');
    Route::post('kelas/store', [KelasController::class, 'store']);
    Route::post('kelas/edit', [KelasController::class, 'edit']);
    Route::post('kelas/update', [KelasController::class, 'update']);
    Route::post('kelas/delete', [KelasController::class, 'destroy']);

    // siswa
    Route::get('siswa', [SiswaController::class, 'index'])->name('index');
    Route::get('siswa/show/{id}', [SiswaController::class, 'show']);
    Route::post('siswa/store', [SiswaController::class, 'store']);
    Route::post('siswa/edit', [SiswaController::class, 'edit']);
    Route::post('siswa/update', [SiswaController::class, 'update']);
    Route::post('siswa/delete', [SiswaController::class, 'destroy']);


    // guru
    Route::get('guru', [GuruController::class, 'index'])->name('indexGuru');
    Route::get('guru/show/{id}', [GuruController::class, 'show']);
    Route::post('guru/store', [GuruController::class, 'store']);
    Route::post('guru/edit', [GuruController::class, 'edit']);
    Route::post('guru/update', [GuruController::class, 'update']);
    Route::post('guru/delete', [GuruController::class, 'destroy']);

    // jadwal
    Route::get('jadwal', [JadwalController::class, 'index']);
    Route::get('jadwal/show/{id}', [JadwalController::class, 'show']);
    Route::get('jadwal/create', [JadwalController::class, 'create']);
    Route::post('jadwal', [JadwalController::class, 'store']);
    Route::get('jadwal/edit/{kelas_id}', [JadwalController::class, 'edit']);
    Route::put('jadwal/{id}', [JadwalController::class, 'update']);
    Route::get('jadwal/delete/{id}', [JadwalController::class, 'destroy']);

    // Info / Pengumuman
    Route::get('info', [InfoController::class, 'index']);
    //  Route::get('guru/show/{id}',[GuruController::class,'show']);
    Route::get('info/create', [InfoController::class, 'create']);
    Route::post('info', [InfoController::class, 'store']);
    Route::get('info/edit/{id}', [InfoController::class, 'edit']);
    Route::put('info/{id}', [InfoController::class, 'update']);
    Route::get('info/delete/{id}', [InfoController::class, 'destroy']);

    // Info / Pengumuman
    Route::get('absensi', [AbsensiSiswaController::class, 'index']);
    //  Route::get('guru/show/{id}',[GuruController::class,'show']);
    Route::get('absensi/create', [AbsensiSiswaController::class, 'create']);
    //  Route::post('info',[InfoController::class,'store']);
    //  Route::get('info/edit/{id}',[InfoController::class,'edit']);
    //  Route::put('info/{id}',[InfoController::class,'update']);
    //  Route::get('info/delete/{id}',[InfoController::class,'destroy']);

});
