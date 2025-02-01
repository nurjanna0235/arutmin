@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Laz Coal Mandiri</li>
                <li class="breadcrumb-item active">Astim</li>
                <li class="breadcrumb-item active">Top Soil</li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>

    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Vertical Form -->
                    <form action="/rate-contract/astim/top-soil-lcm/simpan" method="POST" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="rate_actual_base_rate_lebih_dari" class="form-label">Base Rate (ICI 4 >=
                                $60)</label>
                            <input name="rate_actual_base_rate_lebih_dari" type="number" class="form-control"
                                id="rate_actual_base_rate_lebih_dari">
                        </div>

                        <div class="col-12">
                            <label for="rate_actual_base_rate_kurang_dari" class="form-label">Base Rate (ICI 4 <
                                    $60)</label>
                                    <input name="rate_actual_base_rate_kurang_dari" type="number" class="form-control"
                                        id="rate_actual_base_rate_kurang_dari">
                        </div>

                        <div class="col-12">
                            <label for="contract_reference" class="form-label">Contract Reference</label>
                            <input name="contract_reference" type="file" class="form-control" id="contract_reference">
                        </div>

                        <div class="col-12 mt-3">
                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="/rate-contract/astim/top-soil-lcm" class="btn btn-secondary">Batal</a>
                            </div>
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
