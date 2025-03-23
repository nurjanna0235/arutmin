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
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div>

    <!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Vertical Form -->
                    <form action="/rate-contract/asbar/fuel-asbar/simpan" method="POST" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <label for="activity" class="form-label">Activity</label>
                            
                            <input name="activity" type="text" class="form-control" id="activity" value="Hauling PLTU" readonly>
                        </div>

                        <div class="col-12">
                            <label for="item" class="form-label">Item</label>
                            <select name="item" class="form-select" id="item"
                                aria-label="Floating label select example">
                                <option selected value="">Pilih Item</option>
                                <option value="Coal CPP - PLTU (liter/ton)">Coal CPP - PLTU (liter/ton)</option>
                                <option value="Over/under distance Coal CPP - PLTU (liter/ton/KM)">Over/under distance
                                    Coal CPP - PLTU (liter/ton/KM)</option>
                                <option value="Distance Actual PLTU Unit 1-4 (KM)">Distance Actual PLTU Unit 1-4 (KM)
                                </option>
                                <option value="Distance Actual PLTU Unit 5-6 (KM)">Distance Actual PLTU Unit 5-6 (KM)
                                </option>
                                <option value="Contractual Distance (KM)">Contractual Distance (KM)</option>
                            </select>
                        </div>


                        <div class="col-12">
                            <label for="fuel_index" class="form-label">Fuel Index</label>
                            <input name="fuel_index" type="text" class="form-control" id="fuel_index">
                        </div>

                        <div class="col-12">
                            <label for="distance" class="form-label">Distance</label>
                            <input name="distance" type="text" class="form-control" id="distance">
                        </div>

                         <div class="col-12">
                            <label for="name_contract" class="form-label">Name Contract</label>
                            <input name="name_contract" type="text" class="form-control" id="name_contract">
                        </div>

                        <label for="bulan" class="form-label">Bulan</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" name="bulan">
                                </div>
                                
                        <div class="col-12">
                            <label for="contract_reference" class="form-label">Contract Reference</label>
                            <input name="contract_reference" type="file" class="form-control" id="contract_reference">
                        </div>
                        </select>
                </div>
            </div>

            <div class="col-12 mt-3">
                <div class="d-flex justify-content-start">
                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                    <a href="/rate-contract/asbar/fuel-asbar" class="btn btn-secondary">Batal</a>
                </div>
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
