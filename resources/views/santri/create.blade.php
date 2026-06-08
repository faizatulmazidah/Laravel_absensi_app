@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">➕ Tambah Data Santri Baru</h5>
        </div>
        <div class="card-body">
            <form action="{{ url('/santri') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">NIS (Nomor Induk Santri)</label>
                    <input type="text" class="form-control" name="nis" placeholder="Contoh: 10003" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_santri" placeholder="Masukkan nama santri" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Jenis Kelamin</label>
                    <select class="form-select" name="jenis_kelamin" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L">Laki-laki (Ikhwan)</option>
                        <option value="P">Perempuan (Akhwat)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Pilih Kamar / Asrama</label>
                    <select class="form-select" name="kamar_id" required>
                        <option value="">-- Pilih Kamar --</option>
                        @foreach($kamars as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kamar }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="text-end mt-4">
                    <a href="{{ url('/santri') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">💾 Simpan Santri</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection