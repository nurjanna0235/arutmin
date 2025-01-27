@extends('componen.template-admin')

@section('conten')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Jenis kegiatan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Laz Coal Mandiri</a></li>
                    <li class="breadcrumb-item active">Jenis Kegiatan</li>
                </ol>
            </nav>
           
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-5">
                    <div class="row">
                        <!-- Card with an image on left -->
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col">
                                    <div class="card-body">
                                        <h5 class="card-title">Laz Coal Mandiri (Astim)</h5>
                                        <div class="container text-center">
                                            <!-- Default List group -->
                                            <ul class="list-group">
                                                <a href="/rate-contract/astim/pit-clearing-lcm">
                                                    <li class="list-group-item active">Pit Clearing</li>
                                                </a>
                                                <a href="/rate-contract/astim/top-soil-lcm">
                                                    <li class="list-group-item active">Top Soil</li>
                                                </a>
                                               
                                            </ul><!-- End Default List group -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Card with an image on left -->
                    <a type="submit" href="/rate-contract" class="btn btn-secondary">Kembali</a>   


                </div><!-- End sidebar recent posts-->

            </div>
            </div><!-- End News & Updates -->

            </div><!-- End Right side columns -->

            </div>
        </section>

    </main>
    <!-- End #main -->
    @endsection