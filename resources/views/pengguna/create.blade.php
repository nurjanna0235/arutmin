@extends('layout')

@section('content')
    <h1>Tambah Pengguna</h1>

    <!-- Menampilkan pesan error jika ada -->
    @if ($errors->any())
        <div>
            <strong>Whoops!</strong> Ada masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form untuk menambah pengguna baru -->
    <form action="{{ route('penggunas.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Nama:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <label for="no_hp">No.HP:</label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}">
        </div>

        <div>
            <label for="alamat">Alamat:</label>
            <textarea name="alamat">{{ old('alamat') }}</textarea>
        </div>

        <div>
            <label for="nik">NIK:</label>
            <input type="text" name="nik" value="{{ old('nik') }}">
        </div>

        <div>
            <label for="level">Level:</label>
            <select name="level" required>
                <option value="admin">Admin</option>
                <option value="operator">Operator</option>
            </select>
        </div>

        <div>
            <button type="submit">Simpan</button>
            <a href="{{ route('users.index') }}">Batal</a>
        </div>
    </form>
@endsection