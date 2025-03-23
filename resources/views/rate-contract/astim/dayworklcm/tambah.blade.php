@extends('componen.template-admin')

@section('conten')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Rate Contract</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Laz Coal Mandiri</li>
                    <li class="breadcrumb-item active">Astim</li>
                    <li class="breadcrumb-item active">Daywork</li>
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
                        <form action="/rate-contract/astim/daywork-lcm/simpan" method="POST" class="row g-3"
                            enctype="multipart/form-data">
                            @csrf
                            <table class="table table-bordered">
                                <thead>
                                    <tr>

                                        <th>Item</th>
                                        <th>Model</th>
                                        <th>Actual Rate Exc. Fuel (Rp/Hrs)</th>
                                        <th>FBR (liter/hrs)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item_daywork_lcm as $item)
                                        <tr>
                                            <th>
                                                <input type="hidden" name="item[]" value="{{ $item['item'] }}">
                                                <small>{{ $item['item'] }}</small>
                                            </th>
                                            <th>
                                                <input type="hidden" name="model[]" value="{{ $item['model'] }}">
                                                <small>{{ $item['model'] }}</small>
                                            </th>
                                            <td>
                                                <div class="col-12">
                                                    <input name="actual_rate[]" type="number" class="form-control"
                                                        value="{{ old('actual_rate[]') }}">
                                                    @error('actual_rate.*')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-12">
                                                    <input name="fbr[]" type="number" class="form-control"
                                                        value="{{ old('fbr[]') }}">
                                                    @error('fbr.*')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>

                            <label for="bulan" class="form-label">Bulan</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" name="bulan">
                                </div>
                                <div class="col-12">
                            <label for="name_contract" class="form-label">Name Contract</label>
                            <input name="name_contract" type="text" class="form-control" id="name_contract">
                        </div>
                            <div class="col-12">
                                <label for="contract_reference" class="form-label">Contract Reference</label>
                                <input name="contract_reference" type="file" class="form-control"
                                    id="contract_reference">
                            </div>

                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-start">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    <a href="/rate-contract/astim/daywork-lcm" class="btn btn-secondary">Batal</a>
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
