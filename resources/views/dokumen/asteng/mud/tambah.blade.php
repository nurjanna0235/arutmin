@extends('componen.template-admin')

@section('conten')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Admin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
                    <li class="breadcrumb-item active">Mud</li>
                </ol>
            </nav>

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Vertical Form -->
                        <form action= "/dokumen/asteng/mud/simpan" method="POST" class= "row g-3">
                           @csrf
                        <div class="col-12">
                                <label for="mud_removal_load_and_haul" class="form-label">Mud Removal - Load and Haul (Rp/BCM)</label>
                                <input name= "mud_removal_load_and_haul" type="text" class="form-control" id="mud_removal_load_and_haul">
                            </div>
                            <div class="col-12">
                                <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                                <input name= "currency_adjustment" type="text" class="form-control" id="currency_adjustment">
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

                           {{-- <div class="col-12">
                                <label for="rate_actual" class="form-label">Rate Actual (Rp/Ha)</label>
                                <input name= "rate_actual" type="text" class="form-control" id="rate_actual">
                            </div> --}}
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
