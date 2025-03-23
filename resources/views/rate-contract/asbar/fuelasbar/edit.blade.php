@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asbar</li>
                <li class="breadcrumb-item active">Fuel Allowance</li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Vertical Form -->
                    <form action="/rate-contract/asbar/fuel-asbar/update/{{ $dokumenfuelasbar->id }}" method="POST"
                        class="row g-3" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <label for="activity" class="form-label">Activity</label>
                            <input value="{{ $dokumenfuelasbar->activity }}" name="activity" type="text"
                                class="form-control" id="activity">
                        </div>

                        <div class="col-12">
                            <label for="item" class="form-label">Item</label>
                            <select name="item" class="form-select" id="item" aria-label="Floating label select example">
                                <option value="" disabled {{ $dokumenfuelasbar->item == null ? 'selected' : '' }}>
                                    Pilih Item
                                </option>
                                <option value="Coal CPP - PLTU (liter/ton)"
                                    {{ $dokumenfuelasbar->item == 'Coal CPP - PLTU (liter/ton)' ? 'selected' : '' }}>
                                    Coal CPP - PLTU (liter/ton)
                                </option>
                                <option value="Over/under distance Coal CPP - PLTU (liter/ton/KM)"
                                    {{ $dokumenfuelasbar->item == 'Over/under distance Coal CPP - PLTU (liter/ton/KM)' ? 'selected' : '' }}>
                                    Over/under distance Coal CPP - PLTU (liter/ton/KM)
                                </option>
                                <option value="Distance Actual PLTU Unit 1-4 (KM)"
                                    {{ $dokumenfuelasbar->item == 'Distance Actual PLTU Unit 1-4 (KM)' ? 'selected' : '' }}>
                                    Distance Actual PLTU Unit 1-4 (KM)
                                </option>
                                <option value="Distance Actual PLTU Unit 5-6 (KM)"
                                    {{ $dokumenfuelasbar->item == 'Distance Actual PLTU Unit 5-6 (KM)' ? 'selected' : '' }}>
                                    Distance Actual PLTU Unit 5-6 (KM)
                                </option>
                                <option value="Contractual Distance (KM)"
                                    {{ $dokumenfuelasbar->item == 'Contractual Distance (KM)' ? 'selected' : '' }}>
                                    Contractual Distance (KM)
                                </option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="fuel_index" class="form-label">Fuel Index</label>
                            <input value="{{ $dokumenfuelasbar->fuel_index }}" name="fuel_index" type="text"
                                class="form-control" id="fuel_index">
                        </div>

                        <div class="col-12">
                            <label for="distance" class="form-label">Distance</label>
                            <input value="{{ $dokumenfuelasbar->distance }}" name="distance"
                                type="text" class="form-control" id="distance">
                        </div>

                        <div class="col-12">
                            <label for="name_contract" class="form-label">Name Contract</label>
                            <input value="{{ $dokumenfuelasbar->name_contract }}" name="name_contract"
                                type="text" class="form-control" id="name_contract">
                        </div>

                        <!-- Contract Reference -->
                        <div class="col-12">
                            <label for="contract_reference" class="form-label">Contract Reference</label>
                            @if($dokumenfuelasbar->contract_reference)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $dokumenfuelasbar->contract_reference) }}"
                                        target="_blank">
                                        <img src="{{ asset('storage/' . $dokumenfuelasbar->contract_reference) }}"
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