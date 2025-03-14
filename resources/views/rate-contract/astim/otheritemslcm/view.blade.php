@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Laz Coal Mandiri</li>
                <li class="breadcrumb-item active">Astim</li>
                <li class="breadcrumb-item active">Other Items</li>
            </ol>
        </nav>

    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Vertical Form -->
                    <form action="/rate-contract/astim/other_items_lcm/simpan" method="POST" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                    <th></th> <!-- Kosong untuk header kiri -->
                                    <th>Base Rate (ICI 4 >= $60)</th>
                                    <th>Base Rate (ICI 4 < $60)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Rate Actual HRM LCM (Rp/ton/KM)</th>
                                    <td>
                                        <div class="col-12">
                                            <input value="{{ $dokumenother_items_lcm->rate_actual_hrm_lcm_base_rate_lebih_dari }}"name="rate_actual_hrm_lcm_base_rate_lebih_dari" type="number" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input value="{{ $dokumenother_items_lcm->rate_actual_hrm_lcm_base_rate_kurang_dari }}"name="rate_actual_hrm_lcm_base_rate_kurang_dari" type="number" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>



                        <div class="col-12 mt-3">
                            <div class="d-flex justify-content-start">

                                <a href="/rate-contract/astim/other-items-lcm" class="btn btn-secondary">Kembali</a>
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
