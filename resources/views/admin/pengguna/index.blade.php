@extends('componen.template-admin')

@section('conten')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Admin</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
                <li class="breadcrumb-item active">Pengguna</li>
            </ol>
        </nav>
        <a href='/admin/pengguna/tambah' type="button" class="btn btn-success mb-3">
            <i class="bi bi-plus-circle"></i> Tambah
        </a>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Default Table -->
                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col" style="width: 5%;">No</th>
                                <th scope="col" style="width: 20%;">Username</th>
                                <th scope="col" style="width: 15%;">NIK</th>
                                <th scope="col" style="width: 25%;">Email</th>
                                <th scope="col" style="width: 10%;">Level</th>
                                <th scope="col" style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $No = 1; ?>
                            @foreach($pengguna as $item)
                                <tr>
                                    <td>{{ $No++ }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->level }}</td>
                                    <td>

                                   <!-- Tombol Edit -->
                                        <a href="{{ url('admin/pengguna/edit/'.$item->id) }}">
                                            <i class="ri-edit-2-line text-warning" title="Edit"></i>
                                        </a>
                                        @if( $item->level != 'admin' )
                                        <form
                                            action="{{ url('admin/pengguna/delete/'.$item->id) }}"
                                            method="POST"
                                            style="display: inline-block;"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border: none; background: none;" >
                                            <i class="ri-delete-bin-line text-danger" title="Hapus"></i>
                                            </button>
                                        </form>
                                        @endif
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection
