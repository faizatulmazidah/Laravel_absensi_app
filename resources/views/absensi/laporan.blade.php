@extends('layouts.main')

@section('content')
<div class="container mt-4 px-2 px-md-3">
    
    <div class="card shadow-sm mb-3">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">📊 Rekap Laporan Absensi Santri</h5>
        </div>
        <div class="card-body">
            
            <form action="{{ url('/laporan') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-auto">
                    <label class="fw-bold">Filter Kegiatan:</label>
                </div>
                <div class="col-auto">
                    <select class="form-select form-select-sm" name="kegiatan">
                        <option value="">-- Semua Kegiatan --</option>
                        <option value="Shalat Berjamaah" {{ $kegiatanPilihan == 'Shalat Berjamaah' ? 'selected' : '' }}>Shalat Berjamaah</option>
                        <option value="Setoran Hafalan" {{ $kegiatanPilihan == 'Setoran Hafalan' ? 'selected' : '' }}>Setoran Hafalan / Ziyadah</option>
                        <option value="Pengajian Kitab" {{ $kegiatanPilihan == 'Pengajian Kitab' ? 'selected' : '' }}>Pengajian Kitab Kuning</option>
                        <option value="Bersih-bersih" {{ $kegiatanPilihan == 'Bersih-bersih' ? 'selected' : '' }}>Khadam / Kerja Bakti</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-sm btn-primary">🔍 Cari</button>
                    <a href="{{ url('/laporan') }}" class="btn btn-sm btn-secondary">🔄 Reset</a>
                    <button type="button" onclick="window.print()" class="btn btn-sm btn-success ms-md-2">🖨️ Cetak Laporan</button>
                </div>
            </form>

        </div>
    </div>

    <div class="card d-contents d-md-block border-0 border-md-1 bg-transparent bg-md-white mt-4">
        <div class="card-body p-0 p-md-3">
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-nowrap align-middle m-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Santri</th>
                            <th>Kamar</th>
                            <th>Kegiatan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporans as $key => $l)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($l->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $l->santri->nama_santri }}</td>
                            <td class="text-center"><span class="badge bg-success">{{ $l->santri->kamar->nama_kamar }}</span></td>
                            <td>{{ $l->kegiatan }}</td>
                            <td class="text-center">
                                @if($l->status == 'Hadir')
                                    <span class="badge bg-success">🟢 Hadir</span>
                                @elseif($l->status == 'Sakit')
                                    <span class="badge bg-warning text-dark">🟡 Sakit</span>
                                @else
                                    <span class="badge bg-info text-dark">⚪ Izin</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Data laporan tidak ditemukan atau silakan pilih filter kegiatan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div> </div>
    </div>

</div>
@endsection