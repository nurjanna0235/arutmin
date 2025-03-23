@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">
    <div class="pagetitle">
    <h1>Rate Contract</h1>
        <nav>
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asbar</li>
                <li class="breadcrumb-item active">Coal Hauling to PLTU</li>
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
                    <form action="/rate-contract/asbar/coal-hauling/simpan" method="POST" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="base_rate" class="form-label">Base Rate Hauling PLTU @12 KM (Rp/ton)</label>
                            <input name="base_rate" type="text" class="form-control" id="base_rate">
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

                                {{-- <div class="col-12">
                                    <label for="actual_rate" class="form-label"> Actual Rate Hauling PLTU @12 KM (Rp/ton)</label>
                                    <input name="actual_rate" type="text" class="form-control" id="actual_rate">
                                </div> --}}

                                <div class="col-12">
                            <label for="name_contract" class="form-label">Name Contract</label>
                            <input name="name_contract" type="text" class="form-control" id="name_contract">
                        </div>


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
                                <a href="/rate-contract/asbar/coal-hauling" class="btn btn-secondary">Batal</a>
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
