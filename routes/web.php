<?php

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

// Route::get('/', 'HomeController@index');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::prefix('office')
    ->namespace('Admin')
    ->middleware('auth','admin')
    ->group(function() {
        // Route::get('/', 'DashboardController@index')
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
        ->name('dashboard');

        Route::post('/getMakul', [App\Http\Controllers\Admin\LogBookController::class, 'getMakul'])
        ->name('getMakul');

        Route::post('generate', [App\Http\Controllers\Admin\LogAbsenController::class, 'generate'])
        ->name('QRCode.generate');

        Route::get('/lihat_absen/{id_log}', [App\Http\Controllers\Admin\LogAbsenController::class, 'lihat_absen'])
        ->name('lihat_absen');

        Route::get('/lihat_absen_detail/{id_log}', [App\Http\Controllers\Admin\LogPerkuliahanController::class, 'lihat_absen_detail'])
        ->name('lihat_absen_detail');

        Route::get('/verif_jml_mhs', [App\Http\Controllers\Admin\LogAbsenController::class, 'verif_jml_mhs'])
        ->name('verif_jml_mhs');

        Route::get('/verifikasi_log/{id_log}', [App\Http\Controllers\Admin\DashboardController::class, 'verifikasi_log'])
        ->name('verifikasi_log');

        Route::get('admin-kelas/cetak_kelas/{nim_mahasiswa}', [App\Http\Controllers\Admin\AdminKelasController::class, 'cetak_kelas'])
        ->name('cetak_kelas');

        Route::get('admin-kelas/detail_kelas_log/{id_identity}/{nim_mahasiswa_absen}', [App\Http\Controllers\Admin\AdminKelasController::class, 'detail_kelas_log'])
        ->name('detail_kelas_log');

        Route::get('/cetak-logbook/{id_identity}', [App\Http\Controllers\Admin\LogBookController::class, 'cetak_logbook'])
        ->name('cetak-logbook');

        Route::get('/cetak-rekap-absen/{id_identity}', [App\Http\Controllers\Admin\LogBookController::class, 'cetak_rekap_absen'])
        ->name('cetak-rekap-absen');

        Route::get('/cetak-rekap-krs/{nim_mahasiswa}', [App\Http\Controllers\Admin\AdminKelasController::class, 'cetak_rekap_krs'])
        ->name('cetak-rekap-krs');

        Route::resource('pengguna', '\App\Http\Controllers\Admin\UserController');
        Route::resource('mahasiswa', '\App\Http\Controllers\Admin\MahasiswaController');
        Route::resource('prodi', '\App\Http\Controllers\Admin\ProdiController');
        Route::resource('makul', '\App\Http\Controllers\Admin\MakulController');
        Route::resource('ruang', '\App\Http\Controllers\Admin\RuangController');
        Route::resource('thn-akademik', '\App\Http\Controllers\Admin\ThnAkademikController');
        Route::resource('admin-kelas', '\App\Http\Controllers\Admin\AdminKelasController');
        Route::resource('log-book', '\App\Http\Controllers\Admin\LogBookController');
        Route::resource('log-absen', '\App\Http\Controllers\Admin\LogAbsenController');
        Route::resource('log-perkuliahan', '\App\Http\Controllers\Admin\LogPerkuliahanController');
        Route::resource('kode-kelas', '\App\Http\Controllers\Admin\KodeKelasController');
        Route::resource('dashboard', '\App\Http\Controllers\Admin\DashboardController');
    });

Auth::routes(['verify' => true]);
