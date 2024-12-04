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
                        <form action= "/rate-contract/asteng/daywork/simpan" method="POST" class= "row g-3" enctype="multipart/form-data">
                           @csrf
                        <div class="col-12">
                                <label for="item" class="form-label">Item</label>
                                <input value="{{ $dokumendaywork->item }}"  name= "item" type="text" class="form-control" id="item">
                            </div>

                            <div class="col-12">
                                <label for="base_rate_exc_fuel" class="form-label">Base Rate Exc. Fuel (Rp/hrs)</label>
                                <input value="{{ $dokumendaywork->base_rate_exc_fuel }}" name= "base_rate_exc_fuel" type="text" class="form-control" id="base_rate_exc_fuel">
                            </div>

                            <div class="col-12">
                                <label for="actual_rate_exc_fuel" class="form-label">Actual Rate Exc. Fuel (Rp/Hrs)</label>
                                <input value="{{ $dokumendaywork-> }}" name= "actual_rate_exc_fuel" type="text" class="form-control" id="actual_rate_exc_fuel">
                            </div>

                            <div class="col-12">
                                <label for="fbr" class="form-label">FBR (liter/hrs)</label>
                                <label for="fbr" class="form-label">FBR (liter/hrs)</label>
                                <input value="{{ $dokumendaywork->fbr }}"name= "fbr" type="text" class="form-control" id="fbr">
                            </div>

                            <div class="col-12">
                                <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                                <input value="{{ $dokumendaywork-> currency_adjustment}}" name= "currency_adjustment" type="text" class="form-control" id="currency_adjustment">
                            </div>

                            <div class="col-12">
                                <label for="premium_rate" class="form-label">Premium Rate</label>
                                <div class="input-group mb-3">
                                 <input type="text" class="form-control" value="{{ $dokumendaywork-> premium_rate}}" name="premium_rate">
                                <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                                
                            <div class="col-12">
                                <label for="general_escalation" class="form-label">General Escalation</label>
                                <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{ $dokumendaywork-> general_escalation}}" name="general_escalation">
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>

                            <div class="col-12">
                        <label for="contract_reference" class="form-label">Contract Reference</label>
                        @if($dokumen_daywork->contract_reference)
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $dokumen_daywork->contract_reference) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $dokumen_daywork->contract_reference) }}" alt="Image" style="max-width: 200px;">
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
