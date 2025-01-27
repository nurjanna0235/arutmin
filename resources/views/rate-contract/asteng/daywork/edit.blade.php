@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Darma Henwa</li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Daywork</li>
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
                    <form action="/rate-contract/asteng/daywork/update/{{ $dokumendaywork->id_daywork }}"
                        method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <label for="item" class="form-label">Item</label>
                            <select name="item" class="form-select" id="floatingSelect"
                                aria-label="Floating label select example">
                                <option value="" disabled
                                    {{ $dokumendaywork->id_item == null ? 'selected' : '' }}>
                                    Pilih Item</option>
                                @foreach($item as $option)
                                <option value="{{ $option->id_item }}"
                                    {{ $dokumendaywork->id_item == $option->id_item ? 'selected' : '' }}>
                                    {{ $option->nama_item }}
                                </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-12">
                            <label for="base_rate_exc_fuel" class="form-label">Base Rate Exc. Fuel (Rp/hrs)</label>
                            <input value="{{ $dokumendaywork->base_rate_exc }}" name="base_rate_exc_fuel" type="text"
                                class="form-control" id="base_rate_exc_fuel">
                        </div>

                        <div class="col-12">
                            <label for="fbr" class="form-label">FBR (liter/hrs)</label>
                            <label for="fbr" class="form-label">FBR (liter/hrs)</label>
                            <input value="{{ $dokumendaywork->fbr }}" name="fbr" type="text" class="form-control"
                                id="fbr">
                        </div>

                        <div class="col-12">
                            <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                            <input value="{{ $dokumendaywork-> currency_adjustment }}" name="currency_adjustment"
                                type="text" class="form-control" id="currency_adjustment">
                        </div>

                        <div class="col-12">
                            <label for="premium_rate" class="form-label">Premium Rate</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{ $dokumendaywork-> premium_rate }}"
                                    name="premium_rate">
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>

                            <div class="col-12">
                                <label for="general_escalation" class="form-label">General Escalation</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control"
                                        value="{{ $dokumendaywork-> general_escalation }}"
                                        name="general_escalation">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>

                                <div class="col-12">
                                    <label for="contract_reference" class="form-label">Contract Reference</label>
                                    @if($dokumendaywork->contract_reference)
                                    <div class="mb-2">
                                        <a href="{{ asset('storage/' . $dokumendaywork->contract_reference) }}"
                                            target="_blank">
                                            <img src="{{ asset('storage/' . $dokumendaywork->contract_reference) }}"
                                                alt="Image" style="max-width: 200px;"> 
                                        </a>
                                    </div>

                                    @endif
                                    <input type="file" name="contract_reference" class="form-control"
                                        id="contract_reference">
                                    <small class="text-muted">Upload file baru jika ingin mengganti gambar yang
                                        ada</small>
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