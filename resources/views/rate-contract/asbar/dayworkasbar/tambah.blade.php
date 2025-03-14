@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asbar</li>
                <li class="breadcrumb-item active">Daywork</li>
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
                    <form action="/rate-contract/asbar/daywork-asbar/simpan" method="POST" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <label for="item" class="form-label">Item</label>
                            <select name="item" class="form-select" id="floatingSelect"
                                aria-label="Floating label select example">
                                <option value="" disabled>
                                    Pilih Item</option>
                                @foreach($item as $option)
                                <option value="{{ $option->id_item_daywork_asbar }}">
                                    {{ $option->nama_item }}
                                </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-12">
                            <label for="base_rate_exc_fuel" class="form-label">Base Rate Exc. Fuel (Rp/Hrs)</label>
                            <input name="base_rate_exc_fuel" type="text" class="form-control" id="base_rate_exc_fuel">
                        </div>

                        <div class="col-12">
                            <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                            <input value="" name="currency_adjustment"
                                type="text" class="form-control" id="currency_adjustment">
                        </div>

                        <div class="col-12">
                            <label for="index" class="form-label">Index</label>
                            <input value="" name="index"
                                type="text" class="form-control" id="index">
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
                        
                        {{-- <div class="col-12">
                                    <label for="total_rate_coal_actual" class="form-label"> Actual Rate Hauling PLTU @12 KM (Rp/ton)</label>
                                    <input name="total_rate_coal_actual" type="text" class="form-control" id="total_rate_coal_actual">
                                </div> --}}

                        <div class="col-12">
                            <label for="contract_reference" class="form-label">Contract Reference</label>
                            <input name="contract_reference" type="file" class="form-control"
                                id="contract_reference">
                        </div>
                        </select>
                </div>
            </div>

            <div class="col-12 mt-3">
                <div class="d-flex justify-content-start">
                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                    <a href="/rate-contract/asbar/daywork-asbar" class="btn btn-secondary">Batal</a>
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