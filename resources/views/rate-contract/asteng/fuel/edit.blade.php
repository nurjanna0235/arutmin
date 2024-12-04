@extends('componen.template-admin')

@section('conten')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Admin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
                    <li class="breadcrumb-item active">Fuel Allowance</li>
                </ol>
            </nav>

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Vertical Form -->
                        <form action= "/rate-contract/asteng/fuel/simpan" method="POST" class= "row g-3" enctype="multipart/form-data">
                           @csrf
                        <div class="col-12">
                                <label for="activity" class="form-label">Activity</label>
                                <input name= "activity" type="text" class="form-control" id="activity">
                            </div>

                            <div class="col-12">
                                <label for="item" class="form-label">Item</label>
                                <input name= "item" type="text" class="form-control" id="item">
                            </div>

                            <div class="col-12">
                                <label for="fuel_index" class="form-label">Fuel Index</label>
                                <input name= "fuel_index" type="text" class="form-control" id="fuel_index">
                            </div>

                            <div class="col-12">
                                <label for="contractual_distance_km" class="form-label">Contractual Distance (KM)</label>
                                <input name= "contractual_distance_km" type="file" class="form-control" id="contractual_distance_km">
                            </div>
                            
                            <div class="col-12">
                                <label for="contract_reference" class="form-label">Contract Reference</label>
                                @if ($dokumenfuel->contract_reference)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $dokumenfuel->contract_reference) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $dokumenfuel->contract_reference) }}" alt="Image" style="max-width: 200px;">
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
