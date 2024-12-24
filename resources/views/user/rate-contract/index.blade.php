@extends('componen.template-user')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Kontraktor</h1>
        <nav>
            <ol class="breadcrumb">
              
                
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-5">
                <div class="row">
                    <a href="/user/rate-contract/asteng">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <h5 class="card-title text-center">Darma Henwa (Asteng)</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
            <div class="col-lg-5">
                <div class="row">
                    <a href="/user/rate-contract/pit-asbar">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <h5 class="card-title">Darma Henwa (Asbar)</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="row">
                    <a href="/user/rate-contract/pit-asbar">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <h5 class="card-title">Laz Coal Mandiri (Astim)</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

        </div>
    </section>

</main>
<!-- End #main -->
@endsection