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
        <a href='/admin/pengguna/tambah' type="button" class="btn btn-success">Tambah</a>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Default Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Username</th>
                                <th scope="col">NIK</th>
                                <th scope="col">Email</th>
                                <th scope="col">No Handphone</th>
                                <th scope="col">Level</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $No = 1;
                               ?>

                            @foreach($pengguna as $item)
                                <tr>
                                <td>{{$No++}}</td>
                                
                                   
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->no_hp }}</td>
                                    <td>{{ $item->level }}</td>
                                    <td>
                                        <a href="{{ url('admin/pengguna/edit/'.$item->id) }}"
                                            type="button" class="btn btn-primary">Edit</a>
                                        <form
                                            action="{{ url('admin/pengguna/delete/'.$item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->



                </div>
            </div>
        </div>
        </div>
        </div>
        </div><!-- End Card with an image on left -->



        </div><!-- End sidebar recent posts-->

        </div>
        </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

        </div>
    </section>

</main><!-- End #main -->
@endsection
