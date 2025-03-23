@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Darma Henwa</li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Coal</li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div>

    <!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Vertical Form -->
                    <form action="/rate-contract/asteng/coal/simpan" method="POST" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="clean_coal" class="form-label">Clean Coal (Rp/ton)</label>
                            <input name="clean_coal" type="text" class="form-control" id="clean_coal">
                        </div>

                        <div class="col-12">
                            <label for="loading_and_ripping" class="form-label">Loading and Ripping (Rp/ton)</label>
                            <input name="loading_and_ripping" type="text" class="form-control" id="loading_and_ripping">
                        </div>

                        <div class="col-12">
                            <label for="coal_hauling" class="form-label">Coal Hauling @8,463 Km (Rp/ton)</label>
                            <input name="coal_hauling" type="text" class="form-control" id="coal_hauling">
                        </div>

                        <div class="col-12">
                            <label for="hrm" class="form-label">HRM</label>
                            <input name="hrm" type="text" class="form-control" id="hrm">
                        </div>

                        <div class="col-12">
                            <label for="pit_support" class="form-label">Pit Support (Rp/ton)</label>
                            <input name="pit_support" type="text" class="form-control" id="pit_support">
                        </div>

                        {{-- <div class="col-12">
                            <label for="sub_total_base_rate_coal" class="form-label">Sub Total Base Rate Coal (Rp/ton)</label>
                            <input name="sub_total_base_rate_coal" type="text" class="form-control" id="sub_total_base_rate_coal">
                        </div> --}}

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

                                <label for="bulan" class="form-label">Bulan</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" name="bulan">
                                </div>

                                {{-- <div class="col-12">
                                    <label for="total_rate_coal_actual" class="form-label"> Total Rate Coal Actual (Rp/ton)</label>
                                    <input name="total_rate_coal_actual" type="text" class="form-control" id="total_rate_coal_actual">
                                </div> --}}

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
                                <a href="/rate-contract/asteng/coal" class="btn btn-secondary">Batal</a>
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