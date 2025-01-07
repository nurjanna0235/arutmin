@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Rate Contract</h1>
        <nav>
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asbar</li>
                <li class="breadcrumb-item active">Haul Road Maintenance PLTU</li>
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
                    <form action="/rate-contract/asbar/haul-road-maintenance-pltu/update/" method="POST"
                        class="row g-3" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="col-12">
                            <label for="base_rate_hrm_pltu" class="form-label">Base Rate HRM PLTU (Rp/ton)</label>
                            <input value="" name="base_rate_hrm_pltu" type="text"
                                class="form-control" id="base_rate_hrm_pltu">
                        </div>

                        <div class="col-12">
                            <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                            <input value="" name="currency_adjustment"
                                type="text" class="form-control" id="currency_adjustment">
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

                                <div class="col-12">
                                    <label for="contract_reference" class="form-label">Contract Reference</label>
                                    
                                        <div class="mb-2">
                                            <a href="" target="_blank">
                                                <img src=""
                                                     alt="Image" style="max-width: 200px;">
                                            </a>
                                        </div>

                                    
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
