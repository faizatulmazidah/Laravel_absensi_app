<?php
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\SantriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;

// 1. Halaman Depan / Dashboard (Pilih Kelas)
Route::get('/', [AbsensiController::class, 'dashboard']);

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
// Rute untuk melihat daftar santri pondok
Route::get('/santri', [SantriController::class, 'index']);
// Rute untuk halaman absensi santri
Route::get('/absensi', [AbsensiController::class, 'index']);
// Rute untuk memproses penyimpanan data absensi santri
Route::post('/absensi', [AbsensiController::class, 'store']);
// Rute untuk menampilkan halaman form tambah santri
Route::get('/santri/create', [SantriController::class, 'create']);
// Rute untuk memproses penyimpanan data santri baru
Route::post('/santri', [SantriController::class, 'store']);
// Rute untuk melihat rekap absensi santri
Route::get('/laporan', [AbsensiController::class, 'laporan']);
// Rute untuk menampilkan halaman edit santri, memproses update, dan menghapus santri
Route::get('/santri/{id}/edit', [SantriController::class, 'edit']);
Route::put('/santri/{id}', [SantriController::class, 'update']);
Route::delete('/santri/{id}', [SantriController::class, 'destroy']);
Route::post('/santri/import', [SantriController::class, 'import']);