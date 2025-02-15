@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Darma Henwa</li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Over Under Distance</li>
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
                    <form action="/rate-contract/asteng/oudistance/update/{{ $dokumenoudistance->id }}" method="POST"
                        class="row g-3" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <label for="activity" class="form-label">Activity</label>
                            <select name="activity" class="form-select" id="activity"
                                aria-label="Floating label select example">
                                <option value="" disabled
                                    {{ $dokumenoudistance->activity == null ? 'selected' : '' }}>
                                    Pilih Activity</option>
                                <option value="OB"
                                    {{ $dokumenoudistance->activity == 'OB' ? 'selected' : '' }}>
                                    OB</option>
                                <option value="Top Soil"
                                    {{ $dokumenoudistance->activity == 'Top Soil' ? 'selected' : '' }}>
                                    Top Soil</option>
                                <option value="Coal"
                                    {{ $dokumenoudistance->activity == 'Coal' ? 'selected' : '' }}>
                                    Coal</option>
                                <option value="Mud Removal"
                                    {{ $dokumenoudistance->activity == 'Mud Removal' ? 'selected' : '' }}>
                                    Mud Removal</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="item" class="form-label">Item</label>
                            <select name="item" class="form-select" id="item"
                                aria-label="Floating label select example">
                                <option value="" disabled
                                    {{ $dokumenoudistance->item == null ? 'selected' : '' }}>
                                    Pilih Item</option>
                                <option data-activity="OB" value="OB Overhaul Distance (Rp/BCM/KM)"
                                    {{ $dokumenoudistance->item == 'OB Overhaul Distance (Rp/BCM/KM)' ? 'selected' : '' }}>
                                    OB Overhaul Distance (Rp/BCM/KM)
                                </option>
                                <option data-activity="OB" value="TOP Underhaul Distance (Rp/BCM/KM)"
                                    {{ $dokumenoudistance->item == 'TOP Underhaul Distance (Rp/BCM/KM)' ? 'selected' : '' }}>
                                    OB Underhaul Distance (Rp/BCM/KM)
                                </option>
                                <option data-activity="Top Soil" value="Top Soil Overhaul Distance (Rp/BCM/KM)"
                                    {{ $dokumenoudistance->item == 'Top Soil Overhaul Distance (Rp/BCM/KM)' ? 'selected' : '' }}>
                                    Top Soil Overhaul Distance (Rp/BCM/KM)
                                </option>
                                <option data-activity="Top Soil" value="Top Soil Underhaul Distance (Rp/BCM/KM)"
                                    {{ $dokumenoudistance->item == 'Top Soil Underhaul Distance (Rp/BCM/KM)' ? 'selected' : '' }}>
                                    Top Soil Underhaul Distance (Rp/BCM/KM)
                                </option>
                                <option data-activity="Coal" value="Coal Overhaul Distance (Rp/ton/KM)"
                                    {{ $dokumenoudistance->item == 'Coal Overhaul Distance (Rp/ton/KM)' ? 'selected' : '' }}>
                                    Coal Overhaul Distance (Rp/ton/KM)
                                </option>
                                <option data-activity="Coal" value="Coal Underhaul Distance (Rp/ton/KM)"
                                    {{ $dokumenoudistance->item == 'Coal Underhaul Distance (Rp/ton/KM)' ? 'selected' : '' }}>
                                    Coal Underhaul Distance (Rp/ton/KM)
                                </option>
                                <option data-activity="Mud Removal" value="Overhaul Mud Removal (Rp/BCM/KM)"
                                    {{ $dokumenoudistance->item == 'Overhaul Mud Removal (Rp/BCM/KM)' ? 'selected' : '' }}>
                                    Overhaul Mud Removal (Rp/BCM/KM)
                                </option>
                                <option data-activity="Mud Removal" value="Underhaul Mud Removal (Rp/BCM/KM)"
                                    {{ $dokumenoudistance->item == 'Underhaul Mud Removal (Rp/BCM/KM)' ? 'selected' : '' }}>
                                    Underhaul Mud Removal (Rp/BCM/KM)
                                </option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="base_rate" class="form-label">Base Rate</label>
                            <input value="{{ $dokumenoudistance->base_rate }}" name="base_rate" type="text"
                                class="form-control" id="base_rate">
                        </div>

                        <div class="col-12">
                            <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                            <input value="{{ $dokumenoudistance->currency_adjustment }}" name="currency_adjustment"
                                type="text" class="form-control" id="currency_adjustment">
                        </div>

                        <div class="col-12">
                            <label for="premium_rate" class="form-label">Premium Rate</label>
                            <div class="input-group mb-3">
                                <input value="{{ $dokumenoudistance->premium_rate }}" type="text" class="form-control"
                                    name="premium_rate">
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="general_escalation" class="form-label">General Escalation</label>
                            <div class="input-group mb-3">
                                <input value="{{ $dokumenoudistance->general_escalation }}" type="text"
                                    class="form-control" name="general_escalation">
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
   
                        <div class="col-12">
                            <label for="contractual_distance_km" class="form-label">Contractual Distance
                                (KM)</label>
                            <input value="{{ $dokumenoudistance->contractual_distance_km }}"
                                name="contractual_distance_km" type="text" class="form-control"
                                id="contractual_distance_km">
                        </div>

                            <!-- Contract Reference -->
                            <div class="col-12">
                                <label for="contract_reference" class="form-label">Contract Reference</label>
                                @if($dokumenoudistance->contract_reference)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $dokumenoudistance->contract_reference) }}"
                                        target="_blank">
                                        <img src="{{ asset('storage/' . $dokumenoudistance->contract_reference) }}"
                                            alt="Image" style="max-width: 200px;">
                                    </a>
                                </div>
                                @endif
                                <input type="file" name="contract_reference" class="form-control"
                                    id="contract_reference">
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
    document.addEventListener('DOMContentLoaded', function() {
        const activitySelect = document.getElementById('activity');
        const itemSelect = document.getElementById('item');
        const itemOptions = Array.from(itemSelect.options);

        function filterItems() {
            const selectedActivity = activitySelect.value;

            // Tampilkan hanya opsi item yang sesuai dengan activity yang dipilih
            itemOptions.forEach(option => {
                if (option.dataset.activity) {
                    option.style.display = option.dataset.activity === selectedActivity ? '' : 'none';
                }
            });

            // Reset nilai dropdown item jika activity berubah
            itemSelect.value = '';
        }

        // Jalankan filter saat dropdown activity berubah
        activitySelect.addEventListener('change', filterItems);

        // Jalankan filter saat halaman pertama kali dimuat (jika ada nilai yang disimpan)
        filterItems();
    });
</script>

@endsection