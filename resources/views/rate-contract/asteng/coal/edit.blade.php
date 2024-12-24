@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Rate Contract</h1>
        <nav>
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Coal</li>
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
                    <form action="/rate-contract/asteng/coal/update/{{ $dokumen_coal->id }}" method="POST"
                        class="row g-3" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="col-12">
                            <label for="clean_coal" class="form-label">Clean Coal (Rp/ton)</label>
                            <input value="{{ $dokumen_coal->clean_coal }}" name="clean_coal" type="text"
                                class="form-control" id="clean_coal">
                        </div>

                        <div class="col-12">
                            <label for="loading_and_ripping" class="form-label">Loading and Ripping (Rp/ton)</label>
                            <input value="{{ $dokumen_coal->loading_and_ripping }}" name="loading_and_ripping"
                                type="text" class="form-control" id="loading_and_ripping">
                        </div>

                        <div class="col-12">
                            <label for="coal_hauling" class="form-label">Coal Hauling @8,463 Km (Rp/ton)</label>
                            <input value="{{ $dokumen_coal->coal_hauling }}" name="coal_hauling" type="text"
                                class="form-control" id="coal_hauling">
                        </div>

                        <div class="col-12">
                            <label for="hrm" class="form-label">HRM</label>
                            <input value="{{ $dokumen_coal->hrm }}" name="hrm" type="text" class="form-control"
                                id="hrm">
                        </div>

                        <div class="col-12">
                            <label for="pit_support" class="form-label">Pit Support (Rp/ton)</label>
                            <input value="{{ $dokumen_coal->pit_support }}" name="pit_support" type="text"
                                class="form-control" id="pit_support">
                        </div>

                        <div class="col-12">
                            <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                            <input value="{{ $dokumen_coal->currency_adjustment }}" name="currency_adjustment"
                                type="text" class="form-control" id="currency_adjustment">
                        </div>

                        <div class="col-12">
                            <label for="premium_rate" class="form-label">Premium Rate</label>
                            <div class="input-group mb-3">
                                <input value="{{ $dokumen_coal->premium_rate }}" type="text"
                                        class="form-control" name="premium_rate">
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>

                            <div class="col-12">
                                <label for="general_escalation" class="form-label">General Escalation</label>
                                <div class="input-group mb-3">
                                    <input value="{{ $dokumen_coal->general_escalation }}" type="text"
                                            class="form-control" name="general_escalation">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>

                                <div class="col-12">
                                    <label for="contract_reference" class="form-label">Contract Reference</label>
                                    @if($dokumen_coal->contract_reference)
                                        <div class="mb-2">
                                            <a href="{{ asset('storage/' . $dokumen_coal->contract_reference) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $dokumen_coal->contract_reference) }}"
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
