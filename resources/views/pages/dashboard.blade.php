<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard E-Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .card-kelas {
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }
        .card-kelas:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 800px;">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary mb-1"><i class="bi bi-grid-1x2-fill"></i> E-Absensi Siswa</h1>
        <p class="text-muted">Silakan pilih kelas terlebih dahulu untuk mulai melakukan absensi</p>
        <span class="badge bg-secondary px-3 py-2"><i class="bi bi-calendar3"></i> {{ date('d F Y') }}</span>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row g-4 justify-content-center">
        @forelse($daftarKelas as $kelasData)
        <div class="col-12 col-sm-6">
            <div class="card h-100 shadow-sm border-0 card-kelas text-center p-3" onclick="window.location='{{ route('absensi.index', $kelasData->kelas) }}'">
                <div class="card-body">
                    <div class="display-5 text-primary mb-3">
                        <i class="bi bi-door-closed-fill"></i>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">Kelas {{ $kelasData->kelas }}</h3>
                    <p class="text-muted mb-0">{{ $kelasData->total_siswa }} Siswa Terdaftar</p>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    <span class="btn btn-primary btn-sm rounded-pill px-4 fw-bold">Masuk Kelas <i class="bi bi-arrow-right"></i></span>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="display-1 text-muted mb-3"><i class="bi bi-journal-x"></i></div>
            <p class="text-muted fw-bold">Belum ada data siswa & kelas di database.</p>
        </div>
        @endforelse
    </div>

    <div class="text-center mt-5 d-flex justify-content-center gap-3 flex-wrap">
        <button type="button" class="btn btn-primary fw-bold px-4 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahKelas">
            <i class="bi bi-folder-plus"></i> Tambah Kelas Baru
        </button>

        <a href="{{ route('siswa.create') }}" class="btn btn-success fw-bold px-4 py-2 shadow-sm">
            <i class="bi bi-person-plus-fill"></i> Tambah Siswa Baru
        </a>
    </div>
</div>

<div class="modal fade" id="modalTambahKelas" tabindex="-1" aria-labelledby="modalTambahKelasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="modalTambahKelasLabel"><i class="bi bi-folder-plus me-2"></i> Buat Kelas Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Kelas Baru</label>
                        <input type="text" name="kelas_baru" class="form-control" placeholder="Contoh: XII C atau XI A" required autocomplete="off">
                        <div class="form-text text-muted">Kelas yang baru dibuat akan langsung muncul sebagai kartu pilihan di dashboard.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary fw-bold">Buat Kelas</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>