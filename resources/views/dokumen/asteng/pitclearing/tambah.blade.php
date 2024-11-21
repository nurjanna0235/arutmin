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
                    <form action="/dokumen/asteng/pit-clearing/simpan" method="POST" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label for="base_rate" class="form-label">Base Rate (Rp/Ha)</label>
                            <input name="base_rate" type="text" class="form-control" id="base_rate">
                        </div>
                        <div class="col-12">
                            <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                            <input name="currency_adjustment" type="text" class="form-control" id="currency_adjustment" placeholder="Masukkan nilai desimal, contoh: 1.20" required>
                        </div>
                        <div class="col-12">
                            <label for="premium_rate" class="form-label">Premium Rate</label>
                            <input name="premium_rate" type="text" class="form-control" id="premium_rate" placeholder="Masukkan nilai desimal, contoh: 1.10" required>
                        </div>
                        <div class="col-12">
                            <label for="general_escalation" class="form-label">General Escalation</label>
                            <input name="general_escalation" type="text" class="form-control" id="general_escalation" placeholder="Masukkan nilai desimal, contoh: 1.05" required>
                        </div>
                        <div class="col-12">
                            <label for="contract_reference" class="form-label">Contract Reference</label>
                            <input name="contract_reference" type="text" class="form-control" id="contract_reference" placeholder="Masukkan referensi kontrak" required>
                        </div>
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
