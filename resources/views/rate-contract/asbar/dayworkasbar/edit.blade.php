@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Rate Contract</h1>
        <nav>
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asbar</li>
                <li class="breadcrumb-item active">Daywork </li>
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
                    <form action="/rate-contract/asbar/daywork-asbar/update/{{ $dokumendaywork_asbar->id_daywork_asbar }}" method="POST"
                        class="row g-3" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="col-12">
                            <label for="item" class="form-label">Item</label>
                            <select name="item" class="form-select" id="floatingSelect"
                                aria-label="Floating label select example">
                                <option value="{{ $dokumendaywork_asbar->id_item_daywork_asbar }}" selected>
                                    {{$dokumendaywork_asbar->nama_item}}</option>
                                @foreach($item as $option)
                                <option value="{{ $option->id_item_daywork_asbar }}">
                                    {{ $option->nama_item }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="base_rate_exc_fuel" class="form-label">Base Rate Exc. Fuel (Rp/Hrs)</label>
                            <input value="{{ $dokumendaywork_asbar->base_rate_exc_fuel }}" name="base_rate_exc_fuel" type="text"
                                class="form-control" id="base_rate_exc_fuel">
                        </div>

                        <div class="col-12">
                            <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                            <input value="{{ $dokumendaywork_asbar->currency_adjustment }}" name="currency_adjustment"
                                type="text" class="form-control" id="currency_adjustment">
                        </div>

                        <div class="col-12">
                            <label for="index" class="form-label">Index</label>
                            <input value="{{ $dokumendaywork_asbar->index }}" name="index"
                                type="text" class="form-control" id="index">
                        </div>

                        <div class="col-12">
                            <label for="premium_rate" class="form-label">Premium Rate</label>
                            <input value="{{ $dokumendaywork_asbar->premium_rate }}" name="premium_rate" type="text"
                                class="form-control" id="premium_rate">
                        </div>

                        <div class="col-12">
                                <label for="general_escalation" class="form-label">General Escalation</label>
                                <input value="{{ $dokumendaywork_asbar->general_escalation }}" name="general_escalation"
                                    type="text" class="form-control" id="general_escalation">
                            </div>

                            <div class="col-12">
                                    <label for="contract_reference" class="form-label">Contract Reference</label>
                                    @if($dokumendaywork_asbar->contract_reference)
                                    <div class="mb-2">
                                        <a href="{{ asset('storage/' . $dokumendaywork_asbar->contract_reference) }}"
                                            target="_blank">
                                            <img src="{{ asset('storage/' . $dokumendaywork_asbar->contract_reference) }}"
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
