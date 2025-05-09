@extends('componen.template-admin')

@section('conten')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Darma Henwa</li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Top Soil</li>
                <li class="breadcrumb-item active">Edit</li>
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
                        <form action="/rate-contract/asteng/top-soil/update/{{ $dokumentop_soil->id }}" method="POST"
                            class="row g-3" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-12">
                                <label for="base_rate" class="form-label">Base Rate (Rp/Ha)</label>
                                <input value="{{ $dokumentop_soil->base_rate }}" name="base_rate" type="text"
                                    class="form-control" id="base_rate">
                            </div>

                            <div class="col-12">
                                <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                                <input value="{{ $dokumentop_soil->currency_adjustment }}" name="currency_adjustment"
                                    type="text" class="form-control" id="currency_adjustment">
                            </div>

                            <div class="col-12">
                                <label for="premium_rate" class="form-label">Premium Rate</label>
                                <input value="{{ $dokumentop_soil->premium_rate }}" name="premium_rate" type="text"
                                    class="form-control" id="premium_rate">
                            </div>

                            <div class="col-12">
                                <label for="general_escalation" class="form-label">General Escalation</label>
                                <input value="{{ $dokumentop_soil->general_escalation }}" name="general_escalation"
                                    type="text" class="form-control" id="general_escalation">
                            </div>

                            <div class="col-12">
                                <label for="contract_reference" class="form-label">Contract Reference</label>
                                @if($dokumentop_soil->contract_reference)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $dokumentop_soil->contract_reference) }}"
                                        target="_blank">
                                        <img src="{{ asset('storage/' . $dokumentop_soil->contract_reference) }}"
                                            alt="Image" style="max-width: 200px;">
                                    </a>
                                </div>

                                <div class="col-12">
                                <label for="name_contract" class="form-label">Name Contract</label>
                                <input value="{{ $dokumentop_soil->name_contract }}" name="name_contract" type="text"
                                    class="form-control" id="name_contract">
                            </div>
                            
                                @endif
                                <input type="file" name="contract_reference" class="form-control"
                                    id="contract_reference">
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
        </section>
    </section>
</main>
<!-- End #main -->
@endsection