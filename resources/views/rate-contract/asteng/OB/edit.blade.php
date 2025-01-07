@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Darma Henwa</li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">OB</li>
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
                    <form action="/rate-contract/asteng/ob/update/{{ $dokumenob->id }}" method="POST" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <label for="load_and_haul" class="form-label">Load and Haul (Rp/BCM)</label>
                            <input name="load_and_haul" type="text" class="form-control" id="load_and_haul"
                                value="{{ $dokumenob->load_and_haul }}">
                        </div>

                        <div class="col-12">
                            <label for="drill_and_blast" class="form-label">Drill and Blast (if
                                required)(Rp/BCM)</label>
                            <input name="drill_and_blast" type="text" class="form-control" id="drill_and_blast"
                                value="{{ $dokumenob->drill_and_blast }}">
                        </div>

                        <div class="col-12">
                            <label for="pit_support" class="form-label">Pit Support (Rp/BCM)</label>
                            <input name="pit_support" type="text" class="form-control" id="pit_support"
                                value="{{ $dokumenob->pit_support }}">
                        </div>

                        <div class="col-12">
                            <label for="pit_lighting" class="form-label">Pit Lighting (Rp/BCM)</label>
                            <input name="pit_lighting" type="text" class="form-control" id="pit_lighting"
                                value="{{ $dokumenob->pit_lighting }}">
                        </div>

                        <div class="col-12">
                            <label for="hrm" class="form-label">HRM</label>
                            <input name="hrm" type="text" class="form-control" id="hrm" value="{{ $dokumenob->hrm }}">
                        </div>

                        <div class="col-12">
                            <label for="dump_maintenance" class="form-label">Dump Maintenance (Rp/BCM)</label>
                            <input name="dump_maintenance" type="text" class="form-control" id="dump_maintenance"
                                value="{{ $dokumenob->dump_maintenance }}">
                        </div>

                        <div class="col-12">
                            <label for="dewatering_sediment" class="form-label">Dewatering/Sediment (Rp/BCM)</label>
                            <input name="dewatering_sediment" type="text" class="form-control" id="dewatering_sediment"
                                value="{{ $dokumenob->dewatering_sediment }}">
                        </div>

                        <div class="col-12">
                            <label for="sr" class="form-label">SR</label>
                            <input name="sr" type="text" class="form-control" id="sr" value="{{ $dokumenob->sr }}">
                        </div>

                        <div class="col-12">
                            <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                            <input name="currency_adjustment" type="text" class="form-control" id="currency_adjustment"
                                value="{{ $dokumenob->currency_adjustment }}">
                        </div>

                        <div class="col-12">
                            <label for="premium_rate" class="form-label">Premium Rate</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="premium_rate"
                                    value="{{ $dokumenob->premium_rate }}">
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>

                            <div class="col-12">
                                <label for="general_escalation" class="form-label">General Escalation</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="general_escalation"
                                        value="{{ $dokumenob->general_escalation }}">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>

                                <!-- Contract Reference -->
                                <div class="col-12">
                                    <label for="contract_reference" class="form-label">Contract Reference</label>
                                    @if($dokumenob->contract_reference)
                                        <div class="mb-2">
                                            <a href="{{ asset('storage/' . $dokumenob->contract_reference) }}"
                                                target="_blank">
                                                <img src="{{ asset('storage/' . $dokumenob->contract_reference) }}"
                                                    alt="Image" style="max-width: 200px;">
                                            </a>
                                        </div>
                                    @endif
                                    <input type="file" name="contract_reference" class="form-control"
                                        id="contract_reference">
                                    <small class="text-muted">Upload file baru jika ingin mengganti gambar yang
                                        ada</small>
                                </div>

                                <!-- Submit Button -->
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
