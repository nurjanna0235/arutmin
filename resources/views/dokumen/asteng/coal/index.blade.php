@extends('componen.template-admin')
@section('conten')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dokumen</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                    <li class="breadcrumb-item active">Asteng</li>
                    <li class="breadcrumb-item active">Coal</li>

                </ol>
            </nav>
            
            <a href="/dokumen/asteng/coal/tambah" type="button" class="btn btn-success">Tambah</a>
            <!-- Table with stripped rows -->
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>
                            <b>No</b>
                        </th>
                        <th data-type="date" data-format="YYYY/DD/MM">Tanggal</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                        $No = 1;
                    ?>
                    @foreach($dokumencoal as $item)
                    <tr>

                        <td>{{$No++}}</td>
                        <td>{{$item->created_at}}</td>
                        <td> <a href="{{url('dokumen/asteng/coal/detail/'.$item->id)}} " type="button" class="btn btn-primary">Detail</a>
                            <button type="button" class="btn btn-danger">Hapus</button>

                    </tr>
                    @endforeach
                    <!-- End Table with stripped rows -->

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-5">
                    <div class="row">

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