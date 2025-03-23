@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Darma Henwa</li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Fuel Allowance</li>
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
                    <form action="/rate-contract/asteng/fuel/simpan" method="POST" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <label for="activity" class="form-label">Activity</label>
                            <select name="activity" class="form-select" id="activity"
                                aria-label="Floating label select example">
                                <option selected value="">Pilih Activity</option>
                                <option value="OB">OB</option>
                                <option value="Coal">Coal</option>
                                <option value="Top Soil">Top Soil</option>
                                <option value="Mud Pre-mining">Mud Pre-mining</option>
                                <option value="Land Clearing">Land Clearing</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="item" class="form-label">Item</label>
                            <select name="item" class="form-select" id="item"
                                aria-label="Floating label select example">
                                <option selected value="">Pilih Item</option>
                                <option data-activity="OB" value="Overburden @1.2 KM (liter/BCM)">Overburden @1.2 KM
                                    (liter/BCM)</option>
                                <option data-activity="OB" value="Overhaul distance OB (liter/BCM/KM)">Overhaul distance
                                    OB (liter/BCM/KM)</option>
                                <option data-activity="OB" value="Underhaul distance OB (liter/BCM/KM)">Underhaul
                                    distance OB (liter/BCM/KM)</option>

                                <option data-activity="Coal" value="Coal Mine @1.234 KM (liter/ton)">Coal Mine @1.234 KM
                                    (liter/ton)</option>
                                <option data-activity="Coal" value="Overhaul distance Coal Mine (liter/ton/KM)">Overhaul
                                    distance Coal Mine (liter/ton/KM)</option>
                                <option data-activity="Coal" value="Underhaul distance Coal Mine (liter/ton/KM)">
                                    Underhaul distance Coal Mine (liter/ton/KM)</option>

                                <option data-activity="Top Soil" value="Top Soil @1.2 KM (liter/BCM)">Top Soil @1.2 KM
                                    (liter/BCM)</option>
                                <option data-activity="Top Soil" value="Overhaul distance Top Soil (liter/BCM/KM)">
                                    Overhaul distance Top Soil (liter/BCM/KM)</option>
                                <option data-activity="Top Soil" value="Underhaul distance Top Soil (liter/BCM/KM)">
                                    Underhaul distance Top Soil (liter/BCM/KM)</option>

                                <option data-activity="Mud Pre-mining" value="Mud Premining @1.2 KM (liter/BCM)">Mud
                                    Premining @1.2 KM (liter/BCM)</option>
                                <option data-activity="Mud Pre-mining"
                                    value="Overhaul distance Mud Premining (liter/BCM/KM)">Overhaul distance Mud
                                    Premining (liter/BCM/KM)</option>
                                <option data-activity="Mud Pre-mining"
                                    value="Underhaul distance Mud Premining (liter/BCM/KM)">Underhaul distance Mud
                                    Premining (liter/BCM/KM)</option>

                                <option data-activity="Land Clearing" value="Land Clearing (liter/Ha)">Land Clearing
                                    (liter/Ha)</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="fuel_index" class="form-label">Fuel Index</label>
                            <input name="fuel_index" type="text" class="form-control" id="fuel_index">
                        </div>
                        <div class="col-12">
                            <label for="contractual_distance_km" class="form-label">Contractual Distance (KM)</label>
                            <input name="contractual_distance_km" type="text" class="form-control"
                                id="contractual_distance_km">
                        </div>

                        <div class="col-12">
                            <label for="name_contract" class="form-label">Name Contract</label>
                            <input name="name_contract" type="text" class="form-control"
                                id="name_contract">
                        </div>
                        <label for="bulan" class="form-label">Bulan</label>
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" name="bulan">
                        </div>
                        <div class="col-12">
                            <label for="contract_reference" class="form-label">Contract Reference</label>
                            <input name="contract_reference" type="file" class="form-control" id="contract_reference">
                        </div>
                        </select>

                </div>

                <div class="col-12 mt-3">
                    <div class="d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        <a href="/rate-contract/asteng/fuel" class="btn btn-secondary">Batal</a>
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
<script>
    const activitySelect = document.getElementById('activity');
    const itemSelect = document.getElementById('item');

    activitySelect.addEventListener('change', function() {
        const selectedActivity = this.value;

        // Reset Item dropdown
        Array.from(itemSelect.options).forEach(option => {
            if (!option.getAttribute('data-activity') || option.getAttribute('data-activity') === selectedActivity) {
                option.style.display = ''; // Show matching options
            } else {
                option.style.display = 'none'; // Hide non-matching options
            }
        });

        // Reset the selected value of itemSelect
        itemSelect.value = '';
    });
</script>
@endsection