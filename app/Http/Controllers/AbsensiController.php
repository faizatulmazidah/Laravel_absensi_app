<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Santri;
use App\Models\Absensi;
use Illuminate\Routing\Controller as BaseController;

class AbsensiController extends BaseController
{
    // 1. Menampilkan halaman formulir absensi
    public function index()
    {
        $santris = Santri::with('kamar')->get();
        return view('absensi.index', compact('santris'));
    }

    // 2. Menyimpan data absensi yang dikirim dari form web
    public function store(Request $request)
    {
        // Validasi agar pilihan kegiatan wajib diisi
        $request->validate([
            'kegiatan' => 'required'
        ]);

        // Looping untuk menyimpan status absen setiap santri
        foreach ($request->absensi as $santri_id => $status) {
            Absensi::create([
                'santri_id' => $santri_id,
                'tanggal'   => now()->toDateString(), // Mengambil tanggal hari ini secara otomatis
                'kegiatan'  => $request->kegiatan,
                'status'    => $status,
            ]);
        }

        // Kembali ke halaman absensi dengan pesan sukses
        return redirect('/absensi')->with('sukses', 'Alhamdulillah, data absensi berhasil disimpan!');
    }
    // Fungsi untuk menampilkan halaman rekap / laporan absensi santri
    public function laporan(Request $request)
    {
        // Mengambil filter kegiatan jika ada yang dipilih pengurus pondok
        $kegiatanPilihan = $request->get('kegiatan');

        // Mengambil data absensi terupdate, diurutkan dari yang paling baru
        $query = Absensi::with(['santri.kamar'])->orderBy('tanggal', 'desc')->orderBy('created_at', 'desc');

        if ($kegiatanPilihan) {
            $query->where('kegiatan', $kegiatanPilihan);
        }

        $laporans = $query->get();

        return view('absensi.laporan', compact('laporans', 'kegiatanPilihan'));
    }
    // Fungsi untuk halaman Dashboard Utama (Home)
    public function dashboard()
    {
        // 1. Hitung total semua santri
        $totalSantri = \App\Models\Santri::count();

        // 2. Ambil tanggal hari ini (Format: YYYY-MM-DD)
        $hariIni = date('Y-m-d');

        // 3. Hitung ringkasan status absensi khusus HARI INI
        $jumlahHadir = Absensi::where('tanggal', $hariIni)->where('status', 'Hadir')->count();
        $jumlahSakit = Absensi::where('tanggal', $hariIni)->where('status', 'Sakit')->count();
        $jumlahIzin  = Absensi::where('tanggal', $hariIni)->where('status', 'Izin')->count();
        $jumlahAlfa  = Absensi::where('tanggal', $hariIni)->where('status', 'Alfa')->count();

        // 4. Ambil 5 riwayat absensi terbaru yang dimasukkan
        $kegiatanTerbaru = Absensi::with(['santri.kamar'])
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        return view('dashboard', compact(
            'totalSantri', 
            'hariIni', 
            'jumlahHadir', 
            'jumlahSakit', 
            'jumlahIzin', 
            'jumlahAlfa',
            'kegiatanTerbaru'
        ));
    }
}