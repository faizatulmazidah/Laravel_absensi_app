@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">📝 Edit Data Santri</h5>
        </div>
        <div class="card-body">
            <form action="{{ url('/santri/'.$santri->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Santri</label>
                    <input type="text" class="form-control" name="nama_santri" value="{{ $santri->nama_santri }}" required autocomplete="off">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Pilih Kamar</label>
                    <select class="form-select" name="kamar_id" required>
                        @foreach($kamars as $k)
                            <option value="{{ $k->id }}" {{ $santri->kamar_id == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kamar }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ url('/santri') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">🔄 Perbarui Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection