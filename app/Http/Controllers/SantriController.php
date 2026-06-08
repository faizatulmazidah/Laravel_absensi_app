<?php

namespace App\Http\Controllers;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\Request;
use App\Models\Santri;
use App\Models\Kamar;
use Illuminate\Routing\Controller as BaseController;

class SantriController extends BaseController
{
    // 1. Menampilkan semua data santri
    public function index()
    {
        $santris = Santri::with('kamar')->get();
        return view('santri.index', compact('santris'));
    }

    // 2. Menampilkan form tambah santri
    public function create()
    {
        $kamars = Kamar::all();
        return view('santri.create', compact('kamars'));
    }

    // 3. Menyimpan data santri baru
    // 3. Menyimpan data santri baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_santri'   => 'required',
            'nis'           => 'required|unique:santris,nis', // Wajib diisi & tidak boleh dobel di database
            'jenis_kelamin' => 'required',
            'kamar_id'      => 'required',
        ]);

        Santri::updateOrCreate([
            'nama_santri'   => $request->nama_santri,
            'nis'           => $request->nis,          // <--- Menangkap input NIS
            'jenis_kelamin' => $request->jenis_kelamin,  // <--- Menangkap input Jenis Kelamin
            'kamar_id'      => $request->kamar_id,
        ]);

        return redirect('/santri')->with('sukses', 'Data santri berhasil ditambahkan!');
    }
    // 4. Menampilkan halaman formulir edit santri
    public function edit($id)
    {
        $santri = Santri::findOrFail($id);
        $kamars = Kamar::all();
        return view('santri.edit', compact('santri', 'kamars'));
    }

    // 5. Memproses perubahan data santri di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_santri' => 'required',
            'kamar_id'    => 'required',
        ]);

        $santri = Santri::findOrFail($id);
        $santri->update([
            'nama_santri' => $request->nama_santri,
            'kamar_id'    => $request->kamar_id,
        ]);

        return redirect('/santri')->with('sukses', 'Data santri berhasil diperbarui!');
    }

    // 6. Menghapus data santri dari database
    public function destroy($id)
    {
        $santri = Santri::findOrFail($id);
        $santri->delete();

        return redirect('/santri')->with('sukses', 'Data santri berhasil dihapus!');
    }
    // Fungsi untuk membaca dan memasukkan data dari file Excel ke Database
    public function import(Request $request)
    {
        // 1. Validasi pastikan yang diupload benar-benar file excel
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls'
        ]);

        // 2. Ambil file yang diupload
        $file = $request->file('file_excel');

        // 3. Load file excel tersebut menggunakan PhpSpreadsheet
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // 4. Looping / baca data dari Excel
foreach ($rows as $index => $row) {
    if ($index == 0) continue; // Lewati judul kolom

    if (empty($row[0])) continue; // Lewati jika nama kosong

    // Trik paling aman: Jika NIS sudah ada, hiraukan atau update datanya!
    \DB::table('santris')->upsert([
        [
            'nama_santri'   => $row[0],
            'nis'           => $row[1],
            'jenis_kelamin' => $row[2],
            'kamar_id'      => $row[3],
            'created_at'    => now(),
            'updated_at'    => now()
        ]
    ], ['nis'], ['nama_santri', 'jenis_kelamin', 'kamar_id']);
}

return redirect('/santri')->with('sukses', 'Hebat! Semua data santri dari Excel berhasil dimasukkan otomatis!');
    }
}