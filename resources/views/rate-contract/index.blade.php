@extends('componen.template-admin')

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


        <div class="container">
    <div class="row justify-content-center">
        <!-- Button 1: Asteng -->
        <div class="col-lg-4">
            <a href="/rate-contract/asteng">
                <div class="card mb-3">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <h5 class="card-title text-center">Darma Henwa (Asteng)</h5>
                    </div>
                </div>
            </a>
        </div>

        <!-- Button 2: Asbar -->
        <div class="col-lg-4">
            <a href="/rate-contract/asbar">
                <div class="card mb-3">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <h5 class="card-title text-center">Darma Henwa (Asbar)</h5>
                    </div>
                </div>
            </a>
        </div>

        <!-- Button 3: Astim -->
        <div class="col-lg-4">
            <a href="/rate-contract/astim">
                <div class="card mb-3">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <h5 class="card-title text-center">Laz Coal Mandiri (Astim)</h5>
                    </div>
                </div>
            </a>
        </div>
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