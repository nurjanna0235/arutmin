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
                        <form action= "/dokumen/asteng/daywork/simpan" method="POST" class= "row g-3">
                           @csrf
                        <div class="col-12">
                                <label for="item" class="form-label">Item</label>
                                <input name= "item" type="text" class="form-control" id="item">
                            </div>
                            <div class="col-12">
                                <label for="base_rate_exc_fuel" class="form-label">Base Rate Exc. Fuel (Rp/hrs)</label>
                                <input name= "base_rate_exc_fuel" type="text" class="form-control" id="base_rate_exc_fuel">
                            </div>
                            <div class="col-12">
                                <label for="actual_rate_exc_fuel" class="form-label">Actual Rate Exc. Fuel (Rp/Hrs)</label>
                                <input name= "actual_rate_exc_fuel" type="text" class="form-control" id="actual_rate_exc_fuel">
                            </div>
                            <div class="col-12">
                                <label for="fbr" class="form-label">FBR (liter/hrs)</label>
                                <label for="fbr" class="form-label">FBR (liter/hrs)</label>
                                <input name= "fbr" type="text" class="form-control" id="fbr">
                            </div>
                            <div class="col-12">
                                <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                                <input name= "currency_adjustment" type="text" class="form-control" id="currency_adjustment">
                            </div>

                            <div class="col-12">
                                <label for="premium_rate" class="form-label">Premium Rate</label>
                                <input name= "premium_rate" type="text" class="form-control" id="premium_rate">
                            </div>

                            <div class="col-12">
                                <label for="general_escalation" class="form-label">General Escalation</label>
                                <input name= "general_escalation" type="text" class="form-control" id="general_escalation">
                            </div>

                            <div class="col-12">
                                <label for="contract_reference" class="form-label">Contract Reference</label>
                                <input name= "contract_reference" type="text" class="form-control" id="contract_reference">
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