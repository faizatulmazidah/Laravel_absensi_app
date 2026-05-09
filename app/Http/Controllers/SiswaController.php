<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Routing\Controller as BaseController;

class SiswaController extends BaseController
{
    // 1. HALAMAN DASHBOARD UTAMA (PILIH KELAS)
    public function dashboard()
    {
        // Mengambil daftar kelas unik beserta jumlah siswa di setiap kelas tersebut
        $daftarKelas = Absensi::select('kelas')
            ->selectRaw('count(*) as total_siswa')
            ->groupBy('kelas')
            ->get();

        return view('pages.dashboard', compact('daftarKelas'));
    }

    // 2. TABEL ABSENSI SISWA (KHUSUS KELAS YANG DIPILIH)
    public function index(Request $request, $kelas)
    {
        $cari = $request->get('keyword');

        // Mengambil siswa khusus kelas yang dipilih lewat parameter URL
        $query = Absensi::where('kelas', $kelas);

        // Jika guru juga mencari nama siswa di kelas tersebut
        if ($cari) {
            $query->where('nama_siswa', 'LIKE', "%$cari%");
        }

        $daftarSiswa = $query->get();

        return view('pages.index', compact('daftarSiswa', 'kelas'));
    }

    // 3. MENYIMPAN ABSENSI HARIAN
    public function store(Request $request)
    {
        $dataAbsen = $request->input('status');

        if ($dataAbsen) {
            foreach ($dataAbsen as $pengenal => $statusTerpilih) {
                Absensi::where('pengenal', $pengenal)->update([
                    'keterangan' => $statusTerpilih
                ]);
            }
            return redirect()->back()->with('success', 'Data absensi berhasil diperbarui!');
        }

        return redirect()->back()->with('error', 'Gagal menyimpan data.');
    }

    // 4. FORM TAMBAH SISWA (Mendukung pengisian kelas otomatis jika diakses dari dalam kelas)
    public function create(Request $request)
    {
        $kelasTerpilih = $request->get('kelas');
        return view('pages.create', compact('kelasTerpilih'));
    }

    // 5. PROSES SIMPAN SISWA BARU
    public function storeSiswa(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:100',
            'kelas' => 'required|string|max:50',
        ]);

        Absensi::create([
            'nama_siswa' => $request->nama_siswa,
            'kelas' => $request->kelas,
            'keterangan' => 'Hadir'
        ]);

        return redirect()->route('absensi.index', $request->kelas)->with('success', 'Siswa baru berhasil ditambahkan!');
    }

    // 6. PROSES MEMBUAT KELAS BARU KOSONG (Menggunakan siswa placeholder sementara)
    public function storeKelas(Request $request)
    {
        $request->validate([
            'kelas_baru' => 'required|string|max:50',
        ]);

        $namaKelas = $request->kelas_baru;

        // Untuk membuat kelas baru muncul di dashboard, kita buat satu siswa contoh dulu
        Absensi::create([
            'nama_siswa' => 'Siswa Contoh (Silakan Hapus/Edit)',
            'kelas' => $namaKelas,
            'keterangan' => 'Hadir'
        ]);

        return redirect()->route('absensi.dashboard')->with('success', 'Kelas ' . $namaKelas . ' berhasil dibuat!');
    }
}