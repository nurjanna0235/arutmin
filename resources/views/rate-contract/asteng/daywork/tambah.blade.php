@extends('componen.template-admin')

@section('conten')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Admin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
                    <li class="breadcrumb-item active">Daywork</li>
                </ol>
            </nav>

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Vertical Form -->
                        <form action= "/rate-contract/asteng/daywork/simpan" method="POST" class= "row g-3"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="col-12">
                                <label for="item" class="form-label">Item</label>
                                <select name="item" class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example">
                                    <option selected>Pilih Item</option>
                                    @foreach ($item as $item)
                                        <option value="{{ $item->id_item }}">{{ $item->nama_item }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-12">
                                <label for="base_rate_exc_fuel" class="form-label">Base Rate Exc. Fuel (Rp/hrs)</label>
                                <input name= "base_rate_exc_fuel" type="text" class="form-control"
                                    id="base_rate_exc_fuel">
                            </div>
                            <div class="col-12">
                                <label for="actual_rate_exc_fuel" class="form-label">Actual Rate Exc. Fuel (Rp/Hrs)</label>
                                <input name= "actual_rate_exc_fuel" type="text" class="form-control"
                                    id="actual_rate_exc_fuel">
                            </div>
                            <div class="col-12">
                                <label for="fbr" class="form-label">FBR (liter/hrs)</label>
                                <label for="fbr" class="form-label">FBR (liter/hrs)</label>
                                <input name= "fbr" type="text" class="form-control" id="fbr">
                            </div>
                            <div class="col-12">
                                <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                                <input name= "currency_adjustment" type="text" class="form-control"
                                    id="currency_adjustment">
                            </div>

                            <div class="col-12">
                                <label for="premium_rate" class="form-label">Premium Rate</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="premium_rate">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>

                                <div class="col-12">
                                    <label for="general_escalation" class="form-label">General Escalation</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="general_escalation">
                                        <span class="input-group-text" id="basic-addon2">%</span>
                                    </div>

                                    <div class="col-12">
                                        <label for="contract_reference" class="form-label">Contract Reference</label>
                                        <input name= "contract_reference" type="file" class="form-control"
                                            id="contract_reference">
                                    </div>
                                    </select>

                                </div>

                            </div>
                            <div class="col-12 mt-3">
                                <button type="sumbit" class="btn btn-primary">Simpan</button>
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