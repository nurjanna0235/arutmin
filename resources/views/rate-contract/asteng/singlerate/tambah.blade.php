@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Darma Henwa</li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Single Rate</li>
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
                    <form action="/rate-contract/asteng/single-rate/simpan"
                        method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <label for="total_base_rate_ob" class="form-label">Total Base Rate OB (Rp/BCM)</label>
                            <input name="total_base_rate_ob" type="text" class="form-control" id="total_base_rate_ob">
                        </div>

                        <div class="col-12">
                            <label for="total_base_rate_coal" class="form-label">Total Base Rate Coal (Rp/ton)</label>
                            <input name="total_base_rate_coal" type="text"
                                class="form-control" id="total_base_rate_coal">
                        </div>

                        <div class="col-12">
                            <label for="sr" class="form-label">SR</label>
                            <input name="sr" type="text" class="form-control" id="sr">
                        </div>

                        <div class="col-12">
                            <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                            <input name="currency_adjustment" type="text" class="form-control" id="currency_adjustment">
                        </div>

                        <div class="col-12">
                            <label for="premium_rate" class="form-label">Premium Rate</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="premium_rate">
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>

                            <div class="col-12">
                                <label for="general_escalation" class="form-label">General Escalation</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="general_escalation">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>

                                <div class="col-12">
                            <label for="name_contract" class="form-label">Name Contract</label>
                            <input name="name_contract" type="text" class="form-control" id="name_contract">
                        </div>


                                {{-- <div class="col-12">
                                <label for="total_single_rate_actual" class="form-label">Total Single Rate Actual (Rp/ton)</label>
                                <input name= "total_single_rate_actual" type="text" class="form-control" id="total_single_rate_actual">
                            </div> --}}

                            <label for="bulan" class="form-label">Bulan</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" name="bulan">
                                </div>

                                <div class="col-12">
                                    <label for="contract_reference" class="form-label">Contract Reference</label>
                                    <input name="contract_reference" type="file" class="form-control"
                                        id="contract_reference">
                                </div>
                                </select>
                            </div>

                        </div>
                        <div class="col-12 mt-3">
                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="/rate-contract/asteng/single-rate" class="btn btn-secondary">Batal</a>
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