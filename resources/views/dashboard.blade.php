@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <!-- Ucapan Selamat Datang -->
    <div class="p-4 mb-4 bg-success text-white rounded-3 shadow-sm">
        <div class="container-fluid py-2">
            <h1 class="display-6 fw-bold">Selamat Datang di NQ Absensi 👋</h1>
            <p class="col-md-8 fs-5 text-gray-300">Sistem Informasi Absensi Santri Pondok Pesantren Nurul Qodim Al- Manshuriyah</p>
            <span class="badge bg-secondary p-2 fs-6">📅 Tanggal Hari Ini: {{ date('d-m-Y', strtotime($hariIni)) }}</span>
        </div>
    </div>

    <!-- Statistik Utama -->
    <div class="row g-3 mb-4">
        <!-- Total Santri -->
        <div class="col-md-4">
            <div class="card bg-success text-white shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-uppercase mb-1 opacity-75">Total Santri</h6>
                        <h2 class="display-5 fw-bold mb-0">{{ $totalSantri }}</h2>
                    </div>
                    <div class="fs-1 opacity-50">👥</div>
                </div>
            </div>
        </div>
        
        <!-- Info Hari Ini -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-light fw-bold text-dark">
                    📊 Ringkasan Kehadiran Hari Ini
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-3 border-end">
                            <h4 class="text-success fw-bold mb-1">{{ $jumlahHadir }}</h4>
                            <span class="badge bg-success-subtle text-success px-2">Hadir</span>
                        </div>
                        <div class="col-3 border-end">
                            <h4 class="text-warning fw-bold mb-1">{{ $jumlahSakit }}</h4>
                            <span class="badge bg-warning-subtle text-warning px-2">Sakit</span>
                        </div>
                        <div class="col-3 border-end">
                            <h4 class="text-primary fw-bold mb-1">{{ $jumlahIzin }}</h4>
                            <span class="badge bg-primary-subtle text-primary px-2">Izin</span>
                        </div>
                        <div class="col-3">
                            <h4 class="text-danger fw-bold mb-1">{{ $jumlahAlfa }}</h4>
                            <span class="badge bg-danger-subtle text-danger px-2">Alfa</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Aktivitas Terbaru -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-secondary text-white fw-bold">
            ⏱️ 5 Input Absensi Terbaru
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Nama Santri</th>
                            <th>Kamar</th>
                            <th>Kegiatan</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kegiatanTerbaru as $kt)
                        <tr>
                            <td class="ps-3 fw-semibold">{{ $kt->santri->nama_santri ?? 'Santri Terhapus' }}</td>
                            <td>{{ $kt->santri->kamar->nama_kamar ?? '-' }}</td>
                            <td>{{ $kt->kegiatan }}</td>
                            <td class="text-center">
                                @if($kt->status == 'Hadir')
                                    <span class="badge bg-success text-white px-3">Hadir</span>
                                @elseif($kt->status == 'Sakit')
                                    <span class="badge bg-warning text-dark px-3">Sakit</span>
                                @elseif($kt->status == 'Izin')
                                    <span class="badge bg-primary text-white px-3">Izin</span>
                                @else
                                    <span class="badge bg-danger text-white px-3">Alfa</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Belum ada aktivitas absensi terbaru hari ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection