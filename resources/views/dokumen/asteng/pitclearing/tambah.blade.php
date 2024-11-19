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
                    <form action="/dokumen/asteng/pit-clearing/simpan" method="POST" class="row g-3" id="pitClearingForm">
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
                            <input type="text" class="form-control" name="premium_rate" id="premium_rate">
                        </div>
                        <div class="col-12">
                            <label for="general_escalation" class="form-label">General Escalation</label>
                            <input type="text" class="form-control" name="general_escalation" id="general_escalation">
                        </div>
                        <div class="col-12">
                            <label for="contract_reference" class="form-label">Contract Reference</label>
                            <input name="contract_reference" type="text" class="form-control" id="contract_reference">
                        </div>

                        <input type="hidden" id="rate_actual" name="rate_actual">

                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form><!-- End Vertical Form -->
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<script>
    // Fungsi untuk menghitung rate_actual
    function calculateRateActual() {
        let baseRate = parseFloat(document.getElementById('base_rate').value.replace('.', '').replace(',', '.'));
        let currencyAdjustment = parseFloat(document.getElementById('currency_adjustment').value.replace('.', '').replace(',', '.'));
        let premiumRate = parseFloat(document.getElementById('premium_rate').value.replace('.', '').replace(',', '.'));
        let generalEscalation = parseFloat(document.getElementById('general_escalation').value.replace('.', '').replace(',', '.'));

        let rateActual = 0;

        if (generalEscalation === 0) {
            rateActual = baseRate * currencyAdjustment * premiumRate;
        } else if (premiumRate === 0) {
            rateActual = baseRate * currencyAdjustment * generalEscalation;
        } else if (currencyAdjustment === 0) {
            rateActual = baseRate * premiumRate * generalEscalation;
        } else if (baseRate === 0) {
            rateActual = currencyAdjustment * premiumRate * generalEscalation;
        } else {
            rateActual = baseRate * currencyAdjustment * premiumRate * generalEscalation;
        }

        // Menyimpan hasil ke input hidden dengan 2 digit desimal
        document.getElementById('rate_actual').value = rateActual.toFixed(2); // Pastikan dua digit setelah koma
    }

    // Menambahkan event listener untuk menghitung setiap kali input berubah
    document.getElementById('pitClearingForm').addEventListener('input', calculateRateActual);

    // Pastikan perhitungan juga dilakukan ketika form disubmit
    document.getElementById('pitClearingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        calculateRateActual();  // Pastikan nilai perhitungan sudah terupdate
        this.submit();  // Lanjutkan submit form
    });
</script>


@endsection
