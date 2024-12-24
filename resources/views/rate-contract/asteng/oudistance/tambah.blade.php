@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Admin</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Over Under Distance</li>
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
                    <form action="/rate-contract/asteng/oudistance/simpan" method="POST" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <label for="activity" class="form-label">Activity</label>
                            <select name="activity" class="form-select" id="activity"
                                aria-label="Floating label select example">
                                <option value="" selected>Pilih Activity</option>
                                <option value="OB">OB</option>
                                <option value="Top Soil">Top Soil</option>
                                <option value="Coal">Coal</option>
                                <option value="Mud Removal">Mud Removal</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="item" class="form-label">Item</label>
                            <select name="item" class="form-select" id="item"
                                aria-label="Floating label select example">
                                <option value="" selected>Pilih Item</option>
                                <option data-activity="OB" value="OB Overhaul Distance (Rp/BCM/KM)">OB Overhaul Distance
                                    (Rp/BCM/KM)</option>
                                <option data-activity="OB" value="OB Underhaul Distance (Rp/BCM/KM)">OB Underhaul
                                    Distance (Rp/BCM/KM)</option>
                                <option data-activity="Top Soil" value="Top Soil Overhaul Distance (Rp/BCM/KM)">Top Soil
                                    Overhaul Distance (Rp/BCM/KM)</option>
                                <option data-activity="Top Soil" value="Top Soil Underhaul Distance (Rp/BCM/KM)">Top
                                    Soil Underhaul Distance (Rp/BCM/KM)</option>
                                <option data-activity="Coal" value="Coal Overhaul Distance (Rp/ton/KM)">Coal Overhaul
                                    Distance (Rp/ton/KM)</option>
                                <option data-activity="Coal" value="Coal Underhaul Distance (Rp/ton/KM)">Coal Underhaul
                                    Distance (Rp/ton/KM)</option>
                                <option data-activity="Mud Removal" value="Overhaul Mud Removal (Rp/BCM/KM)">Overhaul
                                    Mud Removal (Rp/BCM/KM)</option>
                                <option data-activity="Mud Removal" value="Underhaul Mud Removal (Rp/BCM/KM)">Underhaul
                                    Mud Removal (Rp/BCM/KM)</option>
                            </select>
                        </div>


                        <div class="col-12">
                            <label for="base_rate" class="form-label">Base Rate</label>
                            <input name="base_rate" type="text" class="form-control" id="base_rate">
                        </div>

                        <div class="col-12">
                            <label for="contractual_distance_km" class="form-label">Contractual Distance (KM)</label>
                            <input name="contractual_distance_km" type="text" class="form-control"
                                id="contractual_distance_km">
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
                                    <input name="contract_reference" type="file" class="form-control"
                                        id="contract_reference">
                                </div>
                                </select>

                            </div>

                        </div>
                        <div class="col-12 mt-3">
                            <button type="sumbit" class="btn btn-primary">Simpan</button>
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
    document.addEventListener('DOMContentLoaded', function () {
        const activitySelect = document.getElementById('activity');
        const itemSelect = document.getElementById('item');
        const itemOptions = Array.from(itemSelect.options);

        activitySelect.addEventListener('change', function () {
            const selectedActivity = activitySelect.value;

            // Reset item dropdown
            itemSelect.value = "";
            itemOptions.forEach(option => {
                if (option.dataset.activity) {
                    // Show/hide options based on selected activity
                    option.style.display = option.dataset.activity === selectedActivity ? '' :
                        'none';
                }
            });
        });
    });

</script>

@endsection
