<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 500px;">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0 fw-bold"><i class="bi bi-person-plus-fill me-2"></i> Tambah Siswa Baru</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('siswa.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap Siswa</label>
                    <input type="text" name="nama_siswa" class="form-control" placeholder="Contoh: Budi Santoso" required autocomplete="off">
                </div>
                
                <div class="mb-4">
                    <label class="form-label fw-semibold">Kelas</label>
                    <input type="text" name="kelas" class="form-control" placeholder="Contoh: XII A atau XII B" value="{{ $kelasTerpilih ?? '' }}" required autocomplete="off">
                    <div class="form-text text-muted">Pastikan nama kelas ditulis dengan benar agar dikelompokkan dengan tepat.</div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('absensi.dashboard') }}" class="btn btn-outline-secondary px-4 fw-semibold">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">
                        <i class="bi bi-check-lg"></i> Simpan Siswa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>