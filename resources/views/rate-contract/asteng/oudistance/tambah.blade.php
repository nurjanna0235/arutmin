@extends('componen.template-admin')

@section('conten')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Admin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
                    <li class="breadcrumb-item active">Over/Under Distance</li>
                </ol>
            </nav>

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Vertical Form -->
                        <form action= "/rate-contract/asteng/oudistance/simpan" method="POST" class= "row g-3" enctype="multipart/form-data">
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
                                <label for="base_rate" class="form-label">Base Rate</label>
                                <input name= "base_rate" type="text" class="form-control" id="base_rate">
                            </div>

                            <div class="col-12">
                                <label for="actual_rate" class="form-label">Actual Rate</label>
                                <input name= "actual_rate" type="text" class="form-control" id="actual_rate">
                            </div>

                            <div class="col-12">
                                <label for="contractual_distance_km" class="form-label">Contractual Distance (KM)</label>
                                <input name= "contractual_distance_km" type="text" class="form-control" id="contractual_distance_km">
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

                            <div class="col-12">
                                <label for="contract_reference" class="form-label">Contract Reference</label>
                                <input name= "contract_reference" type="file" class="form-control" id="contract_reference">
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
