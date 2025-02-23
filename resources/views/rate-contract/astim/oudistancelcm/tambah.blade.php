@extends('componen.template-admin')

@section('conten')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Rate Contract</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Laz Coal Mandiri</li>
                    <li class="breadcrumb-item active">Astim</li>
                    <li class="breadcrumb-item active">Over/Under Distance</li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </nav>

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Vertical Form -->
                        <form action="/rate-contract/astim/oudistance-lcm/simpan" method="POST" class="row g-3"
                            enctype="multipart/form-data">
                            @csrf
                            <table class="table table-bordered">
                                <thead>
                                    <tr>

                                        <th>Activity</th>
                                        <th>Item</th>
                                        <th>Base Rate (ICI 4 >= $60)</th>
                                        <th>Base Rate (ICI 4 <= $60)</th>
                                        <th>Contractual Distance (KM)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item_oudistance_lcm as $item)
                                        <tr>
                                            <th>
                                                <input type="hidden" name="activity[]" value="{{ $item['activity'] }}">
                                                <small>{{ $item['activity'] }}</small>
                                            </th>
                                            <th>
                                                <input type="hidden" name="item[]" value="{{ $item['item'] }}">
                                                <small>{{ $item['item'] }}</small>
                                            </th>
                                            <td>
                                                <div class="col-12">
                                                    <input name="base_rate_high[]" type="number" class="form-control"
                                                        value="{{ old('base_rate_high[]') }}">
                                                    @error('base_rate_high.*')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-12">
                                                    <input name="base_rate_low[]" type="number" class="form-control"
                                                        value="{{ old('base_rate_low[]') }}">
                                                    @error('base_rate_low.*')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-12">
                                                    <input name="contractual_distance[]" type="number" class="form-control"
                                                        value="{{ old('contractual_distance[]') }}">
                                                    @error('contractual_distance.*')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>


                            <div class="col-12">
                                <label for="contract_reference" class="form-label">Contract Reference</label>
                                <input name="contract_reference" type="file" class="form-control"
                                    id="contract_reference">
                            </div>

                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-start">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    <a href="/rate-contract/astim/oudistance-lcm" class="btn btn-secondary">Batal</a>
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
