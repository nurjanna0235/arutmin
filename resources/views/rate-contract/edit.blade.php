@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Dokumen</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_dokumen">Nama Dokumen:</label>
            <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" value="{{ old('nama_dokumen', $dokumen->nama_dokumen) }}" required>
        </div>

        <div class="form-group">
            <label for="tahun">Tahun:</label>
            <input type="number" class="form-control" id="tahun" name="tahun" value="{{ old('tahun', $dokumen->tahun) }}" required>
        </div>

        <div class="form-group">
            <label for="perusahaan">Nama Perusahaan:</label>
            <input type="text" class="form-control" id="perusahaan" name="perusahaan" value="{{ old('perusahaan', $dokumen->perusahaan) }}" required>
        </div>

        <div class="form-group">
            <label for="file">Upload Dokumen Baru (Opsional):</label>
            <input type="file" class="form-control-file" id="file" name="file">
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti dokumen.</small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('dokumen.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection