<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;

// 1. Halaman Depan / Dashboard (Pilih Kelas)
Route::get('/', [SiswaController::class, 'dashboard'])->name('absensi.dashboard');

// 2. Halaman Tabel Absensi Khusus Kelas yang Dipilih
Route::get('/kelas/{kelas}', [SiswaController::class, 'index'])->name('absensi.index');

// 3. Proses Menyimpan Update Status Absensi Harian (Hadir/Izin/Sakit/Alfa)
Route::post('/simpan', [SiswaController::class, 'store'])->name('absensi.store');

// 4. Menampilkan Halaman Form Tambah Siswa Baru
Route::get('/tambah', [SiswaController::class, 'create'])->name('siswa.create');

// 5. Proses Menyimpan Siswa Baru ke Database
Route::post('/tambah/simpan', [SiswaController::class, 'storeSiswa'])->name('siswa.store');

// 6. Proses Membuat Kelas Baru
Route::post('/tambah-kelas', [SiswaController::class, 'storeKelas'])->name('kelas.store');