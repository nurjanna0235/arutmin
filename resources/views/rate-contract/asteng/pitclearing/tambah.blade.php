@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Admin</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
                <li class="breadcrumb-item active">Pit Clearing</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Vertical Form -->
                    <form action="/rate-contract/asteng/pit-clearing/simpan" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="base_rate" class="form-label">Base Rate (Rp/Ha)</label>
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
                            
                        <div class="col-12">
                            <label for="contract_reference" class="form-label">Contract Reference</label>
                            <input name="contract_reference" type="file" class="form-control" id="contract_reference">
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form><!-- Vertical Form -->
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
