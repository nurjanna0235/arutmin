@extends('componen.template-user')

@section('conten')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">User</a></li>
                <li class="breadcrumb-item active">Pengguna</li>
            </ol>
        </nav>
        <a href='/admin/pengguna/tambah' type="button" class="btn btn-success mb-3">
            <i class="bi bi-plus-circle"></i> Tambah
        </a>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            
        </div>
    </section>

</main><!-- End #main -->
@endsection
