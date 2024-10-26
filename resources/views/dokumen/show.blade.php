@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Dokumen</h2>

    <div class="card">
        <div class="card-header">
            <strong>Dokumen: {{ $dokumen->nama_dokumen }}</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nama Dokumen</th>
                    <td>{{ $dokumen->nama_dokumen }}</td>
                </tr>
                <tr>
                    <th>Tahun</th>
                    <td>{{ $dokumen->tahun }}</td>
                </tr>
                <tr>
                    <th>Perusahaan</th>
                    <td>{{ $dokumen->perusahaan }}</td>
                </tr>
                <tr>
                    <th>File</th>
                    <td>
                        @if ($dokumen->file)
                            <a href="{{ asset('storage/' . $dokumen->file) }}" target="_blank">Download Dokumen</a>
                        @else
                            Tidak ada file yang diunggah
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('dokumen.index') }}" class="btn btn-secondary">Kembali ke Daftar Dokumen</a>
        <a href="{{ route('dokumen.edit', $dokumen->id) }}" class="btn btn-primary">Edit Dokumen</a>
    </div>
</div>
@endsection