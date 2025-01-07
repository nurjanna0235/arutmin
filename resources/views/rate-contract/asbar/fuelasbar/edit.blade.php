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
                    <form action="/rate-contract/asbar/fuel-asbar/update/" method="POST"
                        class="row g-3" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="col-12">
                            <label for="activity" class="form-label">Activity</label>
                            <input value="" name="activity" type="text"
                                class="form-control" id="activity">
                        </div>

                        <div class="col-12">
                            <label for="item" class="form-label">Item</label>
                            <input value="" name="item"
                                type="text" class="form-control" id="item">
                        </div>

                        <div class="col-12">
                            <label for="fuel_index" class="form-label">Fuel Index</label>
                            <input value="" name="fuel_index" type="text"
                                class="form-control" id="fuel_index">
                        </div>

                        <div class="col-12">
                            <label for="item" class="form-label">Item</label>
                            <input value="" name="item"
                                type="text" class="form-control" id="item">
                        </div>

                        <div class="col-12">
                            <label for="distance" class="form-label">Distance</label>
                            <input value="" name="distance"
                                type="text" class="form-control" id="distance">
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
