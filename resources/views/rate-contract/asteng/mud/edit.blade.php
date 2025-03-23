@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Darma Henwa</li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Mud</li>
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
                    <form action="/rate-contract/asteng/mud/update/{{ $dokumenmud->id }}" method="POST"
                        class="row g-3" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <label for="mud_removal_load_and_haul" class="form-label">Mud Removal - Load and Haul
                                (Rp/BCM)</label>
                            <input value="{{ $dokumenmud->mud_removal_load_and_haul }}"
                                name="mud_removal_load_and_haul" type="text" class="form-control"
                                id="mud_removal_load_and_haul">
                        </div>

                        <div class="col-12">
                            <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                            <input value="{{ $dokumenmud->currency_adjustment }}" name="currency_adjustment"
                                type="text" class="form-control" id="currency_adjustment">
                        </div>

                        <div class="col-12">
                            <label for="premium_rate" class="form-label">Premium Rate</label>
                            <div class="input-group mb-3">
                                <input value="{{ $dokumenmud->premium_rate }}" type="text" class="form-control"
                                    name="premium_rate">
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>

                            <div class="col-12">
                                <label for="general_escalation" class="form-label">General Escalation</label>
                                <div class="input-group mb-3">
                                    <input value="{{ $dokumenmud->general_escalation }}" type="text"
                                        class="form-control" name="general_escalation">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>

                                <div class="col-12">
                            <label for="name_contract" class="form-label">Name Contract</label>
                            <input value="{{ $dokumenmud->name_contract }}" name="name_contract"
                                type="text" class="form-control" id="name_contract">
                        </div>

                                {{-- <div class="col-12">
                                <label for="rate_actual" class="form-label">Rate Actual (Rp/Ha)</label>
                                <input  value="{{ $dokumenmud->rate_actual }}" name= "rate_actual" type="text"
                                class="form-control" id="rate_actual">
                            </div> --}}

                            <div class="col-12">
                                <label for="contract_reference" class="form-label">Contract Reference</label>
                                @if($dokumenmud->contract_reference)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $dokumenmud->contract_reference) }}"
                                        target="_blank">
                                        <img src="{{ asset('storage/' . $dokumenmud->contract_reference) }}"
                                            alt="Image" style="max-width: 200px;">
                                    </a>
                                </div>

                                @endif
                                <input type="file" name="contract_reference" class="form-control" id="contract_reference">
                                <small class="text-muted">Upload file baru jika ingin mengganti gambar yang ada</small>
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
@endsection