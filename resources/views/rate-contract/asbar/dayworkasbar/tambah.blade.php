@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asbar</li>
                <li class="breadcrumb-item active">Daywork</li>
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
                    <form action="/rate-contract/asbar/daywork-asbar/simpan" method="POST" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <label for="item" class="form-label">Item</label>
                            <select name="item" class="form-select" id="item" aria-label="Floating label select example">
                                <option selected value="">Pilih Item</option>
                                <option value="Excavator 20 Ton / PC200 / ZX200">Excavator 20 Ton / PC200 / ZX200</option>
                                <option value="Excavator 30 Ton / PC300 / Cat 325D / ZX330">Excavator 30 Ton / PC300 / Cat 325D / ZX330</option>
                                <option value="Excavator 40 Ton / PC400 / ZX450">Excavator 40 Ton / PC400 / ZX450</option>
                                <option value="Excavator 50 Ton / DX500">Excavator 50 Ton / DX500</option>
                                <option value="Excavator 50 Ton / DX800">Excavator 50 Ton / DX800</option>
                                <option value="Excavator 120 Ton / EX1200">Excavator 120 Ton / EX1200</option>
                                <option value="Excavator 120 Ton / PC1250">Excavator 120 Ton / PC1250</option>
                                <option value="Excavator 200 Ton / PC2000">Excavator 200 Ton / PC2000</option>
                                <option value="Excavator 250 Ton / EX2500">Excavator 250 Ton / EX2500</option>
                                <option value="Excavator 260 Ton / EX2600">Excavator 260 Ton / EX2600</option>
                                <option value="Front-End Loader (FEL) Cat 992G (min. 250 hrs)">Front-End Loader (FEL) Cat 992G (min. 250 hrs)</option>
                                <option value="Front-End Loader (FEL) Cat 992G (min. 300 hrs)">Front-End Loader (FEL) Cat 992G (min. 300 hrs)</option>
                                <option value="Front-End Loader (FEL) Cat 992G (min. 350 hrs)">Front-End Loader (FEL) Cat 992G (min. 350 hrs)</option>
                                <option value="Loader WA500">Loader WA500</option>
                                <option value="HD785 / 777D">HD785 / 777D</option>
                                <option value="Cat 777A">Cat 777A</option>
                                <option value="HD465 / 773E">HD465 / 773E</option>
                                <option value="Iveco / Hino">Iveco / Hino</option>
                                <option value="Volvo FM440">Volvo FM440</option>
                                <option value="CWB45">CWB45</option>
                                <option value="DT Hino">DT Hino</option>
                                <option value="Dozer D85ESS / D7G">Dozer D85ESS / D7G</option>
                                <option value="Dozer D8 / D155">Dozer D8 / D155</option>
                                <option value="Dozer D375A / D10T (min. 250 hrs)">Dozer D375A / D10T (min. 250 hrs)</option>
                                <option value="Dozer D375A / D10T (min. 300 hrs)">Dozer D375A / D10T (min. 300 hrs)</option>
                                <option value="Dozer D375A / D10T (min. 350 hrs)">Dozer D375A / D10T (min. 350 hrs)</option>
                                <option value="Grader 16H / GD825">Grader 16H / GD825</option>
                                <option value="Grader 14H / GD705">Grader 14H / GD705</option>
                                <option value="Grader 12 H">Grader 12 H</option>
                                <option value="Compactor">Compactor</option>
                                <option value="Water Pump LC100">Water Pump LC100</option>
                                <option value="Water Pump LC200">Water Pump LC200</option>
                                <option value="Water Pump MF420E">Water Pump MF420E</option>
                                <option value="Lightning Plant">Lightning Plant</option>
                                <option value="Water Truck 20KL">Water Truck 20KL</option>
                                <option value="Fuel Truck">Fuel Truck</option>
                                <option value="Crane Truck">Crane Truck</option>
                                <option value="Hydraulik Excavator (HL) 200">Hydraulik Excavator (HL) 200</option>
                                <option value="Crane 55 Ton">Crane 55 Ton</option>
                            </select>
                        </div>


                        <div class="col-12">
                            <label for="base_rate_exc_fuel" class="form-label">Base Rate Exc. Fuel (Rp/Hrs)</label>
                            <input name="base_rate_exc_fuel" type="text" class="form-control" id="base_rate_exc_fuel">
                        </div>

                        <div class="col-12">
                            <label for="labour" class="form-label">Labour</label>
                            <select name="labour" class="form-select" id="labour" aria-label="Floating label select example">
                                <option selected value="">Pilih labour</option>
                                <option value="National Suptent">National Suptent</option>
                                <option value="National Spv">National Spv</option>
                                <option value="Operator">Operator</option>
                                <option value="Labour">Labour</option>
                                <option value="Mechanic">Mechanic</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="rp_hrs" class="form-label">(Rp/Hrs)</label>
                            <input value="" name="rp_hrs" type="text"
                                class="form-control" id="rp_hrs">
                        </div>

                        <div class="col-12">
                            <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                            <input value="" name="currency_adjustment"
                                type="text" class="form-control" id="currency_adjustment">
                        </div>

                        <div class="col-12">
                            <label for="index" class="form-label">Index</label>
                            <input value="" name="index"
                                type="text" class="form-control" id="index">
                        </div>

                        <div class="col-12">
                            <label for="premium_rate" class="form-label">Premium Rate</label>
                            <input value="" name="premium_rate" type="text"
                                class="form-control" id="premium_rate">
                        </div>

                        <div class="col-12">
                            <label for="general_escalation" class="form-label">General Escalation</label>
                            <input value="" name="general_escalation"
                                type="text" class="form-control" id="general_escalation">
                        </div>

                        {{-- <div class="col-12">
                                    <label for="total_rate_coal_actual" class="form-label"> Actual Rate Hauling PLTU @12 KM (Rp/ton)</label>
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
                    <a href="/rate-contract/asbar/daywork-asbar" class="btn btn-secondary">Batal</a>
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