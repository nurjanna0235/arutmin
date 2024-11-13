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

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Vertical Form -->
                        <form action= "/admin/pengguna/simpan" method="POST" class= "row g-3">
                           @csrf
                        <div class="col-12">
                                <label for="nama" class="form-label">Nama</label>
                                <input name= "username" type="text" class="form-control" id="nama">
                            </div>
                            <div class="col-12">
                                <label for="nik" class="form-label">NIK</label>
                                <input name= "nik" type="text" class="form-control" id="nik">
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input name= "email" type="email" class="form-control" id="email">
                            </div>
                            <div class="col-12">
                                <label for="password" class="form-label">password</label>
                                <input name= "password" type="text" class="form-control" id="password">
                            </div>

                            <div class="col-12">
                                <label for="no_hp" class="form-label">No Handphone</label>
                                <input name= "no_hp" type="text" class="form-control" id="no_hp">
                            </div>

                            <div class="col-12">
                                <label for="level" class="form-label">Level</label>
                                <select name = "level"class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>

                                </select>

                            </div>

                    </div>
                    <div class="col-12 mt-3">
                        <button type="sumbit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form><!-- Vertical Form -->




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