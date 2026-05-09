@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Edit Data Siswa</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('absensi.update', $siswa->pengenal) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nama Siswa</label>
                    <input type="text" name="nama_siswa" class="form-control" value="{{ $siswa->nama_siswa }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kelas</label>
                    <input type="text" name="kelas" class="form-control" value="{{ $siswa->kelas }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <select name="keterangan" class="form-select" required>
                        <option value="Hadir" {{ $siswa->keterangan == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="Sakit" {{ $siswa->keterangan == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="Izin" {{ $siswa->keterangan == 'Izin' ? 'selected' : '' }}>Izin</option>
                        <option value="Alfa" {{ $siswa->keterangan == 'Alfa' ? 'selected' : '' }}>Alfa</option>
                    </select>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                    <a href="{{ route('absensi.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection