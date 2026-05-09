<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Kelas {{ $kelas }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .container-custom {
            max-width: 900px;
        }
        @media (max-width: 576px) {
            .btn-group-responsive {
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
            }
            .btn-group-responsive .btn {
                flex: 1 1 calc(50% - 5px);
                border-radius: 6px !important;
                margin: 0 !important;
                padding: 6px 0;
                font-size: 12px;
            }
            .table-responsive-custom th, .table-responsive-custom td {
                padding: 10px 8px !important;
            }
        }
    </style>
</head>
<body class="bg-light">

<div class="container container-custom mt-4 mb-5">
    
    <div class="row mb-3 align-items-center g-2">
        <div class="col-12 col-sm-6 text-center text-sm-start">
            <div class="d-flex align-items-center gap-2 justify-content-center justify-content-sm-start">
                <a href="{{ route('absensi.dashboard') }}" class="btn btn-outline-primary btn-sm" title="Kembali ke Dashboard">
                    <i class="bi text-black bi-house-door-fill"></i>
                </a>
                <h2 class="fw-bold text-primary mb-0 fs-3">Kelas {{ $kelas }}</h2>
                
                <a href="{{ route('siswa.create', ['kelas' => $kelas]) }}" class="btn btn-success btn-sm ms-2" title="Tambah Siswa ke Kelas Ini">
                    <i class="bi bi-plus-lg"></i> <span class="d-none d-sm-inline">Siswa</span>
                </a>
            </div>
            <p class="text-muted small mb-0 mt-1"><i class="bi bi-calendar3"></i> {{ date('d F Y') }}</p>
        </div>
            <p class="text-muted small mb-0 mt-1"><i class="bi bi-calendar3"></i> {{ date('d F Y') }}</p>
        </div>
        <div class="col-12 col-sm-6 text-center text-sm-end">
            <div class="d-inline-flex gap-2">
                <span class="badge bg-success px-3 py-2">H: {{ $daftarSiswa->where('keterangan', 'Hadir')->count() }}</span>
                <span class="badge bg-info text-dark px-3 py-2">I: {{ $daftarSiswa->where('keterangan', 'Izin')->count() }}</span>
                <span class="badge bg-warning text-dark px-3 py-2">S: {{ $daftarSiswa->where('keterangan', 'Sakit')->count() }}</span>
                <span class="badge bg-danger px-3 py-2">A: {{ $daftarSiswa->where('keterangan', 'Alfa')->count() }}</span>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body bg-white rounded-3 py-3">
            <form action="{{ route('absensi.index', $kelas) }}" method="GET" class="row g-2 align-items-center">
                <div class="col-10 col-sm-11">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-transparent border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="keyword" class="form-control border-start-0 ps-0" placeholder="Cari nama siswa di kelas {{ $kelas }}..." value="{{ request('keyword') }}" onchange="this.form.submit()">
                    </div>
                </div>
                <div class="col-2 col-sm-1 text-end">
                    @if(request('keyword'))
                        <a href="{{ route('absensi.index', $kelas) }}" class="btn btn-sm btn-outline-secondary w-100" title="Reset">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow border-0">
        <div class="card-header bg-white py-3">
            <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-people-fill me-2"></i> Daftar Kehadiran (Total: {{ $daftarSiswa->count() }})</h6>
        </div>
        <div class="card-body p-0">
            <form action="{{ route('absensi.store') }}" method="POST">
                @csrf
                <div class="table-responsive-custom">
                    <table class="table table-hover align-middle mb-0" style="font-size: 14px;">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3" style="width: 50%;">Nama Siswa</th>
                                <th class="text-center" style="width: 50%;">Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($daftarSiswa as $siswa)
                            <tr>
                                <td class="ps-3 fw-bold text-dark">{{ $siswa->nama_siswa }}</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-responsive" role="group">
                                        <input type="radio" class="btn-check" name="status[{{ $siswa->pengenal }}]" id="h{{ $siswa->pengenal }}" value="Hadir" {{ $siswa->keterangan == 'Hadir' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-success" for="h{{ $siswa->pengenal }}">Hadir</label>
                                        
                                        <input type="radio" class="btn-check" name="status[{{ $siswa->pengenal }}]" id="i{{ $siswa->pengenal }}" value="Izin" {{ $siswa->keterangan == 'Izin' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-info" for="i{{ $siswa->pengenal }}">Izin</label>
                                        
                                        <input type="radio" class="btn-check" name="status[{{ $siswa->pengenal }}]" id="s{{ $siswa->pengenal }}" value="Sakit" {{ $siswa->keterangan == 'Sakit' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-warning" for="s{{ $siswa->pengenal }}">Sakit</label>
                                        
                                        <input type="radio" class="btn-check" name="status[{{ $siswa->pengenal }}]" id="a{{ $siswa->pengenal }}" value="Alfa" {{ $siswa->keterangan == 'Alfa' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-danger" for="a{{ $siswa->pengenal }}">Alfa</label>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center py-4 text-muted">Tidak ada siswa ditemukan di kelas ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white py-3 text-center d-grid gap-2">
                    <button type="submit" class="btn btn-primary fw-bold shadow-sm">
                        <i class="bi bi-save me-2"></i> Simpan Absensi Hari Ini
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>