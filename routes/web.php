<?php

use App\Models\Pengaduan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AduanController;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\VerifikasiController;

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
    return view('login');
})->middleware('guest');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth:petugas,web,masyarakat');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('login.user');
Route::get('/logout', [LoginController::class, 'logout']);


Route::get('/register', [RegisterController::class, 'index']);
Route::get('/register-admin', [RegisterController::class, 'indexAd']);
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');
Route::post('/daftar', [RegisterController::class, 'create'])->middleware('guest');

// Route::get('/aduan', [AduanController::class, 'index'])->middleware('auth:petugas,web,masyarakat');
Route::get('/setting/{nik}/edit', [DashboardController::class, 'edit'])->middleware('auth:petugas,web,masyarakat');
Route::put('/setting/{nik}', [DashboardController::class, 'update'])->middleware('auth:petugas,web,masyarakat');

Route::get('/setting-admin/{nik}/edit', [DashboardController::class, 'editAdmin'])->middleware('auth:petugas,web,masyarakat');
Route::put('/setting-admin/{nik}', [DashboardController::class, 'updateAdmin'])->middleware('auth:petugas,web,masyarakat');

Route::get('/lihat-tanggapan/{id_pengaduan}/edit', [PengaduanController::class, 'showTang'])->middleware('auth:masyarakat');
Route::resource('/dashboard/aduan', PengaduanController::class)->middleware('auth:web,masyarakat');
Route::resource('/administrator/masyarakat', MasyarakatController::class)->middleware('auth:petugas');
Route::resource('/administrator/petugas', PetugasController::class)->middleware('auth:petugas, admin');


// Verifikasi
Route::get('/verifikasi-nonvalid',[VerifikasiController::class, 'index'])->middleware('auth:petugas')->name('nonvalid');
Route::get('/verifikasi-valid',[VerifikasiController::class, 'indexValid'])->middleware('auth:petugas');
Route::get('/validasi-proses',[VerifikasiController::class, 'indexProses'])->middleware('auth:petugas');
Route::get('/validasi-selesai',[VerifikasiController::class, 'indexSelesai'])->middleware('auth:petugas');
Route::get('/verifikasi-ditolak',[VerifikasiController::class, 'indexDitolak'])->middleware('auth:petugas');
Route::get('/verifikasi/valid',[VerifikasiController::class, 'valid'])->middleware('auth:petugas');
Route::get('/verifikasi/proses',[VerifikasiController::class, 'indexProses'])->middleware('auth:petugas');
Route::get('/verifikasi/tolak/{id_pengaduan}',[VerifikasiController::class, 'tolak'])->middleware('auth:petugas');
Route::get('/validasi/selesai/{id_pengaduan}',[VerifikasiController::class, 'selesai'])->middleware('auth:petugas');
Route::get('/validasi/proses/{id_pengaduan}',[VerifikasiController::class, 'proses'])->middleware('auth:petugas');
Route::get('/validasi/tanggapan/{id_pengaduan}',[TanggapanController::class, 'index', 'title' => 'Tanggapan'])->middleware('auth:petugas');

Route::post('/validasi/tanggapan/{id_pengaduan}',[TanggapanController::class, 'store'])->middleware('auth:petugas');

Route::get('/laporan', [LaporanController::class, 'index'])->middleware('auth:petugas');
Route::get('/laporan/cetak', [LaporanController::class, 'downloadPdf'])->middleware('auth:petugas');