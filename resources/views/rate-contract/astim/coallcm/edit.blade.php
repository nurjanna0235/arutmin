@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Laz Coal Mandiri</li>
                <li class="breadcrumb-item active">Astim</li>
                <li class="breadcrumb-item active">Coal</li>
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
                    <form action="/rate-contract/astim/coal-lcm/update/{{ $dokumencoal_lcm->id }}" method="POST"
                        class="row g-3" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th> <!-- Kosong untuk header kiri -->
                                    <th>Base Rate (ICI 4 >= $60)</th>
                                    <th>Base Rate (ICI 4 < $60)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Coal Getting (Rp/ton)</th>
                                    <td>
                                        <div class="col-12">
                                            <input name="coal_getting_lebih_dari" type="number" class="form-control" 
                                                   value="{{ old('coal_getting_lebih_dari', $dokumencoal_lcm->coal_getting_lebih_dari) }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input name="coal_getting_kurang_dari" type="number" class="form-control"
                                            value="{{ old('coal_getting_kurang_dari', $dokumencoal_lcm->coal_getting_kurang_dari) }}">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Coal Hauling (Rp/ton/KM)</th>
                                    <td>
                                        <div class="col-12">
                                            <input name="coal_hauling_lebih_dari" type="number" class="form-control"
                                            value="{{ old('coal_hauling_lebih_dari', $dokumencoal_lcm->coal_hauling_lebih_dari) }}" >
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input name="coal_hauling_kurang_dari" type="number" class="form-control"
                                            value="{{ old('coal_hauling_kurang_dari', $dokumencoal_lcm->coal_hauling_kurang_dari) }}">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Coal Cleaning (Rp/ton)</th>
                                    <td>
                                        <div class="col-12">
                                            <input name="coal_cleaning_lebih_dari" type="text" class="form-control"
                                            value="{{ old('coal_cleaning_lebih_dari', $dokumencoal_lcm->coal_cleaning_lebih_dari) }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input name="coal_cleaning_kurang_dari" type="text" class="form-control"
                                            value="{{ old('coal_cleaning_kurang_dari', $dokumencoal_lcm->coal_cleaning_kurang_dari) }}">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Pit Support</th>
                                    <td>
                                        <div class="col-12">
                                            <input name="pit_support_lebih_dari" type="text" class="form-control"
                                            value="{{ old('pit_support_lebih_dari', $dokumencoal_lcm->pit_support_lebih_dari) }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input name="pit_support_kurang_dari" type="text" class="form-control"
                                            value="{{ old('pit_support_kurang_dari', $dokumencoal_lcm->pit_support_kurang_dari) }}">
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        
                                <div class="col-12">
                                    <label for="contract_reference" class="form-label">Contract Reference</label>
                                    @if($dokumencoal_lcm->contract_reference)
                                        <div class="mb-2">
                                            <a href="{{ asset('storage/' . $dokumencoal_lcm->contract_reference) }}"
                                                target="_blank">
                                                <img src="{{ asset('storage/' . $dokumencoal_lcm->contract_reference) }}"
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
