@extends('layouts.main')

@section('content')
<style>
    /* CSS RESPONSIF JITU UNTUK MEMBUAT LAYAR FULL DI HP */
    @media (max-width: 767.98px) {
        /* 1. Menjebol pembungkus container utama agar mentok ke pinggir layar HP */
        .container, .container-fluid {
            padding-left: 0 !important;
            padding-right: 0 !important;
            max-width: 100% !important;
        }

        /* 2. Menghilangkan padding card bawaan layouts/main agar isi tabel memenuhi layar */
        .card {
            border: none !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            margin-top: 0 !important;
        }

        .card-body {
            padding: 8px 4px !important; /* Padding tipis saja di HP */
        }

        /* 3. Sembunyikan kolom kamar di HP */
        .kolom-kamar {
            display: none !important;
        }

        /* 4. Memastikan tabel benar-benar memanfaatkan seluruh sisa lebar HP */
        .table-responsive {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            overflow-x: auto;
        }

        .table {
            width: 100% !important;
            margin-bottom: 0 !important;
        }

        /* Ukuran teks radio button disesuaikan agar rapi */
        .form-check-label {
            font-size: 13px !important;
            margin-left: 2px;
        }
    }
</style>

@if(session('sukses'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('sukses') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container mt-2">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold">📝 Input Absensi Kegiatan Santri</h6>
            <span class="badge bg-primary" style="font-size: 11px;">{{ date('d M Y') }}</span>
        </div>
        <div class="card-body">
            <form action="{{ url('/absensi') }}" method="POST">
                @csrf

                <div class="mb-3 row px-2 px-md-0">
                    <label class="col-sm-2 col-form-label fw-bold small">Pilih Kegiatan :</label>
                    <div class="col-sm-4">
                        <select class="form-select form-select-sm" name="kegiatan" required>
                            <option value="">-- Pilih Kegiatan --</option>
                            <option value="Shalat Berjamaah">Shalat Berjamaah</option>
                            <option value="Setoran Hafalan">Setoran Hafalan / Ziyadah</option>
                            <option value="Pengajian Kitab">Pengajian Kitab Kuning</option>
                            <option value="Bersih-bersih">Khadam / Kerja Bakti</option>
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark text-center small">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Nama Santri</th>
                                <th class="kolom-kamar">Kamar</th>
                                <th style="width: 50%">Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            @foreach($santris as $key => $s)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $key + 1 }}</td>
                                <td class="fw-bold" style="white-space: normal; min-width: 120px;">{{ $s->nama_santri }}</td>
                                <td class="text-center kolom-kamar">
                                    <span class="badge bg-success">{{ $s->kamar->nama_kamar }}</span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <div class="form-check m-0">
                                            <input class="form-check-input" type="radio" name="status[{{ $s->id }}]" id="hadir_{{ $s->id }}" value="Hadir" checked>
                                            <label class="form-check-label text-success fw-bold" for="hadir_{{ $s->id }}">Hadir</label>
                                        </div>
                                        <div class="form-check m-0">
                                            <input class="form-check-input" type="radio" name="status[{{ $s->id }}]" id="sakit_{{ $s->id }}" value="Sakit">
                                            <label class="form-check-label text-warning fw-bold" for="sakit_{{ $s->id }}">Sakit</label>
                                        </div>
                                        <div class="form-check m-0">
                                            <input class="form-check-input" type="radio" name="status[{{ $s->id }}]" id="izin_{{ $s->id }}" value="Izin">
                                            <label class="form-check-label text-info fw-bold" for="izin_{{ $s->id }}">Izin</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-end mt-3 px-2 px-md-0">
                    <button type="submit" class="btn btn-success fw-bold px-4 w-100 w-md-auto">💾 Simpan Absensi</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection