@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dokumen</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Top Soil</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Vertical Form -->
                        <form action="/rate-contract/asteng/top-soil/simpan" method="POST" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <label for="base_rate" class="form-label">Base Rate (Rp/Ha)</label>
                                <input readonly value="{{ $dokumentop_soil->base_rate }}" name="base_rate" type="text" class="form-control" id="base_rate">
                            </div>

                            <div class="col-12">
                                <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                                <input readonly value="{{ $dokumentop_soil->currency_adjustment }}"
                                    name="currency_adjustment" type="text" class="form-control" id="currency_adjustment">
                            </div>

                            <div class="col-12">
                                <label for="premium_rate" class="form-label">Premium Rate</label>
                                <input readonly value="{{ $dokumentop_soil->premium_rate }}"
                                name="premium_rate" type="text" class="form-control" id="premium_rate">
                            </div>

                            <div class="col-12">
                                <label for="general_escalation" class="form-label">General Escalation</label>
                                <input readonly value="{{ $dokumentop_soil->general_escalation }}"
                                    name="general_escalation" type="text" class="form-control" id="general_escalation">
                            </div>

                            <div class="col-12">
                                <label for="rate_actual" class="form-label">Rate Actual</label>
                                <input readonly value="{{ $dokumentop_soil->rate_actual }}"
                                 name="rate_actual" type="text" class="form-control" id="rate_actual">
                            </div>

                            <div class="col-12">
                                <label for="contract_reference" class="form-label">Contract Reference</label>
                            </div>
                            
                            <div class="col-12">
                                <a href="{{ asset('storage/' . $dokumentop_soil->contract_reference) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $dokumentop_soil->contract_reference) }}" alt="Image" style="max-width: 200px;">
                                </a>
                            </div>

                            <div class="col-12 mt-3">
                                <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                            </div>
                        </form><!-- Vertical Form -->
                    </div>
                </div>
            </div>
        </section>
    </section>

</main>
<!-- End #main -->
@endsection
