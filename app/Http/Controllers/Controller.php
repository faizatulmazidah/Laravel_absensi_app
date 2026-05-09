<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi; // Ini penting supaya Controller kenal dengan tabel Absensi

class Controller extends Controller
{
    public function index(Request $request)
    {
        // Mengambil kata kunci dari input 'search'
        $search = $request->query('search');

        // Filter data berdasarkan nama atau kelas
        $absensi = Absensi::where('nama_siswa', 'LIKE', "%{$search}%")
                    ->orWhere('kelas', 'LIKE', "%{$search}%")
                    ->get();

        return view('pages.index', compact('absensi'));
    }
}