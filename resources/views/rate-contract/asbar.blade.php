@extends('componen.template-admin')

@section('conten')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Jenis kegiatan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
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
                                        <h5 class="card-title">Darma Henwa (Asbar)</h5>
                                        <div class="container text-center">
                                            <!-- Default List group -->
                                            <ul class="list-group">
                                                <a href="/rate-contract/asbar/coal-hauling">
                                                    <li class="list-group-item active">Coal Hauling to PLTU</li>
                                                </a>
                                                <a href="/rate-contract/asbar/haul-road-maintenance-pltu">
                                                <li class="list-group-item ">Haul Road Maintenance PLTU</li>
                                            </a>
                                            <a href="/rate-contract/asbar/daywork-asbar">
                                                <li class="list-group-item active">Daywork</li>
                                            </a>
                                                <a href="/rate-contract/asbar/fuel-asbar">
                                                <li class="list-group-item ">Fuel Allowance</li>
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