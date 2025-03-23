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
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Vertical Form -->
                    <form action="/rate-contract/asteng/fuel/update/{{ $dokumenfuel->id }}" method="POST"
                        class="row g-3" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <label for="activity" class="form-label">Activity</label>
                            <select name="activity" class="form-select" id="activity"
                                aria-label="Floating label select example">
                                <option value="" disabled
                                    {{ $dokumenfuel->activity == null ? 'selected' : '' }}>
                                    Pilih Activity
                                </option>
                                <option value="OB"
                                    {{ $dokumenfuel->activity == 'OB' ? 'selected' : '' }}>
                                    OB</option>
                                <option value="Coal"
                                    {{ $dokumenfuel->activity == 'Coal' ? 'selected' : '' }}>
                                    Coal</option>
                                <option value="Top Soil"
                                    {{ $dokumenfuel->activity == 'Top Soil' ? 'selected' : '' }}>
                                    Top Soil</option>
                                <option value="Mud Pre-mining"
                                    {{ $dokumenfuel->activity == 'Mud Pre-mining' ? 'selected' : '' }}>
                                    Mud Pre-mining</option>
                                <option value="Land Clearing"
                                    {{ $dokumenfuel->activity == 'Land Clearing' ? 'selected' : '' }}>
                                    Land Clearing</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="item" class="form-label">Item</label>
                            <select name="item" class="form-select" id="item"
                                aria-label="Floating label select example">
                                <option value="" disabled
                                    {{ $dokumenfuel->item == null ? 'selected' : '' }}>
                                    Pilih Item
                                </option>
                                <!-- OB Items -->
                                <option data-activity="OB" value="Overburden @1.2 KM (liter/BCM)"
                                    {{ $dokumenfuel->item == 'Overburden @1.2 KM (liter/BCM)' ? 'selected' : '' }}>
                                    Overburden @1.2 KM (liter/BCM)
                                </option>
                                <option data-activity="OB" value="Overhaul distance OB (liter/BCM/KM)"
                                    {{ $dokumenfuel->item == 'Overhaul distance OB (liter/BCM/KM)' ? 'selected' : '' }}>
                                    Overhaul distance OB (liter/BCM/KM)
                                </option>
                                <option data-activity="OB" value="Underhaul distance OB (liter/BCM/KM)"
                                    {{ $dokumenfuel->item == 'Underhaul distance OB (liter/BCM/KM)' ? 'selected' : '' }}>
                                    Underhaul distance OB (liter/BCM/KM)
                                </option>
                                <!-- Coal Items -->
                                <option data-activity="Coal" value="Coal Mine @1.234 KM (liter/ton)"
                                    {{ $dokumenfuel->item == 'Coal Mine @1.234 KM (liter/ton)' ? 'selected' : '' }}>
                                    Coal Mine @1.234 KM (liter/ton)
                                </option>
                                <option data-activity="Coal" value="Overhaul distance Coal Mine (liter/ton/KM)"
                                    {{ $dokumenfuel->item == 'Overhaul distance Coal Mine (liter/ton/KM)' ? 'selected' : '' }}>
                                    Overhaul distance Coal Mine (liter/ton/KM)
                                </option>
                                <option data-activity="Coal" value="Underhaul distance Coal Mine (liter/ton/KM)"
                                    {{ $dokumenfuel->item == 'Underhaul distance Coal Mine (liter/ton/KM)' ? 'selected' : '' }}>
                                    Underhaul distance Coal Mine (liter/ton/KM)
                                </option>
                                <!-- Top Soil Items -->
                                <option data-activity="Top Soil" value="Top Soil @1.2 KM (liter/BCM)"
                                    {{ $dokumenfuel->item == 'Top Soil @1.2 KM (liter/BCM)' ? 'selected' : '' }}>
                                    Top Soil @1.2 KM (liter/BCM)
                                </option>
                                <option data-activity="Top Soil" value="Overhaul distance Top Soil (liter/BCM/KM)"
                                    {{ $dokumenfuel->item == 'Overhaul distance Top Soil (liter/BCM/KM)' ? 'selected' : '' }}>
                                    Overhaul distance Top Soil (liter/BCM/KM)
                                </option>
                                <option data-activity="Top Soil" value="Underhaul distance Top Soil (liter/BCM/KM)"
                                    {{ $dokumenfuel->item == 'Underhaul distance Top Soil (liter/BCM/KM)' ? 'selected' : '' }}>
                                    Underhaul distance Top Soil (liter/BCM/KM)
                                </option>
                                <!-- Mud Pre-mining Items -->
                                <option data-activity="Mud Pre-mining" value="Mud Premining @1.2 KM (liter/BCM)"
                                    {{ $dokumenfuel->item == 'Mud Premining @1.2 KM (liter/BCM)' ? 'selected' : '' }}>
                                    Mud Premining @1.2 KM (liter/BCM)
                                </option>
                                <option data-activity="Mud Pre-mining"
                                    value="Overhaul distance Mud Premining (liter/BCM/KM)"
                                    {{ $dokumenfuel->item == 'Overhaul distance Mud Premining (liter/BCM/KM)' ? 'selected' : '' }}>
                                    Overhaul distance Mud Premining (liter/BCM/KM)
                                </option>
                                <option data-activity="Mud Pre-mining"
                                    value="Underhaul distance Mud Premining (liter/BCM/KM)"
                                    {{ $dokumenfuel->item == 'Underhaul distance Mud Premining (liter/BCM/KM)' ? 'selected' : '' }}>
                                    Underhaul distance Mud Premining (liter/BCM/KM)
                                </option>
                                <!-- Land Clearing Items -->
                                <option data-activity="Land Clearing" value="Land Clearing (liter/Ha)"
                                    {{ $dokumenfuel->item == 'Land Clearing (liter/Ha)' ? 'selected' : '' }}>
                                    Land Clearing (liter/Ha)
                                </option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="fuel_index" class="form-label">Fuel Index</label>
                            <input value="{{ $dokumenfuel->fuel_index }}" name="fuel_index" type="text"
                                class="form-control" id="fuel_index">
                        </div>

                        <div class="col-12">
                            <label for="contractual_distance_km" class="form-label">Contractual Distance (KM)</label>
                            <input value="{{ $dokumenfuel->contractual_distance_km }}" name="contractual_distance_km"
                                type="text" class="form-control" id="contractual_distance_km">
                        </div>

                        <div class="col-12">
                            <label for="name_contract" class="form-label">Name Contract</label>
                            <input value="{{ $dokumenfuel->name_contract }}" name="name_contract" type="text"
                                class="form-control" id="name_contract">
                        </div>

                        <!-- Contract Reference -->
                        <div class="col-12">
                            <label for="contract_reference" class="form-label">Contract Reference</label>
                            @if($dokumenfuel->contract_reference)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $dokumenfuel->contract_reference) }}"
                                        target="_blank">
                                        <img src="{{ asset('storage/' . $dokumenfuel->contract_reference) }}"
                                            alt="Image" style="max-width: 200px;">
                                    </a>
                                </div>
                            @endif
                            <input type="file" name="contract_reference" class="form-control" id="contract_reference">
                            <small class="text-muted">Upload file baru jika ingin mengganti gambar yang
                                ada</small>
                        </div>

                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
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

    activitySelect.addEventListener('change', function () {
        const selectedActivity = this.value;
        const options = itemSelect.querySelectorAll('option');

        options.forEach(option => {
            if (option.dataset.activity) {
                option.style.display = option.dataset.activity === selectedActivity ? 'block' : 'none';
            }
        });

        // Reset item selection if the current selection does not match the new activity
        if (itemSelect.querySelector(`option[data-activity="${selectedActivity}"]:checked`) === null) {
            itemSelect.value = '';
        }
    });

    // Trigger change event on load to apply the filter based on the selected activity
    document.addEventListener('DOMContentLoaded', function () {
        activitySelect.dispatchEvent(new Event('change'));
    });

</script>
@endsection
