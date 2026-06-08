@extends('layouts.main')

@section('content')
<div class="container mt-4 px-2 px-md-3"> <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>🧕 Data Santri Pondok Pesantren</h4>
        <a href="{{ url('/santri/create') }}" class="btn btn-primary">Tambah Santri</a>
    </div>

    <div class="card mb-3 bg-light border-0 shadow-sm">
        <div class="card-body p-3">
            <form action="{{ url('/santri/import') }}" method="POST" enctype="multipart/form-data" class="row g-3 align-items-center">
                @csrf
                <div class="col-12 col-md-auto">
                    <label class="form-label mb-0 fw-bold">📥 Import Santri Massal:</label>
                </div>
                <div class="col-12 col-md-auto">
                    <input type="file" name="file_excel" class="form-control form-control-sm" required>
                </div>
                <div class="col-12 col-md-auto">
                    <button type="submit" class="btn btn-sm btn-success fw-bold">🚀 Proses Unggah</button>
                </div>
                <div class="col-12 text-muted small">
                    *Format Kolom Excel: <b>Kolom A:</b> Nama | <b>Kolom B:</b> L/P | <b>Kolom C:</b> ID Kamar (Angka)
                </div>
            </form>
        </div>
    </div>

    @if(session('sukses'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 border-md-1 d-contents d-md-block bg-transparent bg-md-white">
        <div class="card-body p-0 p-md-3"> <div class="table-responsive">
                <table class="table table-bordered table-striped text-nowrap align-middle m-0">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Santri</th>
                            <th>Jenis Kelamin</th>
                            <th>Kamar / Asrama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($santris as $key => $s)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $s->nis }}</td>
                            <td>{{ $s->nama_santri }}</td>
                            <td class="text-center">{{ $s->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td class="text-center"><span class="badge bg-success">{{ $s->kamar->nama_kamar }}</span></td>
                            <td class="text-center">
                                <a href="{{ url('/santri/'.$s->id.'/edit') }}" class="btn btn-sm btn-warning text-dark fw-bold">📝 Edit</a>
                                
                                <form action="{{ url('/santri/'.$s->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus santri ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger fw-bold">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection